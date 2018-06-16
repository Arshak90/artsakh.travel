<?php
/**
 * Created by PhpStorm.
 * Time: 2:31 PM
 */

namespace common\models\query;

use common\models\Slider;
use yii\db\ActiveQuery;

class SliderQuery extends ActiveQuery
{
    public function published()
    {
        $this->andWhere(['status' => Slider::STATUS_PUBLISHED]);
        $this->andWhere(['<', '{{%slider}}.published_at', time()]);
        return $this;
    }
}
