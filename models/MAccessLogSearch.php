<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MAccessLog;
use app\models\U;

class MAccessLogSearch extends MAccessLog
{

    public $create_time_2;    

public $user_nickname;

    public function rules()
    {
        return [
            [['scene_pid', 'CreateTime', 'MsgId', 'EventKeyCRC'], 'integer'],
            [['create_time', 'ToUserName', 'FromUserName', 'MsgType', 'Content', 'Event', 'EventKey'], 'safe'],
            [['user_nickname'],  'safe'],            

        ];
    }
/*
    public function attributes()
    {
        return array_merge(parent::attributes(), ['user.nickname']);
    }
*/
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

//        $dataProvider->sort->attributes['user.nickname'] =  ['asc'=>['user.nickname' => SORT_ASC],'desc'=>['user.nickname' => SORT_DESC]];

//$query->select(['wx_user.*','wx_staff.*','wx_access_log.*']);
//$query->select('*');

//        $query->with('user');
        $query->joinWith('user');
//$query->joinWith(['user' => function($query) { $query->from(['user'=>'wx_user']); }]);


//        $query->joinWith('staff');
         $query->leftJoin('wx_staff', 'wx_access_log.ToUserName = wx_staff.gh_id AND wx_access_log.scene_pid = wx_staff.scene_id AND wx_access_log.scene_pid != 0');

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'create_time' => $this->create_time,
            'scene_pid' => $this->scene_pid,
            'CreateTime' => $this->CreateTime,
        ]);

        $query->andFilterWhere(['like', 'ToUserName', $this->ToUserName])
            ->andFilterWhere(['like', 'FromUserName', $this->FromUserName])
            ->andFilterWhere(['like', 'wx_user.nickname', $this->user_nickname])
            ->andFilterWhere(['like', 'MsgType', $this->MsgType])
            ->andFilterWhere(['like', 'Content', $this->Content])
            ->andFilterWhere(['like', 'event', $this->Event])
            ->andFilterWhere(['like', 'EventKey', $this->EventKey]);

        return $dataProvider;
    }

}
