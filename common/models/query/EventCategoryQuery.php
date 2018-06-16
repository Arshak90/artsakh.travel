<?php
/**
 * Created by PhpStorm.
 * User: gev
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\EventCategory;
use yii\db\ActiveQuery;

class EventCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => EventCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%event_category}}.parent_id IS NULL');

        return $this;
    }
}
