<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MChannel;

class MChannelSearch extends Model
{
    public $id;

    public $gh_id;
    
    public $title;

    public $mobile;

    public $fansCnt;
 
    public function rules()
    {
        return [
            [['id', 'gh_id', 'title','mobile'], 'safe'],
            [['fansCnt'], 'safe'],            
        ];
    }

    public function search($params)
    {
        $query = MChannel::find();

        $query->with('fans');
//        $query->with('fansCnt');
        
//        $subQuery = MUser::find()->select('gh_id as gh_id_x, scene_pid as scene_pid_x, count(*) as fans_cnt')->groupBy(['gh_id', 'scene_pid']);
//        $query->leftJoin(['fansCnt' => $subQuery], 'gh_id=gh_id_x AND scene_id = scene_pid_x');
         
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
                //'attributes' => [
                //    'score','id',
                //]
            ],

            'pagination' => [
                'pageSize' => 20,
            ],            
        ]);
        
        if (Yii::$app->user->identity->gh_id == 'root')
             throw new NotFoundHttpException("Please selected one gh_id for the root first!");
        else if (Yii::$app->user->identity->openid == 'admin')
        {
            $this->gh_id = Yii::$app->user->identity->gh_id;
            $this->addCondition($query, 'gh_id');        
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'mobile', true);

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
