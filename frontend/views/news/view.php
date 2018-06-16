<?php
use common\models\NewsCategory;
use yii\web\View;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $nextModel common\models\News */
/* @var $activities Array common\models\Activity */

//------ SEO ------------
$this->title = $model->getMultilingual('title', YII::$app->language);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->getMultilingual('short_description', YII::$app->language),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->getMultilingual('keywords', YII::$app->language),
]);
$this->registerJsFile(
    '/gallery-js/ug-common-libraries.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-functions.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsgeneral.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsstrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-touchthumbs.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-panelsbase.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-strippanel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-gridpanel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-thumbsgrid.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-tiles.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-tiledesign.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-avia.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-slider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-sliderassets.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-touchslider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-zoomslider.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-video.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-gallery.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);




$this->registerJsFile(
    '/gallery-js/ug-lightbox.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-carousel.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-js/ug-api.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '/gallery-themes/default/ug-theme-default.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile("/gallery-css/unite-gallery.css");
$this->registerCssFile("/gallery-themes/default/ug-theme-default.css");

$this->registerJs(
    "
        jQuery(document).ready(function(){

                    jQuery(\"#gallery\").unitegallery();

                });
    ");

//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'News'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<section class="news">
    <div class="container">
        <div class="row">
            <div class="col-md-8 news-content">
                <h2><?= $model->getMultilingual('title', YII::$app->language);?></h2>
                <div class="tag light-text">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <span><?= $model->category->getMultilingual('title', YII::$app->language);?></span>
                </div>
                <div class="post-date light-text">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    <span><?php echo Yii::$app->formatter->asDate($model->published_at, "d MMM, y") ?></span>
                </div>
                <div class="news-main-block">
<!--                --><?php //echo Html::img($model->thumbnail_base_url.'/' . $model->thumbnail_path,['width' => '100px', 'alt' => $model->getMultilingual('title', Yii::$app->language)]);?>
                <?= $model->getMultilingual('body', YII::$app->language);?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="hr-line"></div>
                <div class="news-sidebar">
                    <?php foreach ($latestNews as $key => $item){ ?>
                        <div class="item">
                            <a href="/news/<?= $item->slug?>">
                                <div class="img-container">
                                    <img src="<?=$item->thumbnail_base_url.'/' . $item->thumbnail_path?>" alt="">
                                </div>
                                <div class="text">
                                    <h4><?= $item->getMultilingual('title', YII::$app->language);?></h4>
                                    <div class="tag light-text">
                                        <i class="fa fa-tag" aria-hidden="true"></i>
                                        <span><?= $model->category->getMultilingual('title', YII::$app->language);?></span>
                                    </div>
                                    <div class="post-date light-text">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span><?php echo Yii::$app->formatter->asDate($item->published_at, "d MMM, y") ?></span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </a>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php if ( count($model->newsAttachments) != 0 || !empty($model->video_link)):?>
            <div class="item">
                <div id="gallery" style="display:none;">
                    <?php if (!empty($model->video_link)):?>
                        <img alt="<?= $model->getMultilingual('title', Yii::$app->language)?>"
                             data-type="youtube"
                             data-videoid="<?= $model->video_link?>"
                             data-description="<?= $model->getMultilingual('short_description', Yii::$app->language)?>">
                    <?php endif;?>
                    <?php if (count($model->newsAttachments) != 0):?>
                        <?php foreach ($model->newsAttachments as $attach):?>
                            <img alt="Preview Image 1"
                                 src="<?= $attach->base_url."/".$attach->path?>"
                                 data-image="<?= $attach->base_url."/".$attach->path?>"
                            >
                            <!--                        data-description="Preview Image 1 Description"-->
                        <?php endforeach;?>
                    <?php endif;?>
                </div>

            </div>
        <?php endif; ?>
    </div>

</section>
<?php if (count($activities) > 0):?>
    <section class="home-activity white-txt-block grey-bg">
        <div class="container">
            <h2><?= Yii::t('frontend','Activity');?></h2>
            <div class="line"></div>
            <div class="row">
                <?php foreach ($activities as $activity):?>
                    <div class="col-sm-4 col-xs-12">
                        <a href="<?= '/'.$activity->category->slug . '/' . $activity->slug ?>">
                            <div class="item item-1" style="background: url(<?= $activity->preview_base_url . '/' . $activity->preview_path ?>) no-repeat center; background-size: cover;">
                                <div class="black-57">
                                    <h4 class="activity-title-pdd" title="<?= $activity->getMultilingual('title', Yii::$app->language) ?>"><?= $activity->getMultilingual('title', Yii::$app->language) ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach;?>

            </div>
        </div>
    </section>

<?php endif;?>
