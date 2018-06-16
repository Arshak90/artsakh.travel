<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ContactForm */

?>
<div class="site-contact">
    <h1><?php echo Html::encode($this->title) ?></h1>
    <section class="page-head section-img contact-us-bg">
        <div class="gradient gradient-vr-56">
            <div class="container">
                <div class="text-block">
                    <h1>Contact us</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-us-page">
        <div class="container">
<!--            <form action="">-->
                <div class="row">
                    <div class="col-md-offset-2 col-md-6 col-sm-7">
                        <div class="contact-form">
                            <h3>Contact Form</h3>
                            <?php $form = ActiveForm::begin(['id' => 'contact-form','enableClientValidation'=> false]); ?>
                                <div class="contact-form-item">
                                    <?php echo $form->field($model, 'name')->input('text',['placeholder'=>'Your Name','class' => 'contact'])->label(false) ?>
                                </div>
                                <div class="contact-form-item">
                                    <?php echo $form->field($model, 'email')->input('text', ['placeholder'=>'Your Email','class' => 'contact'])->label(false) ?>
                                </div>
                                <div class="contact-form-item">
                                    <?php echo $form->field($model, 'body')->textArea(['rows' => 6,'placeholder'=>'Your Message','class' => 'contact'])->label(false) ?>
                                </div>
                                <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                ]) ?>
                                <div class="contact-form-item">
                                    <?php echo Html::submitButton(Yii::t('frontend', 'send'), ['class' => 'main-btn', 'name' => 'contact-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <div class="contact-information">
                            <div class="contact-information-item">
                                <h4>Email</h4>
                                <p>artsakh.@travel.as</p>
                                <p>artsakh.@travel.as</p>
                            </div>
                            <div class="contact-information-item">
                                <h4>Phone</h4>
                                <p>+374 94 22 33 11</p>
                                <p>+374 94 24 74 56</p>
                            </div>
                            <div class="contact-information-item">
                                <h4>Address</h4>
                                <p>24/2 Lusavorich St - Stepanakert</p>
                            </div>
                            <div class="contact-information-item social-icons">
                                <a href="https://www.facebook.com/karabakh.travel/" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="https://twitter.com/KarabakhTravel" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.youtube.com/channel/UC-3u7Wzj2LW6nXFi9zgzIFA" target="_blank">
                                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.instagram.com/karabakhtravelofficial/" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
<!--            </form>-->
        </div>
    </section>


</div>
