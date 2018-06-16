<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 17.02.2018
 * Time: 23:25
 */
/* @var $configs common\models\HomePageConfigs */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<h2> Home page configurations </h2>
<div class="article-form">


    <?php $form = ActiveForm::begin(); ?>

        <?php echo $form->field($configs, 'latest_news_slug')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($configs, 'show_slider')->checkbox() ?>

        <?php echo $form->field($configs, 'show_latest_news')->checkbox() ?>

        <?php echo $form->field($configs, 'show_activity')->checkbox() ?>

        <?php echo $form->field($configs, 'show_map')->checkbox() ?>

        <?php echo $form->field($configs, 'show_info_block')->checkbox() ?>

        <?php echo $form->field($configs, 'show_info_centers')->checkbox() ?>

        <?php echo $form->field($configs, 'show_events')->checkbox() ?>

        <?php echo $form->field($configs, 'show_plan_your_trip')->checkbox() ?>

        <div class="form-group">
            <?php echo Html::submitButton( Yii::t('backend', 'Update'),  ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
