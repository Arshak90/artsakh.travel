<?php

use yii\bootstrap\Nav;
use common\models\Event;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\GeneralSearch;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php');

$upcoming = Event::find()
    ->published()
    ->andWhere(['>', '{{%event}}.event_date_time', time()])
    ->orderBy('{{%event}}.event_date_time')
    ->limit(3)
    ->all();
$model = new GeneralSearch();
if (Yii::$app->getRequest()->getQueryParam('search') != null) {
    $model->search = Yii::$app->getRequest()->getQueryParam('search');
}

?>
    <header>
        <div class="top-header hidden-xs">
            <div class="black-87">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="contact-us">
                                <a href="/site/contact">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <?= Yii::t('frontend', 'Contact us') ?>
                                </a>
                            </div>
                            <div class="social-icons">
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
                        <div class="col-xs-6">
                            <div class="languages">
                                <?
                                echo Nav::widget([
                                    'options' => ['class' => ''],
                                    'items' => [
                                        [
                                            'label' => Yii::t('frontend', '' . Yii::$app->params['availableLocales'][Yii::$app->language]),
                                            'items' => array_map(function ($code) {
                                                return [
                                                    'label' => Yii::$app->params['availableLocales'][$code],
                                                    'url' => ['/site/set-locale', 'locale' => $code],
                                                    'active' => Yii::$app->language === $code
                                                ];
                                            }, array_keys(Yii::$app->params['availableLocales']))
                                        ]
                                    ]
                                ]);
                                ?>
                                <!--                                <a href="#">-->
                                <!---->
                                <!--                                    <i class="" aria-hidden="true"></i>                  English-->
                                <!--                                </a>-->
                            </div>
                            <div class="calendar">
                                <a href="/events">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <?= Yii::t('frontend', 'Calendar') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header">
            <nav class="navbar navbar-default">
                <div class="container navigation-padding-block">
                    <div class="menu-block">
                        <div class="navbar-header hidden-md">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand hidden-sm" href="/">
                                <img src="/img/main-logo-01-beta.svg" alt="Artsakh travel">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#"><?= Yii::t('frontend', 'About Artsakh') ?></a>
                                    <div class="dropdown-menu-box">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-offset-2 col-md-4 col-xs-12 dropdown-links">
                                                    <div class="ul-item">
                                                        <ul>
                                                            <li>
                                                                <a href="/about/the-republic-of-artsakh"><?= Yii::t('frontend', 'Republic of Artsakh') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/about/from-the-bronze-ages-to-nowadays"><?= Yii::t('frontend', 'From the Bronze age to Nowadays') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/about/geographical-facts"><?= Yii::t('frontend', 'Geographic facts') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/about/religion"><?= Yii::t('frontend', 'Religion') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/about/national-holidays-and-festivals"><?= Yii::t('frontend', 'National holidays and festivals') ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 hidden-sm hidden-xs nav-img">
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-1">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Upcoming Events</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-2">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Tourism Information
                                                                    Centes</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <span class="manu-bg-text hidden-xs nav-img">About Artsakh</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?= Yii::t('frontend', 'Discover') ?></a>
                                    <div class="dropdown-menu-box">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-offset-3 col-md-3 col-xs-12 dropdown-links">
                                                    <div class="ul-item">
                                                        <ul>
                                                            <li class=""><a
                                                                        href="/regions"><?= Yii::t('frontend', 'Regions') ?></a>
                                                            </li>
                                                            <li class=""><a
                                                                        href="/discover/culture"><?= Yii::t('frontend', 'Culture') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/discover/cuisine"><?= Yii::t('frontend', 'Cuisine') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/discover/carpets"><?= Yii::t('frontend', 'Carpets') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/discover/fancywork"><?= Yii::t('frontend', 'Fancywork') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/discover/karabakh-horses"><?= Yii::t('frontend', 'Karabakh horses') ?></a>
                                                            </li>
                                                            <!--                                <li><a href="#">Traces of Great Silk Route</a></li>-->
                                                            <li>
                                                                <a href="/discover/multicultural-heritage-of-artsakh"><?= Yii::t('frontend', 'Multicultural heritage of Artsakh') ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 hidden-sm hidden-xs nav-img">
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-1">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Upcoming Events</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-2">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Tourism Information
                                                                    Centes</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <span class="manu-bg-text hidden-xs nav-img">Discover</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?= Yii::t('frontend', 'Travel routes') ?></a>
                                    <div class="dropdown-menu-box">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-offset-2 col-md-4 col-xs-12 dropdown-links">
                                                    <div class="ul-item">
                                                        <ul>
                                                            <li>
                                                                <a href="/travel-routes/on-your-way-to-stepanakert"><?= Yii::t('frontend', 'On your way to Stepanakert') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/travel-routes/south-tourist-route"><?= Yii::t('frontend', 'Southern travel route') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/travel-routes/northern-tourist-route"><?= Yii::t('frontend', 'Northern Travel route') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/travel-routes/highway-stepanakert-martakert"><?= Yii::t('frontend', 'Stepanakert-Martakert highway') ?></a>
                                                            </li>
                                                            <!--                                <li><a href="#">Stepanakert-Martuni highway</a> </li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 hidden-sm hidden-xs nav-img">
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-1">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Upcoming Events</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-2">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Tourism Information Centes</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <span class="manu-bg-text hidden-xs nav-img">Travel routes</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><?= Yii::t('frontend', 'Things to do') ?></a>
                                    <div class="dropdown-menu-box">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-offset-2 col-md-4 hidden-sm hidden-xs nav-img">
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-1">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Upcoming Events</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-2">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Tourism Information Centes</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-offset-1 col-md-3 col-xs-12  dropdown-links">
                                                    <div class="ul-item">
                                                        <ul>
                                                            <li>
                                                                <a href="#"><?= Yii::t('frontend', 'Cafes and Restaurants') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/museums"><?= Yii::t('frontend', 'Museums and Theatres') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/cultural-sightseeing"><?= Yii::t('frontend', 'Cultural sightseeing') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/archaeological-tourism"><?= Yii::t('frontend', 'Archaeological sightseeing') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/agrotourism"><?= Yii::t('frontend', 'Agrotourism') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/adventure"><?= Yii::t('frontend', 'Adventures') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/things-to-do/religious-tourism"><?= Yii::t('frontend', 'Religious tourism') ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="manu-bg-text hidden-xs nav-img">Things to do</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">Plan your trip</a>
                                    <div class="dropdown-menu-box">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-offset-2 col-md-4 hidden-sm hidden-xs nav-img">
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-1">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Upcoming Events</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="nav-img-item-link">
                                                        <div class="nav-img-item item-2">
                                                            <div class="black-57 flex-center-center">
                                                                <h4>Tourism Information Centes</h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-lg-offset-1 col-md-3 col-xs-12  dropdown-links">
                                                    <div class="ul-item">
                                                        <ul>
                                                            <li>
                                                                <a href="/plan-your-trip/getting-there"><?= Yii::t('frontend', 'Getting there') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/plan-your-trip/entry-formalities"><?= Yii::t('frontend', 'Entry formalities') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><?= Yii::t('frontend', 'Acommodation') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/plan-your-trip/useful"><?= Yii::t('frontend', 'Useful information') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/plan-your-trip/find-me-a-guide"><?= Yii::t('frontend', 'Find me a guide') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="/plan-your-trip/touroperators"><?= Yii::t('frontend', 'Touroperators') ?></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><?= Yii::t('frontend', 'Transportation companies') ?></a>
                                                            </li>
                                                            <li><a href="#"><?= Yii::t('frontend', 'FAQ') ?></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <span class="manu-bg-text hidden-xs nav-img">Travel routes</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php if ($model->search == null) { ?>
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="search hidden-sm hidden-xs">
                                <?= $form->field($model, 'search')->textInput(['class' => 'search-input', 'placeholder' => Yii::t('frontend', 'Search')])->label('')->label(false) ?>
                                <!--                        <i class="fa fa-search" aria-hidden="true"></i>-->
                            </div>
                            <?php ActiveForm::end(); ?>
                        <?php } ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!--    --><? //
