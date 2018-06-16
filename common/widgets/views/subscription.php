<?php
/**
 * Created by PhpStorm.
 * User: gev
 * Date: 10.12.2017
 * Time: 18:24
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="col-md-3 col-sm-12 footer-item">
    <h3><?= Yii::t('frontend', 'Get our neewsletter') ?></h3>
    <p><?= Yii::t('frontend', 'Enter your email address for our mailing list to keep yourself updated.') ?></p>
    <div class="input-with-button">
        <?php Pjax::begin(['enablePushState' => false, 'id' => 'pjax_form']); ?>
        <?php $form = ActiveForm::begin([
            'action' => yii\helpers\Url::to(['site/subscription']),
            'options' => [
                'data-pjax' => true,
            ],
        ]); ?>
        <?=$form->field($model, 'email')->textInput(['placeholder'=>Yii::t('frontend', 'E-mail')])->label(false);?>
        <?=Html::submitButton(' <i class="fa fa-arrow-right subscribe-icon"></i>',  ['class' => 'submit btn btn-default']); ?>
        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
        <div style="clear:both;"></div>
    </div>
</div>
