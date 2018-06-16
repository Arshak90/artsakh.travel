<?php

namespace common\models;

use common\models\query\EventQuery;
use common\models\EventCategory;
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
 * @property string $slug
 * @property string $title_hy
 * @property string $title_en
 * @property string $title_ru
 * @property string $title_de
 * @property string $title_fr
 * @property string $title_es
 * @property string $title_ar
 * @property string $title_fa
 * @property string $body_hy
 * @property string $body_en
 * @property string $body_ru
 * @property string $body_de
 * @property string $body_fr
 * @property string $body_es
 * @property string $body_ar
 * @property string $body_fa
 * @property string $view
 * @property string $short_description_hy
 * @property string $short_description_en
 * @property string $short_description_ru
 * @property string $short_description_de
 * @property string $short_description_fr
 * @property string $short_description_es
 * @property string $short_description_ar
 * @property string $short_description_fa
 * @property integer $event_date_time
 * @property string $ticket_price
 * @property string $location_name_hy
 * @property string $location_name_en
 * @property string $location_name_ru
 * @property string $location_name_de
 * @property string $location_name_fr
 * @property string $location_name_es
 * @property string $location_name_ar
 * @property string $location_name_fa
 * @property string $address_hy
 * @property string $address_en
 * @property string $address_ru
 * @property string $address_de
 * @property string $address_fr
 * @property string $address_es
 * @property string $address_ar
 * @property string $address_fa
 * @property string $latitude
 * @property string $longitude
 * @property boolean $isGallery
 * @property string $video_link
 * @property string $agenda_hy
 * @property string $agenda_en
 * @property string $agenda_ru
 * @property string $agenda_de
 * @property string $agenda_fr
 * @property string $agenda_es
 * @property string $agenda_ar
 * @property string $agenda_fa
 * @property string $keywords_hy
 * @property string $keywords_en
 * @property string $keywords_ru
 * @property string $keywords_de
 * @property string $keywords_fr
 * @property string $keywords_es
 * @property string $keywords_ar
 * @property string $keywords_fa
 * @property string $tags
 * @property integer $category_id
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $author
 * @property User $updater
 * @property EventCategory $category
 * @property EventAttachment[] $eventAttachments
 */
