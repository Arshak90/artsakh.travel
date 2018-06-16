<?php

namespace common\models;

use common\models\query\NewsCategoryQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news_category".
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
 * @property string $body
 * @property integer $parent_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class NewsCategory extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_category}}';
    }

    /**
     * @return NewsCategoryQuery
     */
    public static function find()
    {
        return new NewsCategoryQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title_en',
                'immutable' => true
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
            [['id', 'parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['body'], 'string'],
            [['slug'], 'unique'],
            [['slug'], 'string', 'max' => 1024],
            [['title_hy', 'title_en', 'title_ru', 'title_de', 'title_fr', 'title_es', 'title_ar', 'title_fa'], 'string', 'max' => 512],
            ['parent_id', 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute' => 'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'title_de' => 'Title',
            'title_fr' => 'Title',
            'title_es' => 'Title',
            'title_ar' => 'Title',
            'title_fa' => 'Title',
            'body' => 'Body',
            'parent_id' => 'Parent ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasMany(NewsCategory::className(), ['id' => 'parent_id']);
    }


}
