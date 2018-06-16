
<?php
use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use pudinglabs\tagsinput\TagsinputWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\bootstrap\ActiveForm */

?>


<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'link')->textInput(['maxlength' => true]) ?>


    <?php echo $form->field($model, 'thumbnail')->widget(
        Upload::className(),
        [
            'url' => ['/file-storage/upload'],
            'maxFileSize' => 5000000, // 5 MiB
        ]);
    ?>

    <?php echo $form->field($model, 'published_at')->widget(
        DateTimeWidget::className(),
        [
            'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
        ]
    ) ?>

    <div class="">
        <h3>Multilingual inputs</h3>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">English</a></li>
            <li><a data-toggle="tab" href="#menu2">Հայերեն</a></li>
            <li><a data-toggle="tab" href="#menu3">Русский</a></li>
            <li><a data-toggle="tab" href="#menu4">Deutsch</a></li>
            <li><a data-toggle="tab" href="#menu5">Français</a></li>
            <li><a data-toggle="tab" href="#menu6">Español</a></li>
            <li><a data-toggle="tab" href="#menu7">العربية</a></li>
            <li><a data-toggle="tab" href="#menu8">Iranian</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_en')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu2" class="tab-pane fade">
                <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_hy')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu3" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_ru')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu4" class="tab-pane fade">
                <?php echo $form->field($model, 'title_de')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_de')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu5" class="tab-pane fade">
                <?php echo $form->field($model, 'title_fr')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_fr')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu6" class="tab-pane fade">
                <?php echo $form->field($model, 'title_es')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_es')->textInput(['maxlength' => true]) ?>
            </div>
            <div id="menu7" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'short_description_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
            </div>
            <div id="menu8" class="tab-pane fade">
                <?php echo $form->field($model, 'title_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'short_description_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton(
            $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
