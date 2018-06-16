
<?php
use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use pudinglabs\tagsinput\TagsinputWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model common\models\Event */
/* @var $categories common\models\ArticleCategory[] */
/* @var $form yii\bootstrap\ActiveForm */


//$this->registerJsFile('/js/map.js');
//
//$this->registerJsFile(
//    'https://maps.googleapis.com/maps/api/js?key=AIzaSyAEHv8JbWzo_67F0eZxQ5niDBpTKqfN7Ec&callback=init'
//);

?>


<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'published_at')->widget(
                DateTimeWidget::className(),
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
                ]
            ) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'status')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'preview')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'thumbnail')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'attachments')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'sortable' => true,
                    'maxFileSize' => 10000000, // 10 MiB
                    'maxNumberOfFiles' => 10
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?php echo $form->field($model, 'ticket_price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?=
            $form->field($model, 'tags')->widget(TagsinputWidget::classname(), [
                'options' => [],
                'clientOptions' => [],
                'clientEvents' => []
            ]);
            ?>
        </div>
    </div>





    <?php echo $form->field($model, 'latitude')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?php echo $form->field($model, 'longitude')->hiddenInput(['maxlength' => true])->label(false) ?>



    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                    $categories,
                    'id',
                    'title_en'
                ), ['prompt'=>'']) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'event_date_time')->widget(
                DateTimeWidget::className(),
                [
                    'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ'
                ]
            ) ?>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 com-xs-12">
        <div id="map" style="    width: 100%;
    height: 400px;">
        </div>
    </div>
<div class="clear"></div>
    <div>
        <h3 style="margin-top: 36px;">Multilingual inputs</h3>
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
                <?php echo $form->field($model, 'body_en')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_en')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_en')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_en')
                            ->hint('Please enter the keyword with commas')
                            ->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_hy')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_hy')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_hy')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_hy')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_hy')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu3" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_ru')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_ru')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_ru')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_ru')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_ru')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu4" class="tab-pane fade">
                <?php echo $form->field($model, 'title_de')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_de')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_de')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_de')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_de')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_de')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu5" class="tab-pane fade">
                <?php echo $form->field($model, 'title_fr')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_fr')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_fr')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_fr')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_fr')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_fr')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu6" class="tab-pane fade">
                <?php echo $form->field($model, 'title_es')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'short_description_es')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'body_es')->textArea() ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_es')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_es')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_es')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div id="menu7" class="tab-pane fade">
                <?php echo $form->field($model, 'title_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'short_description_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'body_ar')->textArea(['dir'=>'rtl']) ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_ar')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                </div>
            </div>
            <div id="menu8" class="tab-pane fade">
                <?php echo $form->field($model, 'title_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'short_description_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                <?php echo $form->field($model, 'body_fa')->textArea(['dir'=>'rtl']) ?>
                <div class="row">
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'location_name_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $form->field($model, 'address_fa')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $form->field($model, 'keywords_fa')->hint('Please enter the keyword with commas')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    </div>
                </div>
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
