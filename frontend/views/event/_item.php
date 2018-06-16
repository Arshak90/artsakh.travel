<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Event
 */
use yii\helpers\Html;


?>

<div class="item">
    <div class="col-md-3 col-sm-4 col-xs-12 item-img">
        <?php echo Html::img($model->thumbnail_base_url.'/' . $model->thumbnail_path,['width' => '100px', 'alt' => $model->getMultilingual('title', Yii::$app->language)]);?>
    </div>
    <div class="col-md-9 col-sm-8  col-xs-12 item-information">
        <h4><?= $model->getMultilingual('title', Yii::$app->language)?></h4>
<!--        --><?php //echo Html::a(
//            $model->category->title_en,
//            ['index', 'EventSearch[category_id]' => $model->category_id]
//        )?>
        <span class="item-type"><?= $model->category->getMultilingual("title", Yii::$app->language)?></span>
        <div class="date"><?php echo Yii::$app->formatter->asDate($model->event_date_time, "d MMM") ?></div>
        <p class="calendar-mini-description"><?php echo \yii\helpers\StringHelper::truncate($model->getMultilingual('short_description', Yii::$app->language), 150, '...', null, true) ?></p>
        <ul>
            <li class="event-mini-indicator">
                <div class="pull-left">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <div class="pull-left">
                    <p class="light-text"><?= Yii::t('frontend','Place');?></p>
                    <p class="dark-text"><?php echo $model->getMultilingual('location_name', Yii::$app->language).' '.$model->getMultilingual('address', Yii::$app->language)?></p>
                </div>
            </li>
            <li class="event-mini-indicator">
                <div class="pull-left">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </div>
                <div class="pull-left">
                    <p class="light-text"><?= Yii::t('frontend','Date Time');?></p>
                    <p class="dark-text"><?php echo Yii::$app->formatter->asTime($model->event_date_time, "HH:mm") ?></p>
                </div>
            </li>
            <li class="event-mini-indicator">
                <div class="pull-left">
                    <i class="fa fa-ticket" aria-hidden="true"></i>
                </div>
                <div class="pull-left">
                    <p class="light-text"><?= Yii::t('frontend','Tickets');?></p>
                    <p class="dark-text"><?php echo ($model->ticket_price)?number_format($model->ticket_price, 2, ',', ' ').' '.Yii::t('frontend','AMD'):Yii::t('frontend','FREE')  ?></p>
                </div>
            </li>
        </ul>
        <div class="clear"></div>
        <?php echo Html::a( Yii::t('frontend', 'VISIT EVENT').'<i class="fa fa-angle-right" aria-hidden="true"></i>', ['view', 'slug'=>$model->slug],['class'=>'calendar-visit-event']) ?>
    </div>
    <div class="clear"></div>
</div>