//        NavBar::begin(['brandLabel' => 'Travel Artsakh','brandUrl' => Yii::$app->homeUrl,]);
//
//        echo Nav::widget([ 'options' => ['class' => 'navbar-nav navbar-left'],
//                            'items' => PceuropaMenu::NavbarLeft(1)  // argument is id of menu
//                        ]);
//
////        echo Nav::widget([ 'options' => ['class' => 'navbar-nav navbar-right'],
////                            'items' => Menu::NavbarRight(1)
////                        ]);
//        echo Nav::widget([
//                            'options' => ['class' => 'navbar-nav navbar-right'],
//                            'items' => [
//                                [
//                                    'label'=>Yii::t('frontend', 'Language'),
//                                    'items'=>array_map(function ($code) {
//                                        return [
//                                            'label' => Yii::$app->params['availableLocales'][$code],
//                                            'url' => ['/site/set-locale', 'locale'=>$code],
//                                            'active' => Yii::$app->language === $code
//                                        ];
//                                    }, array_keys(Yii::$app->params['availableLocales']))
//                                ]
//                            ]
//                        ]);
//        NavBar::end();
//    ?>


<?php echo $content ?>


    <footer>
        <div class="top-footer">
            <div class="blue-87">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 footer-item">
                            <div class="footer-logo"></div>
                            <p><?= Yii::t('frontend', 'We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.') ?></p>
                            <div class="line"></div>
                            <div>
                                <a href="#">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    support@gmail.com
                                </a>
                            </div>
                            <div class="line"></div>
                            <div>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>+374 97 000 000</span>
                            </div>
                            <div class="line"></div>
                            <div>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span><?= Yii::t('frontend', '24/2 Lusavorich St - Stepanakert') ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 footer-item">
                            <h3><?= Yii::t('frontend', 'Upcoming Events') ?></h3>

                            <?php foreach ($upcoming as $key => $item): ?>

                                <h4 class="pull-left">
                                    <div class="ellipsis">
                                        <?php echo Html::a($item->getMultilingual('title', YII::$app->language), ['/events/' . $item->slug], ['class' => 'calendar-visit-event']) ?>
                                    </div>
                                </h4>
                                <h4 class="pull-right date"><?php echo Yii::$app->formatter->asDate($item->event_date_time, "d MMM") ?></h4>
                                <div class="clear"></div>
                                <p class="event-location"><?= Yii::t('frontend', 'Location') . ': ' . $item->getMultilingual('location_name', YII::$app->language) ?></p>
                                <div class="line"></div>

                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-3 col-sm-12 footer-item">
                            <h3><?= Yii::t('frontend', 'Site Map') ?></h3>
                            <ul class="first-list">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Region
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Culture
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Museumst
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Theatres
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Hotels
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Cuisine
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Events
                                    </a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Region
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Culture
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Museumst
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Theatres
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Hotels
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Cuisine
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Events
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?= common\widgets\SubscriptionWidget::widget() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="container">
                <div class="pull-left">
                    <p>Copyright 2018 © Artsakh.travel. All rights reserved</p>
                </div>
                <div class="pull-right">
                    <p><?= Yii::t('frontend', 'Follow us:') ?></p>
                    <div class="social-icons">
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
    </footer>
<?php $this->endContent() ?>