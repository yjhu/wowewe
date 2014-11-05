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

    public $fansCount;    
    
    public function rules()
    {
        return [
            [['id', 'gh_id', 'title','mobile'], 'safe'],
            [['fansCount'], 'safe'],            
        ];
    }

    public function search($params)
    {
        $query = MChannel::find();
        
// method #1        
//        $query->with('fans');

// method #2
//        $query->with(['fans'=>function($query) { $query->andWhere('subscribe=1'); }]);

// method #3            
       $subQuery = MUser::find()->select('gh_id as gh_id_x, scene_pid as scene_pid_x, count(*) as fans_cnt')->where('scene_pid!=0')->groupBy(['gh_id', 'scene_pid']);
       $query->leftJoin(['wx_user' => $subQuery], 'gh_id=gh_id_x AND scene_id = scene_pid_x');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
//                    'id' => SORT_DESC,
                ],
                'attributes' => [
                    'title',
                    'mobile',
                    'fansCount' => [
                        'asc' => ['wx_user.fans_cnt' => SORT_ASC],
                        'desc' => ['wx_user.fans_cnt' => SORT_DESC],
                    ]
                ]
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
        $query->andFilterWhere(['wx_user.fans_cnt' => $this->fansCount]);        

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
