<?php



namespace common\models;



use common\models\query\NewsQuery;

use trntv\filekit\behaviors\UploadBehavior;

use yii\behaviors\BlameableBehavior;

use yii\behaviors\SluggableBehavior;

use yii\behaviors\TimestampBehavior;



use yii\db\ActiveRecord;



/**

 * This is the model class for table "news".

 *

 * @property integer $id

 * @property string $slug

 * @property string $title_en

 * @property string $title_hy

 * @property string $title_ru

 * @property string $title_de

 * @property string $title_fr

 * @property string $title_es

 * @property string $title_ar

 * @property string $title_fa

 * @property string $body_en

 * @property string $body_hy

 * @property string $body_ru

 * @property string $body_de

 * @property string $body_fr

 * @property string $body_es

 * @property string $body_ar

 * @property string $body_fa

 * @property string $short_description_en

 * @property string $short_description_hy

 * @property string $short_description_ru

 * @property string $short_description_de

 * @property string $short_description_fr

 * @property string $short_description_es

 * @property string $short_description_ar

 * @property string $short_description_fa

 * @property string $keywords_hy

 * @property string $keywords_en

 * @property string $keywords_ru

 * @property string $keywords_de

 * @property string $keywords_fr

 * @property string $keywords_es

 * @property string $keywords_ar

 * @property string $keywords_fa

 * @property string $tags

 * @property string $view

 * @property integer $category_id

 * @property string $thumbnail_base_url

 * @property string $thumbnail_path

 * @property integer $status

 * @property integer $created_by

 * @property integer $updated_by

 * @property integer $published_at

 * @property integer $created_at

 * @property integer $updated_at

 */

class News extends ActiveRecord

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

     * @inheritdoc

     */

    public static function tableName()

    {

        return '{{%news}}';

    }



    public static function find()

    {

        return new NewsQuery(get_called_class());

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

                'uploadRelation' => 'newsAttachments',

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

            ]

        ];

    }



    /**

     * @inheritdoc

     */

    public function rules()

    {

        return [

            [['title_en','body_en', 'short_description_en','category_id'], 'required'],

            [['slug'], 'unique'],

            [['body_hy', 'body_en', 'body_ru', 'body_de', 'body_fr', 'body_es', 'body_ar', 'body_fa', 'tags'], 'string'],

            [['title_hy', 'title_en', 'title_ru', 'title_de', 'title_fr', 'title_es', 'title_ar', 'title_fa'], 'string', 'max' => 512],

            [['short_description_hy', 'short_description_en', 'short_description_ru', 'short_description_de', 'short_description_fr', 'short_description_es', 'short_description_ar', 'short_description_fa'], 'string', 'max' => 250],

            [['keywords_hy', 'keywords_en', 'keywords_ru', 'keywords_de', 'keywords_fr', 'keywords_es', 'keywords_ar', 'keywords_fa', 'activity_slug_1', 'activity_slug_2', 'activity_slug_3'], 'string', 'max' => 256],

            [['published_at'], 'default', 'value' => function () {

                return date(DATE_ISO8601);

            }],

            [['published_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],

            [['category_id'], 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute' => 'id'],

            [['status'], 'integer'],

            [['slug', 'video_link', 'thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],

            [['view'], 'string', 'max' => 255],

            [['attachments', 'thumbnail'], 'safe']

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



        return "";

    }



    /**

     * @inheritdoc

     */

    public function attributeLabels()

    {

        return [

            'id' => 'ID',

            'slug' => 'Slug',

            'title_en' => 'Title',

            'title_hy' => 'Title',

            'title_ru' => 'Title',

            'title_de' => 'Title',

            'title_fr' => 'Title',

            'title_es' => 'Title',

            'title_ar' => 'Title',

            'title_fa' => 'Title',

            'body_en' => 'Body',

            'body_hy' => 'Body',

            'body_ru' => 'Body',

            'body_de' => 'Body',

            'body_fr' => 'Body',

            'body_es' => 'Body',

            'body_ar' => 'Body',

            'body_fa' => 'Body',

            'short_description_en' => 'Short Description',

            'short_description_hy' => 'Short Description',

            'short_description_ru' => 'Short Description',

            'short_description_de' => 'Short Description',

            'short_description_fr' => 'Short Description',

            'short_description_es' => 'Short Description',

            'short_description_ar' => 'Short Description',

            'short_description_fa' => 'Short Description',

            'keywords_hy' => 'SEO Keywords',

            'keywords_en' => 'SEO Keywords',

            'keywords_ru' => 'SEO Keywords',

            'keywords_de' => 'SEO Keywords',

            'keywords_fr' => 'SEO Keywords',

            'keywords_es' => 'SEO Keywords',

            'keywords_ar' => 'SEO Keywords',

            'keywords_fa' => 'SEO Keywords',

            'tags' => 'Tags',

            'view' => 'View',

            'activity_slug_1' => 'Activity slug 1',

            'activity_slug_2' => 'Activity slug 2',

            'activity_slug_3' => 'Activity slug 3',

            'category_id' => 'Category ID',

            'thumbnail_base_url' => 'Thumbnail Base Url',

            'thumbnail_path' => 'Thumbnail Path',

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

        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);

    }



    /**

     * @return \yii\db\ActiveQuery

     */

    public function getNewsAttachments()

    {

        return $this->hasMany(NewsAttachment::className(), ['news_id' => 'id']);

    }

}

