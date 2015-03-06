<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use app\models\MUser;

class MUserSearch extends Model
{
    public $id;

    public $gh_id;
    
    public $nickname;

    public $role;

    public $status;

    public $create_time;

    public $create_time_2;
    
    public $update_time;

    public $scene_id;
    
    public $scene_pid;

    public $is_liantongstaff;
    
    public $sign_time;
    
    public $sign_money;
        
    public function rules()
    {
        return [
            [['id', 'role', 'status'], 'integer'],
            [['gh_id', 'nickname', 'create_time', 'create_time_2', 'update_time', 'scene_id', 'scene_pid', 'is_liantongstaff','sign_time','sign_money'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'role' => 'Role',
            'status' => '状态',
            'create_time' => '关注时间',
            'update_time' => '更新时间',
        ];
    }

    public function search($params)
    {
        $query = MUser::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->gh_id = Yii::$app->user->getGhid();
        $this->addCondition($query, 'gh_id');        
        
        if (!Yii::$app->user->getIsAdmin())
        {
            $office = Yii::$app->user->identity;
            $scene_ids = $office->getSceneids();
            $query->andWhere(['scene_pid' => $scene_ids]);
        }

        $query->andWhere(['subscribe' => 1]);                
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'nickname', true);
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'update_time');
        $this->addCondition($query, 'scene_pid');       
        $this->addCondition($query, 'is_liantongstaff');
        
        if (trim($this->create_time) !== '') 
        {
            $query->andWhere('date(create_time)>=:create_time', [':create_time' => $this->create_time]);
        }

        if (trim($this->create_time_2) !== '') 
        {
            $query->andWhere('date(create_time)<=:create_time_2', [':create_time_2' => $this->create_time_2]);
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
