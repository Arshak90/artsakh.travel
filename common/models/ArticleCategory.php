<?php

namespace common\models;

use common\models\query\ArticleCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use trntv\filekit\behaviors\UploadBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $title_de
 * @property string $title_fr
 * @property string $title_es
 * @property string $title_ar
 * @property string $title_fa
 * @property string $keywords_hy
 * @property string $keywords_en
 * @property string $keywords_ru
 * @property string $keywords_de
 * @property string $keywords_fr
 * @property string $keywords_es
 * @property string $keywords_ar
 * @property string $keywords_fa
 * @property string $description_hy
 * @property string $description_en
 * @property string $description_ru
 * @property string $description_de
 * @property string $description_fr
 * @property string $description_es
 * @property string $description_ar
 * @property string $description_fa
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $status
 *
 * @property Article[] $articles
 * @property ArticleCategory $parent
 */
class ArticleCategory extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * @return ArticleCategoryQuery
     */
    public static function find()
    {
        return new ArticleCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_en',
                'immutable' => true
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_en'], 'required'],
            [['title_hy', 'title_en', 'title_ru', 'title_de', 'title_fr', 'title_es', 'title_ar', 'title_fa'], 'string', 'max' => 512],
            [['keywords_hy', 'keywords_en', 'keywords_ru', 'keywords_de', 'keywords_fr', 'keywords_es', 'keywords_ar', 'keywords_fa'], 'string', 'max' => 256],
            [['description_hy', 'description_en', 'description_ru', 'description_de', 'description_fr', 'description_es', 'description_ar', 'description_fa'], 'string', 'max' => 250],
            [['slug'], 'unique'],
            [['body'], 'string'],
            [['slug','thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe'],
            ['status', 'integer'],
            ['parent_id', 'exist', 'targetClass' => ArticleCategory::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'title_de' => 'Title',
            'title_fr' => 'Title',
            'title_es' => 'Title',
            'title_ar' => 'Title',
            'title_fa' => 'Title',
            'keywords_hy' => 'SEO Keywords',
            'keywords_en' => 'SEO Keywords',
            'keywords_ru' => 'SEO Keywords',
            'keywords_de' => 'SEO Keywords',
            'keywords_fr' => 'SEO Keywords',
            'keywords_es' => 'SEO Keywords',
            'keywords_ar' => 'SEO Keywords',
            'keywords_fa' => 'SEO Keywords',
            'body' => 'Body',
            'description_hy' => 'Description',
            'description_en' => 'Description',
            'description_ru' => 'Description',
            'description_de' => 'Description',
            'description_fr' => 'Description',
            'description_es' => 'Description',
            'description_ar' => 'Description',
            'description_fa' => 'Description',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'thumbnail_path' => 'Thumbnail Path',
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'parent_id' => Yii::t('common', 'Parent Category'),
            'status' => Yii::t('common', 'Active')
        ];
    }

    public function getMultilingual($multilingualField, $lang){
        return $this->getMultilingualParams($multilingualField."_".$lang);
    }

    private function getMultilingualParams($fieldLang){
        $arr = [
            'title_hy' => $this->title_hy,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru,
            'title_de' => $this->title_de,
            'title_fr' => $this->title_fr,
            'title_es' => $this->title_es,
            'title_ar' => $this->title_ar,
            'title_fa' => $this->title_fa,
            'keywords_hy' => $this->keywords_hy,
            'keywords_en' => $this->keywords_en,
            'keywords_ru' => $this->keywords_ru,
            'keywords_de' => $this->keywords_de,
            'keywords_fr' => $this->keywords_fr,
            'keywords_es' => $this->keywords_es,
            'keywords_ar' => $this->keywords_ar,
            'keywords_fa' => $this->keywords_fa,
            'description_hy' => $this->description_hy,
            'description_en' => $this->description_en,
            'description_ru' => $this->description_ru,
            'description_de' => $this->description_de,
            'description_fr' => $this->description_fr,
            'description_es' => $this->description_es,
            'description_ar' => $this->description_ar,
            'description_fa' => $this->description_fa,
        ];
        foreach ($arr as $i => $value) {
            if ($fieldLang == $i)
                return($arr[$i]);
        }

        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(ArticleCategory::className(), ['id' => 'parent_id']);
    }
}
