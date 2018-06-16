<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_attachment".
 *
 * @property integer $id
 * @property integer $news_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $created_at
 * @property integer $order
 */
class NewsAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'news_id', 'path'], 'required'],
            [['id', 'news_id', 'size', 'created_at', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'created_at' => 'Created At',
            'order' => 'Order',
        ];
    }

    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
