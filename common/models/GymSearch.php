<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gym;

/**
 * GymSearch represents the model behind the search form of `common\models\Gym`.
 */
class GymSearch extends Gym
{

    public $globalSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'globalSearch', 'address', 'email', 'created_at', 'updated_at', 'provincia.nombre_provincia'], 'safe'],
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

    public function attributes()
    {
        return array_merge(parent::attributes(), ['provincia.nombre_provincia']);
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
        $query = Gym::find()->joinWith('provincia p');

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->orFilterWhere(['ilike', 'name', $this->globalSearch])
            ->orFilterWhere(['ilike', 'address', $this->globalSearch])
            ->orFilterWhere(['ilike', 'email', $this->globalSearch])
            ->orFilterWhere(['ilike', 'p.nombre_provincia', $this->globalSearch]);

        return $dataProvider;
    }
}
