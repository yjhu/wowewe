<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MAccessLog;

class MAccessLogSearch extends Model
{
    public $create_time;

    public $create_time_2;    
    
    public $ToUserName;
    
    public $FromUserName;
    
    public $MsgType;
    
    public $Content;
    
    public $Event;
    
    public $EventKey;

    public $scene_pid;
    
    public function rules()
    {
        return [
            [['ToUserName', 'FromUserName','create_time', 'create_time_2', 'MsgType', 'Content', 'Event', 'EventKey'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MAccessLog::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);
/*
        if (Yii::$app->user->identity->gh_id == 'root')
        {
            //U::W('root see order');
        }
        else if (Yii::$app->user->identity->openid == 'admin')
        {
            $this->ToUserName = Yii::$app->user->identity->gh_id;
            $this->addCondition($query, 'ToUserName');        
        }
*/
        $this->MsgType = Wechat::MSGTYPE_EVENT;
        $this->addCondition($query, 'MsgType');

        $this->Event = Wechat::EVENT_SUBSCRIBE;
        $this->addCondition($query, 'Event');
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'FromUserName', true);
/*        
        if (trim($this->create_time) !== '') 
        {
            $query->andWhere('date(create_time)>=:create_time', [':create_time' => $this->create_time]);
        }

        if (trim($this->create_time_2) !== '') 
        {
            $query->andWhere('date(create_time)<=:create_time_2', [':create_time_2' => $this->create_time_2]);
        }
*/        
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
