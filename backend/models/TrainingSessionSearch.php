<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingSession;
use Yii;
/**
 * TrainingSessionSearch represents the model behind the search form of `backend\models\TrainingSession`.
 */
class TrainingSessionSearch extends TrainingSession
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'capacity', 'created_by'], 'integer'],
            [['description', 'start_time', 'end_time', 'title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TrainingSession::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $current_day = isset($params['current_date']) ? date('Y-m-d H:i:s',strtotime($params['current_date'])) : '';
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'capacity' => $this->capacity,
            'created_by' => $this->created_by,
        ]);
        if(!empty($current_day))
        {
            //$query=ModelName::find()->andFilterWhere(['<=', 'start_date',$this->date])->andFilterWhere(['>=', 'end_date',$this->date])->all();
            $query->andWhere(['<=', 'start_time',$current_day])->andWhere(['>=', 'end_time',$current_day]);
        }
        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['created_by' => Yii::$app->user->id]);

        return $dataProvider;
    }

}
