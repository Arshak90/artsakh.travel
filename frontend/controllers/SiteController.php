<?php
namespace frontend\controllers;

use common\models\Event;
use frontend\models\search\GeneralSearch;
use Yii;
use frontend\models\ContactForm;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\web\Controller;
use common\models\Article;
use common\models\ArticleCategory;
use yii\data\ActiveDataProvider;
use common\models\HomePageConfigs;
use common\models\Slider;
use common\models\News;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale' => [
                'class' => 'common\actions\SetLocaleAction',
                'locales' => array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function beforeAction($action){
        $model = new GeneralSearch();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $search = Html::encode($model->search);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'search' => $search]));
        }
        return true;
    }

    public function actionIndex()
    {
        //Events Section
        $upcoming = Event::find()
            ->published()
            ->andWhere(['>', '{{%event}}.event_date_time',time()] )
            ->orderBy('{{%event}}.event_date_time')
            ->limit(3)
            ->all();

        //Article Regions
        $categoryModelPYT = ArticleCategory::find()->andWhere(['slug' => 'plan-your-trip'])->one();
        $query = Article::find()->where(['category_id' => $categoryModelPYT->id]);
        $providerPYT = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC]
            ],
        ]);

        //Article Sights
        $categoryModelSights = ArticleCategory::find()->andWhere(['slug' => 'sights'])->one();
        $query = Article::find()->where(['category_id' => $categoryModelSights->id]);
        $providerSights = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC]
            ],
        ]);
        //Article Travel Routes
        $categoryModelRoutes = ArticleCategory::find()->andWhere(['slug' => 'travel-routes'])->one();
        $query = Article::find()->where(['category_id' => $categoryModelRoutes->id]);
        $providerRoutes = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC]
            ],
        ]);

        //Article Regions
        $categoryModelRegions = ArticleCategory::find()->andWhere(['slug' => 'regions'])->one();
        $query = Article::find()->where(['category_id' => $categoryModelRegions->id]);
        $providerRegions = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC]
            ],
        ]);

        //Slider
        $sliders = Slider::find()->all();

        //Home page configs
        $configs = HomePageConfigs::find()->one();

        //Find Latest news by config
        $news = News::find()->where(['slug' => $configs->latest_news_slug])->one();
        if (!$news){
            $configs->show_latest_news = 0;
        }

        return $this->render('index', [
            'sliders' => $sliders,
            'sights' => $providerSights,
            'routes' => $providerRoutes,
            'regions' => $providerRegions,
            'dataProviderPYT' => $providerPYT,
            'categoryPYT' => $categoryModelPYT,
            'configs' => $configs,
            'news' => $news,
            'upcoming'=>$upcoming]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options' => ['class' => 'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => \Yii::t('frontend', 'There was an error sending email.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionSubscription()
    {
        $model = new \common\models\Subscription();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $email = Html::encode($model->email);
            $model->email = $email;
            $model->addtime = (string)time();
            if ($model->save()) {
                Yii::$app->response->refresh();
                echo "<p style='color:green'>" . Yii::t('frontend', 'Subscribed!') . "</p>";
                exit;
            }
        } else {
            if ($model->errors['email'][0]) {
                echo "<p style='color:red'>" . $model->errors['email'][0] . "!</p>";
            }
        }
        exit;
    }

    public function actionSearch(){
        $search = Yii::$app->getRequest()->getQueryParam('search');
        $query = Article::find()->published()->where(['like', 'title_'.Yii::$app->language, $search])->where(['like', 'short_description_'.Yii::$app->language, $search]);
        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count()
        ]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('search',[
            'articles' => $articles,
            'search' => $search,
            'pagination' => $pagination
        ]);
    }


}
