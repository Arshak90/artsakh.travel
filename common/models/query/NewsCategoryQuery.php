<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 05.11.2017
 * Time: 14:22
 */

namespace common\models\query;


use common\models\NewsCategory;
use yii\db\ActiveQuery;

class NewsCategoryQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => NewsCategory::STATUS_ACTIVE]);

        return $this;
    }

    /**
     * @return $this
     */
    public function noParents()
    {
        $this->andWhere('{{%news_category}}.parent_id IS NULL');

        return $this;
    }
}