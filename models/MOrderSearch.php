<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MOrder;

class MOrderSearch extends Model
{
    public $gh_id;

    public $office_id;
    
    public $oid;

    public $status;

    public $create_time;

    
    public $create_time_2;    

    public $title;

    public $cid;

    public $detail;    

    public $feesum;        

    public $select_mobnum;

    public $memo;

    public $memo_reply;
    
    public $pay_kind;
    
    public $kaitong;

    public $wlgs;

    public $wldh;

    public function rules()
    {
        return [
            [['office_id', 'status', 'cid'], 'integer'],            
            [['gh_id', 'oid','create_time', 'create_time_2', 'title', 'detail', 'feesum', 'memo', 'memo_reply', 'pay_kind','wldh'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MOrder::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    //'name' => SORT_ASC,
                    'oid' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);

        if (Yii::$app->user->identity->gh_id == 'root')
        {
             throw new NotFoundHttpException("Please selected one gh_id for the root first!");
        }
        else if (Yii::$app->user->identity->openid == 'admin')
        {
            $this->gh_id = Yii::$app->user->identity->gh_id;
            $this->addCondition($query, 'gh_id');        
        }
        else if (is_numeric(Yii::$app->user->identity->openid))
        {
            $this->gh_id = Yii::$app->user->identity->gh_id;
            $this->office_id = Yii::$app->user->identity->openid;
            $this->addCondition($query, 'gh_id');        
            $this->addCondition($query, 'office_id');                    
        }
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'oid', true);
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'detail', true);
        $this->addCondition($query, 'feesum');
        $this->addCondition($query, 'cid');        
        $this->addCondition($query, 'pay_kind');        
        $this->addCondition($query, 'memo', true);      
        //$this->addCondition($query, 'wldh');   

        if (trim($this->create_time) !== '') 
        {
            //$query->andWhere(['create_time' => new \yii\db\Expression(date('create_time')) ]);
            $query->andWhere('date(create_time)>=:create_time', [':create_time' => $this->create_time]);
        }

        if (trim($this->create_time_2) !== '') 
        {
            //$query->andWhere(['create_time' => new \yii\db\Expression(date('create_time')) ]);
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
