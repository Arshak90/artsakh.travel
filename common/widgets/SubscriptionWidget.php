<?php
/**
 * Created by PhpStorm.
 * User: gev
 * Date: 10.12.2017
 * Time: 18:23
 */

namespace common\widgets;

use Yii;
use yii\base\Widget;
use common\models\Subscription;


class SubscriptionWidget extends Widget {
    public $subscription;
    public function init() {
        $this->subscription = new Subscription();
    }
    public function run() {
        return $this->render('subscription',[
            'model' => $this->subscription,
        ]);
    }
}