class Event extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var array
     */
    public $attachments;

    /**
     * @var array
     */
    public $thumbnail;
    /**
     * @var array
     */
    public $preview;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    public static function find()
    {
        return new EventQuery(get_called_class());
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
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'eventAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'preview',
                'pathAttribute' => 'preview_path',
                'baseUrlAttribute' => 'preview_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_en','body_en', 'short_description_en', 'event_date_time','category_id'], 'required'],
            [['slug'], 'unique'],
            [['body_hy', 'body_en', 'body_ru', 'body_de', 'body_fr', 'body_es', 'body_ar', 'body_fa', 'agenda_hy', 'agenda_en', 'agenda_ru', 'agenda_de', 'agenda_fr', 'agenda_es', 'agenda_ar', 'agenda_fa', 'tags'], 'string'],
            [['title_hy', 'title_en', 'title_ru', 'title_de', 'title_fr', 'title_es', 'title_ar', 'title_fa'], 'string', 'max' => 512],
            [['short_description_hy', 'short_description_en', 'short_description_ru', 'short_description_de', 'short_description_fr', 'short_description_es', 'short_description_ar', 'short_description_fa'], 'string', 'max' => 250],
            [['keywords_hy', 'keywords_en', 'keywords_ru', 'keywords_de', 'keywords_fr', 'keywords_es', 'keywords_ar', 'keywords_fa'], 'string', 'max' => 256],
            [['location_name_hy', 'location_name_en', 'location_name_ru', 'location_name_de', 'location_name_fr', 'location_name_es', 'location_name_ar', 'location_name_fa', 'address_hy', 'address_en', 'address_ru', 'address_de', 'address_fr', 'address_es', 'address_ar', 'address_fa'], 'string', 'max' => 150],
            [['latitude', 'longitude'], 'string', 'max' => 20],
            [['ticket_price'], 'number'],
            [['isGallery'], 'boolean'],
            [['published_at', 'event_date_time'], 'default', 'value' => function () {
                return date(DATE_ISO8601);
            }],
            [['published_at', 'event_date_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['category_id'], 'exist', 'targetClass' => EventCategory::className(), 'targetAttribute' => 'id'],
            [['status'], 'integer'],
            [['slug', 'video_link', 'thumbnail_base_url', 'preview_base_url','thumbnail_path','preview_path'], 'string', 'max' => 1024],
            [['view'], 'string', 'max' => 255],
            [['attachments', 'thumbnail', 'preview'], 'safe']
        ];
    }

    public function getMultilingual($multilingualField, $lang){
        return $this->getMultilignualParams($multilingualField."_".$lang);
    }

    private function getMultilignualParams($fieldLang){
        $arr = [
            'title_hy' => $this->title_hy,
            'title_en' => $this->title_en,
            'title_ru' => $this->title_ru,
            'title_de' => $this->title_de,
            'title_fr' => $this->title_fr,
            'title_es' => $this->title_es,
            'title_ar' => $this->title_ar,
            'title_fa' => $this->title_fa,
            'body_hy' => $this->body_hy,
            'body_en' => $this->body_en,
            'body_ru' => $this->body_ru,
            'body_de' => $this->body_de,
            'body_fr' => $this->body_fr,
            'body_es' => $this->body_es,
            'body_ar' => $this->body_ar,
            'body_fa' => $this->body_fa,
            'short_description_hy' => $this->short_description_hy,
            'short_description_en' => $this->short_description_en,
            'short_description_ru' => $this->short_description_ru,
            'short_description_de' => $this->short_description_de,
            'short_description_fr' => $this->short_description_fr,
            'short_description_es' => $this->short_description_es,
            'short_description_ar' => $this->short_description_ar,
            'short_description_fa' => $this->short_description_fa,
            'location_name_hy' => $this->location_name_hy,
            'location_name_en' => $this->location_name_en,
            'location_name_ru' => $this->location_name_ru,
            'location_name_de' => $this->location_name_de,
            'location_name_fr' => $this->location_name_fr,
            'location_name_es' => $this->location_name_es,
            'location_name_ar' => $this->location_name_ar,
            'location_name_fa' => $this->location_name_fa,
            'address_hy' => $this->address_hy,
            'address_en' => $this->address_en,
            'address_ru' => $this->address_ru,
            'address_de' => $this->address_de,
            'address_fr' => $this->address_fr,
            'address_es' => $this->address_es,
            'address_ar' => $this->address_ar,
            'address_fa' => $this->address_fa,
            'agenda_hy' => $this->agenda_hy,
            'agenda_en' => $this->agenda_en,
            'agenda_ru' => $this->agenda_ru,
            'agenda_de' => $this->agenda_de,
            'agenda_fr' => $this->agenda_fr,
            'agenda_es' => $this->agenda_es,
            'agenda_ar' => $this->agenda_ar,
            'agenda_fa' => $this->agenda_fa,
            'keywords_hy' => $this->keywords_hy,
            'keywords_en' => $this->keywords_en,
            'keywords_ru' => $this->keywords_ru,
            'keywords_de' => $this->keywords_de,
            'keywords_fr' => $this->keywords_fr,
            'keywords_es' => $this->keywords_es,
            'keywords_ar' => $this->keywords_ar,
            'keywords_fa' => $this->keywords_fa,
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
            'slug' => 'Slug',
            'title_hy' => 'Title',
            'title_en' => 'Title',
            'title_ru' => 'Title',
            'title_de' => 'Title',
            'title_fr' => 'Title',
            'title_es' => 'Title',
            'title_ar' => 'Title',
            'title_fa' => 'Title',
            'body_hy' => 'Body',
            'body_en' => 'Body',
            'body_ru' => 'Body',
            'body_de' => 'Body',
            'body_fr' => 'Body',
            'body_es' => 'Body',
            'body_ar' => 'Body',
            'body_fa' => 'Body',
            'short_description_hy' => 'Short Description',
            'short_description_en' => 'Short Description',
            'short_description_ru' => 'Short Description',
            'short_description_de' => 'Short Description',
            'short_description_fr' => 'Short Description',
            'short_description_es' => 'Short Description',
            'short_description_ar' => 'Short Description',
            'short_description_fa' => 'Short Description',
            'location_name_hy' => 'Location Name',
            'location_name_en' => 'Location Name',
            'location_name_ru' => 'Location Name',
            'location_name_de' => 'Location Name',
            'location_name_fr' => 'Location Name',
            'location_name_es' => 'Location Name',
            'location_name_ar' => 'Location Name',
            'location_name_fa' => 'Location Name',
            'address_hy' => 'Address',
            'address_en' => 'Address',
            'address_ru' => 'Address',
            'address_de' => 'Address',
            'address_fr' => 'Address',
            'address_es' => 'Address',
            'address_ar' => 'Address',
            'address_fa' => 'Address',
            'agenda_hy' => 'Agenda',
            'agenda_en' => 'Agenda',
            'agenda_ru' => 'Agenda',
            'agenda_de' => 'Agenda',
            'agenda_fr' => 'Agenda',
            'agenda_es' => 'Agenda',
            'agenda_ar' => 'Agenda',
            'agenda_fa' => 'Agenda',
            'keywords_hy' => 'SEO Keywords',
            'keywords_en' => 'SEO Keywords',
            'keywords_ru' => 'SEO Keywords',
            'keywords_de' => 'SEO Keywords',
            'keywords_fr' => 'SEO Keywords',
            'keywords_es' => 'SEO Keywords',
            'keywords_ar' => 'SEO Keywords',
            'keywords_fa' => 'SEO Keywords',
            'view' => 'View',
            'event_date_time' => 'Event Date Time',
            'ticket_price' => 'Ticket Price',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'isGallery' => 'Is Gallery',
            'video_link' => 'YouTube Video ID',
            'tags' => 'Tags',
            'category_id' => 'Category ID',
            'thumbnail_base_url' => 'Header Base Url',
            'thumbnail_path' => 'Header Path',
            'thumbnail' => 'Header photo',
            'preview_base_url' => 'Preview Base Url',
            'preview_path' => 'Preview Path',
            'preview' => 'Preview photo',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'published_at' => 'Published At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(EventCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventAttachments()
    {
        return $this->hasMany(EventAttachment::className(), ['event_id' => 'id']);
    }
}
