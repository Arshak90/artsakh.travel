<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\News
 */
use yii\helpers\Html;

?>



<div class="item">
    <div class="col-md-4 col-sm-4 col-xs-12 item-img">
        <?php echo Html::img($model->thumbnail_base_url.'/' . $model->thumbnail_path,['width' => '100px', 'alt' => $model->getMultilingual('title', Yii::$app->language)]);?>
    </div>
    <div class="col-md-8 col-sm-8  col-xs-12 item-information">
        <h2><?= $model->getMultilingual('title', Yii::$app->language)?></h2>
        <div class="tag light-text">
            <i class="fa fa-tag" aria-hidden="true"></i>
            <span><?= $model->category->getMultilingual("title", Yii::$app->language)?></span>
        </div>
        <div class="post-date light-text">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <span><?php echo Yii::$app->formatter->asDate($model->published_at, "d MMM, y") ?></span>
        </div>
        <p class="news-mini-description"><?php echo \yii\helpers\StringHelper::truncate($model->getMultilingual('short_description', Yii::$app->language), 150, '...', null, true) ?></p>
        <div class="clear"></div>
        <?php echo Html::a( Yii::t('frontend', 'VISIT NEWS').'<i class="fa fa-angle-right" aria-hidden="true"></i>', ['view', 'slug'=>$model->slug],['class'=>'calendar-visit-event']) ?>
    </div>
    <div class="clear"></div>
</div>
