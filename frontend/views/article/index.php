<?php
use yii\web\View;
/* @var $this yii\web\View */

$this->title = $category->getMultilingual('title', YII::$app->language);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $category->getMultilingual('description', YII::$app->language),
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $category->getMultilingual('keywords', YII::$app->language),
]);

$pos = 0;
foreach ($dataProvider->getModels() as $model){
    $pos++;

    $findTitle   = '#title'.$pos;
    $category->body = str_replace($findTitle , $model->getMultilingual('title', Yii::$app->language), $category->body);

    $findLink   = '#link'.$pos;
    $category->body = str_replace($findLink , $model->category->slug.'/'. $model->slug, $category->body);

    $findImage   = '#image'.$pos;
    $category->body = str_replace($findImage , $model->preview_base_url.'/'.$model->preview_path , $category->body);

    $findShortDescription   = '#short_description'.$pos;
    $category->body = str_replace($findShortDescription , $model->getMultilingual('short_description', Yii::$app->language), $category->body);
}
?>

<?php
if ($category->thumbnail_path){
    $this->registerJs(
        "
    $( document ).ready(function() {
        $('.template').css( 'background-image', 'url(".$category->thumbnail_base_url.'/' . $category->thumbnail_path.")' );
    });",
        View::POS_READY
    );

}

?>

<section class="template page-head section-img categories">
    <div class="gradient gradient-vr-56">
        <div class="container">
            <div class="text-block">
                <h1><?= $category->getMultilingual('title', YII::$app->language)?></h1>
                <p><?= $category->getMultilingual('description', YII::$app->language)?></p>
            </div>
        </div>
    </div>
</section>

<?php echo $category->body ?>
<!--<div id="article-index">-->
<!--    <h1>--><?php //echo Yii::t('frontend', 'Articles') ?><!--</h1>-->
<!--    --><?php //echo \yii\widgets\ListView::widget([
//        'dataProvider'=>$dataProvider,
//        'pager'=>[
//            'hideOnSinglePage'=>true,
//        ],
//        'itemView'=>'_item'
//    ])?>
<!--</div>-->