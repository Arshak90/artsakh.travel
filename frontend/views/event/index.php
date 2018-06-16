<?php
/* @var $this yii\web\View */


//------ SEO ------------
$this->title = Yii::t('frontend', 'Events');

$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('frontend', 'description'),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => Yii::t('frontend', 'keywords'),
]);
?>
<!--    <h1>--><?php //echo Yii::t('frontend', 'Events') ?><!--</h1>-->
    <section class="page-head section-img search-result">
        <div class="gradient gradient-vr-56">
            <div class="container">
                <div class="text-block">
                    <h1><?=Yii::t('frontend','Events calendar')?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="project-items">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <span class="item-counts"><?php echo $dataProvider->getCount()." ".Yii::t('frontend','results found');?></span>
                </div>
            </div>
            <div class="row">
                <?php echo \common\widgets\ListView::widget([
                    'dataProvider'=>$dataProvider,
                    'pager'=>[
                        'hideOnSinglePage'=>true,
                    ],
                    'itemView'=>'_item',
                    'summary'=>''
                ])?>

            </div>
        </div>
    </section>