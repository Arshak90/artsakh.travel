<?php
/**
 * Created by PhpStorm.
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Event;
use yii\db\ActiveQuery;

class EventQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere(['status' => Event::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%event}}.published_at', time()]);
//        $this->orderBy('{{%event}}.event_date_time');
        return $this;
    }
}
