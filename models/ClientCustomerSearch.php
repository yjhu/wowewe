<?php
namespace app\models;

class ClientCustomerSearch extends \yii\base\Model
{
    public $office_id;
    public $customer_name;    
    public $customer_mobile;  
    public $gh_id;
    public $page;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_mobile', 'customer_name', 'office_id', 'gh_id', 'page'], 'safe'],
        ];
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
        $query = \app\models\Custom::find()
                ->join('INNER JOIN', 'wx_openid_bind_mobile', 'wx_openid_bind_mobile.mobile = wx_custom.mobile')
                ->join('INNER JOIN', 'wx_user', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                ->where(['wx_user.subscribe' => 1])
                ->orderBy(['wx_user.create_time' => SORT_DESC]);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,      
            'pagination' => [
                'pageSize'  => 10,
            ], 
        ]); 
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        if (!empty($this->page)) {
            $dataProvider->pagination->page = $this->page;
        }
        
        if (trim($this->gh_id) !== '') {
            $query->andWhere(['wx_user.gh_id'   => $this->gh_id]);
        }
        $this->addCondition($query, 'office_id');         
        return $dataProvider;
    }
    
    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
