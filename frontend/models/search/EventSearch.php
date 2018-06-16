<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 30.10.2017
 * Time: 16:00
 */

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Event;

class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['slug', 'title_en'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Event::find()->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title_en', $this->title_en]);

        return $dataProvider;
    }

    /**
     * @param $count
     * @return ActiveDataProvider
     */
    public function searchUpcomingEvents($count){
        $query = Event::find()->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere([
            'id' => $this->id,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
        ]);

        return $dataProvider;
    }

}