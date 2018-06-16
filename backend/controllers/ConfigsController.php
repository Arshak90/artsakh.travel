<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 17.02.2018
 * Time: 23:17
 */

namespace backend\controllers;

use Yii;
use common\models\HomePageConfigs;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ConfigsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $configs = HomePageConfigs::find()->one();

        if ($configs->load(Yii::$app->request->post()) && $configs->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('index', [
                'configs' => $configs,
            ]);
        }
    }
}