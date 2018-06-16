<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 17.02.2018
 * Time: 22:55
 */

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/*
* @property string $latest_news_slug
* @property integer $show_slider
* @property integer $show_latest_news
* @property integer $show_activity
* @property integer $show_map
* @property integer $show_info_block
* @property integer $show_info_centers
* @property integer $show_events
* @property integer $show_plan_your_trip
*/

/**
 * @property mixed show_info_centers
 */
class HomePageConfigs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%home_page_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latest_news_slug'], 'required'],
            [['latest_news_slug'], 'string', 'max' => 249],
            [['show_slider', 'show_latest_news', 'show_activity', 'show_map', 'show_info_block', 'show_info_centers', 'show_events', 'show_plan_your_trip'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'latest_news_slug' =>  'Latest News Slug',
            'show_slider' => 'Show slider',
            'show_latest_news' => 'Show latest news',
            'show_activity' => 'Show activity',
            'show_map' => 'Show map',
            'show_info_block' => 'Show info block',
            'show_info_centers' => 'Show tourism info centers',
            'show_events' => 'Show events',
            'show_plan_your_trip' => 'Show plan your trip',
        ];
    }

}