<?php
/**
 * Created by PhpStorm.
 * User: gev
 * Date: 10.12.2017
 * Time: 18:18
 */
namespace common\models;
use Yii;
use yii\db\ActiveRecord;

class Subscription extends ActiveRecord{
    public static function tableName()
    {
        return '{{%subscription}}';
    }
    public function rules(){
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'trim'],
            [['email'], 'unique'],
            [['email', 'addtime'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'email' => 'Email',
            'addtime' => 'Add time',
        ];
    }
}