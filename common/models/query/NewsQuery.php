<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 05.11.2017
 * Time: 14:24
 */

namespace common\models\query;


use common\models\News;
use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere(['status' => News::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%news}}.published_at', time()]);
        return $this;
    }
}