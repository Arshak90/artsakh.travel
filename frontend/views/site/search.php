<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 25.03.2018
 * Time: 1:08
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\GeneralSearch;
use yii\widgets\LinkPager;

$this->title = Yii::t('frontend', 'Search')." ".$search;


$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('frontend', 'Search')." :".$search,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $search,
]);

$model = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null){
    $model->search = Yii::$app->getRequest()->getQueryParam('search');
}
?>

<section class="page-head section-img search-result">
    <div class="gradient gradient-vr-56">
        <div class="container">
            <div class="text-block">
                <h1><?= Yii::t('frontend', 'Search results');?></h1>
            </div>
        </div>
    </div>
</section>

<section class="search-input-block">
    <div class="container">
        <div class="row">
            <?php $form = ActiveForm::begin();?>
                <div class="col-md-6">
                    <?= $form->field($model, 'search')->textInput([ 'placeholder'=>Yii::t('frontend', 'Search')])->label(false)?>
                </div>
                <div class="col-md-6">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Search'), ['class' => 'main-btn']) ?>
                </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</section>

<section class="project-items">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <span class="item-counts"><?=count($articles)." ".Yii::t('frontend', 'results found')?></span>
            </div>
        </div>
        <?php if ($search == "" || count($articles) == 0){?>
            <div class="row">
                <div class="item">
                    <div class="col-md-12 col-sm-12  col-xs-12 item-information">
                        <h4><?= Yii::t('frontend', 'No results found');?></h4>
                    </div>
                </div>
            </div>
        <?php  }else{?>
        <div class="row">
            <?php foreach ($articles as $article){?>
                <div class="item">
                    <div class="col-md-3 col-sm-4 col-xs-12 item-img">
                        <?php echo Html::img($article->thumbnail_base_url.'/' . $article->preview_path,['width' => '100px', 'alt' => $article->getMultilingual('title', Yii::$app->language)]);?>
                    </div>
                    <div class="col-md-9 col-sm-8  col-xs-12 item-information">
                        <h4><?=$article->getMultilingual('title', Yii::$app->language)?></h4>
                        <span class="item-type"><?= $article->category->getMultilingual('title', Yii::$app->language)?></span>
                        <p><?=$article->getMultilingual('short_description', Yii::$app->language)?></p>
                        <?php echo Html::a( Yii::t('frontend', 'read more').'<i class="fa fa-angle-right" aria-hidden="true"></i>', [$article->category->slug."/".$article->slug],['class'=>'calendar-visit-event']) ?>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php }?>
        </div>
        <?php } ?>
        <?php echo LinkPager::widget([
        'pagination' => $pagination,
        ]);?>
    </div>
</section>