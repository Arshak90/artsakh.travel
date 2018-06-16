<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use pudinglabs\tagsinput\TagsinputWidget;


/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $categories common\models\NewsCategory[] */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="article-form">
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'title_en'
            ), ['prompt'=>'']) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'tags')->widget(TagsinputWidget::classname(), [
                'options' => [],
                'clientOptions' => [],
                'clientEvents' => []
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'activity_slug_1')
                ->hint(Yii::t('backend', 'please put Article slug'))
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'activity_slug_2')
                ->hint(Yii::t('backend', 'please put Article slug'))
                ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'activity_slug_3')
                ->hint(Yii::t('backend', 'please put Article slug'))
                ->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
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
        <div class="col-md-4">
            <?php echo $form->field($model, 'thumbnail')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB
                ]);
            ?>
        </div>
    </div>


        <div class="">
            <h3>Multilingual inputs</h3>
            <ul class="nav nav-tabs">
                <?php if ($model->id == null):?>
                    <li class="active"><a data-toggle="tab" href="#home">English</a></li>
                <?php else:?>
                <li><a data-toggle="tab" href="#menu2">Հայերեն</a></li>
                <li><a data-toggle="tab" href="#menu3">Русский</a></li>
                <li><a data-toggle="tab" href="#menu4">Deutsch</a></li>
                <li><a data-toggle="tab" href="#menu5">Français</a></li>
                <li><a data-toggle="tab" href="#menu6">Español</a></li>
                <li><a data-toggle="tab" href="#menu7">العربية</a></li>
                <li><a data-toggle="tab" href="#menu8">Iranian</a></li>
                <?php endif;?>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <?php echo $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_en')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_en')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_en')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_en" lang="en">

                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_hy')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_hy')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_hy')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_hy')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_hy" lang="hy">

                    </div>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_ru')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_ru')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_ru')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_ru" lang="ru">

                    </div>
                </div>
                <div id="menu4" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_de')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_de')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_de')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_de')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_de" lang="de">

                    </div>
                </div>
                <div id="menu5" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_fr')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_fr')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_fr')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_fr')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_fr" lang="fr">

                    </div>
                </div>
                <div id="menu6" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_es')->textInput(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'short_description_es')->textArea(['maxlength' => true]) ?>
                    <?php echo $form->field($model, 'body_es')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_es')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true]) ?>
                    <div class="news-main-block" id="template_es" lang="es">

                    </div>
                </div>
                <div id="menu7" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_ar')->textInput(['maxlength' => true,'dir'=>'rtl']) ?>
                    <?php echo $form->field($model, 'short_description_ar')->textArea(['maxlength' => true, 'dir'=>'rtl']) ?>
                    <?php echo $form->field($model, 'body_ar')->textArea(['maxlength' => true, 'dir'=>'rtl', 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_ar')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true, 'style' => 'display:none']) ?>
                    <div class="news-main-block" id="template_ar" lang="ar">

                    </div>
                </div>
                <div id="menu8" class="tab-pane fade">
                    <?php echo $form->field($model, 'title_fa')->textInput(['maxlength' => true, 'style' => 'display:none']) ?>
                    <?php echo $form->field($model, 'short_description_fa')->textArea(['maxlength' => true, 'style' => 'display:none']) ?>
                    <?php echo $form->field($model, 'body_fa')->textArea(['maxlength' => true, 'style' => 'display:none'])->label(false) ?>
                    <?php echo $form->field($model, 'keywords_fa')
                        ->hint('Please enter the keyword with commas')
                        ->textInput(['maxlength' => true, 'style' => 'display:none']) ?>
                    <div class="news-main-block" id="template_fa" lang="fa">

                    </div>
                </div>
            </div>
        </div>




    <div class="articles-fixed-part">
        <div id="tmpButtons">
            <span class="btn" id="addTemplate1Id">Add tempalate</span>
            <span class="btn" id="addTemplate2Id">Add tempalate 2</span>
            <span class="btn" id="addTemplate3Id">Add tempalate 3</span>
        </div>
        <div class="form-group">
            <?php echo Html::submitButton(
                $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'onclick' => 'updateForm()']) ?>
        </div>
    </div>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal Window</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="src" class="control-label">src:</label>
                            <input type="text" class="form-control" id="src">
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label">alt:</label>
                            <input type="text" class="form-control" id="title"></input>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="save(this)" data-dismiss="modal">Send
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
//        var lang = $(".active.in  [id^='news-body_']")[0].id.toString().slice($(".active.in  [id^='news-body_']")[0].id.indexOf("_") + 1, $(".active.in  [id^='news-body_']")[0].id.length);
        var id = <?= $model->id?>+'';
        if (!!id) {
            $("#tmpButtons").hide();
        }
        var root = document.getElementsByClassName("news-main-block")[0];
        var parser = new DOMParser();
        var template1String = `<img data-toggle="modal" data-target="#myModal" data-title="Feedback" src="https://habrastorage.org/getpro/habr/post_images/c99/663/96d/c9966396d408953ac32e3aa0470b1e9e.jpg" alt="Hyunot">`;

        var template2String = `<p contentEditable="true">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultrices vulputate leo sed malesuada. Donec telltus massa, impe rdiet fermentum massa eu, varius elementum est. Sed blandit ipsum eros, quis vulputate purus malesuada elementum. Vestibulum lacinia nisi vel orci porta, ac dictum ligula aliquet. Aenean in est vulputate, semper leo vel, nean in est vulputate, semper leo vel, aenean in est vulputate, semper leo vel, convallis dui. Aenean metus lectus, volutpat in arcu nec, accumsan molestie nulla. Nullam consectetur sagittis ante vel vestibulum. </p>`;

        var template3String = `<div class="author-words">
                            <i class="fa fa-quote-right" aria-hidden="true"></i>
                            <p contentEditable="true">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultrices vulputate leo sed malesuada. Donec telltus massa, impe rdiet fermentum massa eu, varius elementum est. Sed blandit ipsum eros, quis vulputate purus malesuada elementum. Vestibulum lacinia nisi vel orci.</p>
                        </div>`;

        var selectedImg = {};
        var imgElement = {};
        var deleteIconList = [];
        var list = [];
        $(document).ready(function () {
            $("#myModal").on('show.bs.modal', function (event) {
                imgElement = event.relatedTarget;
                selectedImg.src = event.relatedTarget.src;
                selectedImg.title = event.relatedTarget.alt;
                var button = $(event.relatedTarget);  // Button that triggered the modal
                var titleData = button.data('title'); // Extract value from data-* attributes
                $(this).find('.modal-title').text(titleData + ' Form');
                $(this).find('#src').val(selectedImg.src);
                $(this).find('#title').val(selectedImg.title);
                deleteIconList.push(deletes);
            });
            $("#addTemplate1Id").on('click', function (event) {
                var template1 = parser.parseFromString(template1String, 'text/html').body.firstChild;
                list.push(template1);
                var deletes = parser.parseFromString("<a onclick='deleteElelement(this)' class='remove-button' ><span class='glyphicon glyphicon-remove'></span></a>", 'text/html').body.firstChild;
                root.append(deletes);
                root.append(template1);
                deleteIconList.push(deletes);

            });
            $("#addTemplate2Id").on('click', function (event) {
                var template2 = parser.parseFromString(template2String, 'text/html');
                list.push(template2);
                var deletes = parser.parseFromString("<a onclick='deleteElelement(this)' class='remove-button' ><span class='glyphicon glyphicon-remove'></span></a>", 'text/html').body.firstChild;
                root.append(deletes);
                root.append(template2.body.firstChild);
                deleteIconList.push(deletes);
            });
            $("#addTemplate3Id").on('click', function (event) {
                var template3 = parser.parseFromString(template3String, 'text/html');
                list.push(template3);
                var deletes = parser.parseFromString("<a onclick='deleteElelement(this)' class='remove-button' ><span class='glyphicon glyphicon-remove'></span></a>", 'text/html').body.firstChild;
                root.append(deletes);
                root.append(template3.body.firstChild);
                deleteIconList.push(deletes);
            });
        });

        function save() {
            imgElement.src = $(event.target.parentElement.parentElement).find('#src').val();
            imgElement.title = $(event.target.parentElement.parentElement).find('#title').val();
        }

        function updateForm() {
            $("*[contenteditable*=true]").each(function (item, item2) {
                $(item2).attr("contenteditable", false);
            });
            deleteIconList.forEach(function (item) {
                item.remove();
            });
            $("[id^='news-body_']").each(function (index) {
                var ln = this.id.toString().slice(this.id.indexOf("_") + 1, this.id.length);
                if (!!id) {
                    $("#news-body_" + ln).html($("#template_" + ln).html());
                } else {
                    $("#news-body_" + ln).html($("#template_en").html());
                }
            });
        }

        function deleteElelement(el) {
            el.nextSibling.remove();
            el.remove();
        }

        $("[id^='news-body_']").each(function (index) {
            var ln = this.id.toString().slice(this.id.indexOf("_") + 1, this.id.length);
            if (!!id) {
                $("#template_" + ln).html($("#news-body_" + ln).text())
                ;
            }
        });
        //        root.append(parser.parseFromString($("#bodyId").text(), 'text/html').body);
        $("*[contenteditable*=false]").each(function (item, item2) {
            $(item2).attr("contenteditable", true);
        });

    </script>

    <?php ActiveForm::end(); ?>

</div>