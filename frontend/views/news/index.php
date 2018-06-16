<?php
/* @var $this yii\web\View */
$this->title = Yii::t('frontend', 'News list')
?>
    <section class="page-head section-img search-result">
        <div class="gradient gradient-vr-56">
            <div class="container">
                <div class="text-block">
                    <h1><?= Yii::t('frontend', 'News list')?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="project-items news-listing">
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
<!--    <section class="home-activity white-txt-block">-->
<!--        <div class="container">-->
<!--            <h2>--><?//= Yii::t('frontend','Activity');?><!--</h2>-->
<!--            <div class="line"></div>-->
<!--            <div class="row">-->
<!--                <div class="col-sm-4 col-xs-12">-->
<!--                    <a href="#">-->
<!--                        <div class="item item-1">-->
<!--                            <div class="black-57">-->
<!--                                <div class="activity-icon-1"></div>-->
<!--                                <h4>Hiking</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="col-sm-4 col-xs-12">-->
<!--                    <a href="#">-->
<!--                        <div class="item item-2">-->
<!--                            <div class="black-57">-->
<!--                                <div class="activity-icon-2"></div>-->
<!--                                <h4>Flights above Artsakh</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="col-sm-4 col-xs-12">-->
<!--                    <a href="#">-->
<!--                        <div class="item item-4">-->
<!--                            <div class="black-57">-->
<!--                                <div class="activity-icon-4"></div>-->
<!--                                <h4>Mountain biking</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="flex-center">-->
<!--                <button class="button-liner blue">--><?//= Yii::t('frontend','show all');?><!--</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    