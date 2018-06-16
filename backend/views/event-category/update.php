<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EventCategory */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Event Category',
]) . ' ' . $model->title_en;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Event Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title_en, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="article-category-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
