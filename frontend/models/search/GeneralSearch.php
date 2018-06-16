<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 25.03.2018
 * Time: 0:13
 */

namespace frontend\models\search;


use yii\base\Model;

class GeneralSearch extends Model
{
    public $search;

    public function rules()
    {
        return [['search', 'string']];
    }

}