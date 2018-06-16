<?php
/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $categories common\models\EventCategory[] */

$this->title = Yii::t('backend', 'Create Event', [
    'modelClass' => 'Event',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
