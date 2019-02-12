<?php

namespace app\modules\admin\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\modules\admin\models\Category`.
 */
class CategorySearch extends Category
{
    public $author;
    public $status;
    public $name;
    public $created_at;
    public $updated_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['status'], 'in', 'range' => array_keys(self::getStatuses())],
            [['name', 'created_at', 'updated_at', 'author'], 'string'],
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
        $query = Category::find();
        $query->joinWith('author author');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['author'] = [
            'asc' => ['author.name' => SORT_ASC],
            'desc' => ['author.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //  'status' => $this->status,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'category.name', $this->name]);
        $query->andFilterWhere(['=', 'category.status', $this->status]);
        $query->andFilterWhere(['like', 'category.created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'author.name', $this->author]);

        return $dataProvider;
    }
}
