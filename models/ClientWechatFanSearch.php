<?php
namespace app\models;

class ClientWechatFanSearch extends \yii\base\Model
{       
    public $nickname;
    public $mobile;
    public $carrier;
    public $province;
    public $city;
    public $create_time_start;
    public $create_time_end;  
    public $gh_id;
    public $office_id;
    public $scene_pid;
    public $searchStr;
    public $page;
    
    public function rules() {
        return [
            [[
                'gh_id', 'nickname', 'mobile', 'carrier', 'province', 'city', 
                'create_time_start', 'create_time_end', 'office_id', 'searchStr',
                'scene_pid','page',
            ], 'safe'],            
        ];
    }

    public function search($params) {
        $query = \app\models\MUser::find()
                ->join('INNER JOIN', 'wx_openid_bind_mobile', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                ->where(['wx_user.subscribe' => 1])
                ->orderBy(['wx_user.create_time' => SORT_DESC]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'         => $query,   
            'pagination'    => [
                'pageSize'  => 10,
            ],
        ]);                 
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
            
        if (!empty($this->page)) {
            $dataProvider->pagination->page = $this->page;            
        }
        
        $this->addCondition($query, 'nickname', true);
        if (!empty($this->gh_id)) {
            $query->andWhere(['wx_user.gh_id' => $this->gh_id]);
        }
        if (!empty($this->office_id)) {
            $query->andWhere(['wx_user.belongto' => $this->office_id]);
        }
             
        $query->andFilterWhere(['like', 'wx_openid_bind_mobile.mobile', $this->mobile]);
        if (trim($this->create_time_start) !== '') 
        {
            $query->andWhere('date(wx_user.create_time)>=:create_time', [':create_time' => $this->create_time_start]);
        }

        if (trim($this->create_time_end) !== '') 
        {
            $query->andWhere('date(wx_user.create_time)<=:create_time_2', [':create_time_2' => $this->create_time_end]);
        }

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
