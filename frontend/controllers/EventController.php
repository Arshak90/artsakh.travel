<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 30.10.2017
 * Time: 15:58
 */

namespace frontend\controllers;

use common\models\Event;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;
use frontend\models\search\EventSearch;

class EventController extends Controller
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
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['event_date_time' => SORT_DESC]
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
        $model = Event::find()->published()->andWhere(['slug' => $slug])->one();
        $nextModel = Event::find()->published()->andWhere(['>', '{{%event}}.event_date_time', $model->event_date_time] )->orderBy('{{%event}}.event_date_time')->one();
        $upcoming = Event::find()
            ->published()
            ->andWhere(['>', '{{%event}}.event_date_time',time()] )
            ->orderBy('{{%event}}.event_date_time')
            ->limit(3)
            ->all();

        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model, 'nextModel' => $nextModel, 'upcoming' => $upcoming]);
    }
}