<?php

namespace common\models;

use common\models\Movements;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MovementsSearch represents the model behind the search form of `common\models\Movements`.
 */
class MovementsSearch extends Movements
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'measure', 'video', 'img', 'type'], 'safe'],
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
    public function search($params, $type)
    {

        $query = Movements::find()->select(['movements.*', 'r.*'])
            ->orderBy('title')
            ->joinWith('records r')
            ->joinWith('users u');

        switch ($type) {
            case 'benchmark':
                $query->where(['type' => 'benchmark']);
                break;
            case 'rms':
                $query->where(['type' => 'rms']);
                break;
            case 'ability':
                $query->where(['type' => 'ability']);
                break;
            case 'mark':
                $query->where(['type' => 'mark']);
                break;
            default:
                $query = Movements::find()
                ->orderBy('title');
                break;
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 16,
            ],
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
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'measure', $this->measure])
            ->andFilterWhere(['ilike', 'video', $this->video])
            ->andFilterWhere(['ilike', 'img', $this->img])
            ->andFilterWhere(['ilike', 'type', $this->type]);

        return $dataProvider;
    }
}
