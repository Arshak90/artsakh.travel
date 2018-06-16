<?php
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->getMultilingual('title', YII::$app->language);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

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

?>


<?php
    if ($model->thumbnail_path){
        $this->registerJs(
            "
        $( document ).ready(function() {
            $('.template').css( 'background-image', 'url(".$model->thumbnail_base_url.'/' . $model->thumbnail_path.")' );
            
        });",
            View::POS_READY
        );
    }

    //clean link data-target
    $this->registerJs(
        "
            $( document ).ready(function() {
                for(let link of $('.tmp_link')){
                    link.dataset.target = '';
                }
            });",
        View::POS_READY
    );
?>

<section class="template page-head section-img">
<!--    --><?php //if ($model->thumbnail_path): ?>
<!--        --><?php //echo \yii\helpers\Html::img(
//            Yii::$app->glide->createSignedUrl([
//                'glide/index',
//                'path' => $model->thumbnail_path,
//                'w' => 200
//            ], true),
//            ['class' => 'article-thumb img-rounded pull-left']
//        ) ?>
<!--    --><?php //endif; ?>
    <div class="gradient gradient-vr-56">
        <div class="container">
            <div class="text-block">
                <h1><?= $model->getMultilingual('title', Yii::$app->language) ?></h1>
                <p><?= $model->getMultilingual('short_description', Yii::$app->language) ?></p>
            </div>
        </div>
    </div>
</section>
<section class="template-text">




        <?php echo $model->getMultilingual('body', Yii::$app->language) ?>


<?php if ( count($model->articleAttachments) != 0):?>
        <div class="item container pt-60">
            <div id="gallery" style="display:none;">
                    <?php foreach ($model->articleAttachments as $attach):?>
                        <img alt="Preview Image 1"
                             src="<?= $attach->base_url."/".$attach->path?>"
                             data-image="<?= $attach->base_url."/".$attach->path?>"
                             >
<!--                        data-description="Preview Image 1 Description"-->
                    <?php endforeach;?>
            </div>

        </div>
        <?php endif; ?>
</section>