<?php

use common\grid\EnumColumn;
use common\models\EventCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(
            Yii::t('backend', 'Create Slider', ['modelClass' => 'Slider']),
            ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [

            'id',
            'title_en',
            'created_at:datetime',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ]
        ]
    ]); ?>
</div>
