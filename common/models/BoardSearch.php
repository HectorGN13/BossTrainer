<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Board;

/**
 * BoardSearch representa el modelo detrás de la forma de búsqueda de `backend\models\Board`.
 * BoardSearch represents the model behind the search form of `backend\models\Board`.
 */
class BoardSearch extends Board
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['title', 'body'], 'safe'],
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
     * Crea una instancia de data provider con la consulta de búsqueda aplicada
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Board::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title]);
        $query->andFilterWhere(['ilike', 'body', $this->body]);
        $query->andFilterWhere(['created_by' => Yii::$app->user->id]);

        return $dataProvider;
    }
}
