<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MStaff;
use app\models\U;

class MStaffSearch extends Model
{
    public $gh_id;

    public $office_id;
    
    public $name;

    public $mobile;

    public $is_manager;

    public $scene_id;    

    public $cat;        
    
    public function rules()
    {
        return [
            [['gh_id', 'name','mobile', 'office_id', 'is_manager', 'scene_id', 'cat'], 'safe'],
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

        $this->gh_id = Yii::$app->user->getGhid();
        $this->addCondition($query, 'gh_id');        

        if (!Yii::$app->user->getIsAdmin())
        {
            $this->office_id = Yii::$app->user->identity->office_id;
            $this->addCondition($query, 'office_id');                    
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'office_id');
        $this->addCondition($query, 'cat');
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
