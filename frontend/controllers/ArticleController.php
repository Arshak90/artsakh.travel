<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleCategory;
use common\models\ArticleAttachment;
use frontend\models\search\ArticleSearch;
use frontend\models\search\GeneralSearch;
use yii\helpers\Html;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends Controller
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
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = Article::find()->published()->andWhere(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model]);
    }

    public function actionCategoryRouting($category, $slug = null)
    {
        $categoryModel = ArticleCategory::find()->andWhere(['slug' => $category])->one();

        if (!$categoryModel) {
            throw new NotFoundHttpException;
        }
        if ($slug == null) {

            $query = Article::find()->where(['category_id' => $categoryModel->id]);
            $provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => ['created_at' => SORT_DESC]
                ],
            ]);
            return $this->render('index', ['dataProvider' => $provider, 'category' => $categoryModel]);
        } else {
            $model = Article::find()->andWhere(['category_id' => $categoryModel->id])
                ->published()->andWhere(['slug' => $slug])->one();
            if (!$model) {
                throw new NotFoundHttpException;
            }

            $viewFile = $model->view ?: 'view';
            return $this->render($viewFile, ['model' => $model]);
        }

    }

    /**
     * @param $id
     * @return $this
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }
}
