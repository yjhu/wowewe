<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MStaff;

class MStaffSearch extends Model
{
    public $gh_id;

    public $office_id;
    
    public $name;

    public $mobile;

    public $is_manager;
    
    public function rules()
    {
        return [
            [['gh_id', 'name','mobile', 'office_id', 'is_manager'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = MStaff::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'staff_id' => SORT_ASC,
                ]
            ],

            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);
        
        if (Yii::$app->user->identity->gh_id == 'root')
            U::W('root see staff');
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

        $this->addCondition($query, 'office_id');                    
        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'mobile', true);
        $this->addCondition($query, 'is_manager');                            
        
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
