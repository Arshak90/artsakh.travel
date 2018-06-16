<?php

namespace common\models;

use common\models\query\SliderQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $title_de
 * @property string $title_fr
 * @property string $title_es
 * @property string $title_ar
 * @property string $title_fa
 * @property string $short_description_hy
 * @property string $short_description_en
 * @property string $short_description_ru
 * @property string $short_description_de
 * @property string $short_description_fr
 * @property string $short_description_es
 * @property string $short_description_ar
 * @property string $short_description_fa
 * @property string $link
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $created_at
 * @property integer $updated_at

 */
class Slider extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    public $slug;

    public $created_by;

    public $updated_by;
    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $thumbnail;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    public static function find()
    {
        return new SliderQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
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
            [['title_en', 'short_description_en', 'link'], 'required'],
            [['title_hy', 'title_en', 'title_ru', 'title_de', 'title_fr', 'title_es', 'title_ar', 'title_fa'], 'string', 'max' => 512],
            [['short_description_hy', 'short_description_en', 'short_description_ru', 'short_description_de', 'short_description_fr', 'short_description_es', 'short_description_ar', 'short_description_fa'], 'string', 'max' => 512],
            [['published_at'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['link', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['thumbnail'], 'safe']
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
            'short_description_hy' => $this->short_description_hy,
            'short_description_en' => $this->short_description_en,
            'short_description_ru' => $this->short_description_ru,
            'short_description_de' => $this->short_description_de,
            'short_description_fr' => $this->short_description_fr,
            'short_description_es' => $this->short_description_es,
            'short_description_ar' => $this->short_description_ar,
            'short_description_fa' => $this->short_description_fa,
        ];
        foreach ($arr as $i => $value) {
            if ($fieldLang == $i)
                return($arr[$i]);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'title_de' => 'Title',
            'title_fr' => 'Title',
            'title_es' => 'Title',
            'title_ar' => 'Title',
            'title_fa' => 'Title',
            'short_description_hy' => 'Short Description',
            'short_description_en' => 'Short Description',
            'short_description_ru' => 'Short Description',
            'short_description_de' => 'Short Description',
            'short_description_fr' => 'Short Description',
            'short_description_es' => 'Short Description',
            'short_description_ar' => 'Short Description',
            'short_description_fa' => 'Short Description',
            'link' => 'Link',
            'thumbnail_base_url' => 'Thumbnail Base Url',
            'thumbnail_path' => 'Thumbnail Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
