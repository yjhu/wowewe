<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Custom;

/**
 * CustomSearch represents the model behind the search form about `app\models\Custom`.
 */
class CustomSearch extends Custom
{
    public $is_bind;

    public $subscribe_time_start;    

    public $subscribe_time_end;        

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_id', 'is_vip', 'office_id', 'vip_level_id'], 'integer'],
            [['mobile', 'name', 'vip_join_time', 'vip_start_time', 'vip_end_time'], 'safe'],
            [['is_bind', 'subscribe_time_start', 'subscribe_time_end'],  'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Custom::find();

        $query->joinWith('openidBindMobile');
        $query->leftJoin('wx_user', 'wx_user.gh_id = wx_openid_bind_mobile.gh_id AND wx_user.openid = wx_openid_bind_mobile.openid');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!Yii::$app->user->getIsAdmin()) {
            $this->office_id = Yii::$app->user->identity->office_id;
            $query->andFilterWhere([
                'office_id' => $this->office_id,
            ]);            
        }
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if ($this->is_bind !== '') {
            if ($this->is_bind == 1) {
                //$query->andWhere('wx_openid_bind_mobile.mobile is not null');            
                $query->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]]);
            } else {
                $query->andWhere(['wx_openid_bind_mobile.mobile' => null]);
            }
        }
        
        $query->andFilterWhere([
            'custom_id' => $this->custom_id,
            'is_vip' => $this->is_vip,
            'office_id' => $this->office_id,
            'vip_level_id' => $this->vip_level_id,
        ]);

        $query->andFilterWhere(['like', 'wx_custom.mobile', $this->mobile])            
            ->andFilterWhere(['like', 'name', $this->name]);

        if (trim($this->subscribe_time_start) !== '') {
            $query->andWhere('date(wx_user.create_time)>=:subscribe_time_start', [':subscribe_time_start' => $this->subscribe_time_start]);
        }

        if (trim($this->subscribe_time_end) !== '') {
            $query->andWhere('date(wx_user.create_time)<=:subscribe_time_end', [':subscribe_time_end' => $this->subscribe_time_end]);
        }

        return $dataProvider;
    }

}
