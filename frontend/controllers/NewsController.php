<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 20.11.2017
 * Time: 20:46
 */

# var mo
namespace frontend\controllers;


use common\models\Article;
use common\models\News;
use frontend\models\search\NewsSearch;
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{

    public function beforeAction($action){
        $model = new GeneralSearch();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $search = Html::encode($model->search);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'search' => $search]));
        }
        return true;
    }
    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['published_at' => SORT_DESC]
        ];
        $dataProvider->pagination->pageSize = 5;
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = News::find()->published()->andWhere(['slug' => $slug])->one();
        $nextModel = News::find()->published()->andWhere(['>', '{{%news}}.published_at', $model->published_at] )->orderBy('{{%news}}.published_at')->one();
        $latestNews = News::find()
            ->published()
            ->orderBy(['{{%news}}.published_at' => SORT_DESC])
            ->limit(5)
            ->all();
        $activities = array();
        for ($i = 1; $i < 4; $i++){
            if (!is_null(Article::find()->where(['slug' => $model->{'activity_slug_'.$i}])->one())){
                $activities[] = Article::find()->where(['slug' => $model->{'activity_slug_'.$i}])->one();
            }

        }

        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model, 'nextModel' => $nextModel, 'latestNews' => $latestNews, 'activities' => $activities]);
    }
}