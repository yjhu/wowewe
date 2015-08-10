<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClientEmployee;

/**
 * ClientEmployeeSearch represents the model behind the search form about `\app\models\ClientEmployee`.
 */
class ClientEmployeeSearch extends ClientEmployee
{
    public $organization_id = 1;
    public $search_keyword = '';
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id', 'client_id', 'organization_id'], 'integer'],
            [['name', 'search_keyword'], 'safe'],
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
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ClientEmployee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        \Yii::warning('yjhu_debugging: '. \yii\helpers\Json::encode($params));
        \Yii::warning('yjhu_debugging: '. \yii\helpers\Json::encode($this));
        $this->load($params);
        \Yii::warning('yjhu_debugging: '. \yii\helpers\Json::encode($this));

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query = $query->joinWith('organizations');

        $query->andFilterWhere([
            'employee_id' => $this->employee_id,
            'client_id' => $this->client_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        
        $query->andFilterWhere([
            'client_organization.organization_id' => ClientOrganization::findOne(['organization_id' => $this->organization_id])->getSubordinateIdArray(),
        ]);
        
        if (!empty($this->search_keyword)) {
            $query->leftJoin('client_employee_mobile', 'client_employee_mobile.employee_id = client_employee.employee_id');
            $query->andFilterWhere(['like', 'name', $this->search_keyword]);
            $query->orFilterWhere(['like', 'client_employee_mobile.mobile', $this->search_keyword]);
        }
        
        return $dataProvider;
    }
}
