<?php
/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $categories common\models\EventCategory[] */

$this->title = Yii::t('backend', 'Create Slider Item', [
    'modelClass' => 'Slider',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
