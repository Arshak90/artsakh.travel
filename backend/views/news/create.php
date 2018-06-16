<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $categories common\models\NewsCategory[] */

$this->title = Yii::t('backend', 'Create News', [
    'modelClass' => 'News',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
