<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_agent".
 *
 * @property integer $agent_id
 * @property string $name
 */
class ClientAgent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_agent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agent_id' => 'Agent ID',
            'name' => 'Name',
        ];
    }
    
    public function getMobiles()
    {
        $mobiles = [];
        $rows = (new \yii\db\Query())->select('mobile')->from('client_agent_mobile')->where([
            'agent_id' => $this->agent_id,
        ])->all();
        foreach ($rows as $row) {
            $mobiles[] = $row['mobile'];
        }
        return $mobiles;
    }
    
    public function getWechat() {
        return \app\models\MUser::find()->join('INNER JOIN', 'wx_openid_bind_mobile', 
            'wx_user.gh_id = wx_openid_bind_mobile.gh_id and wx_user.openid = wx_openid_bind_mobile.openid'
        )->where([
            'in', 'wx_openid_bind_mobile.mobile', $this->mobiles
        ])->one();
    }
    
    public static function addOutletAgent($agent_name, $agent_mobile, $agent_position, $outlet_id) {
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        if (empty($outlet)) return json_encode (['code' => -1, 'errMsg' => "门店不存在！（{$outlet_id}）" ]);
        
        $agent = self::find()->join('INNER JOIN', 'client_agent_mobile', 'client_agent.agent_id=client_agent_mobile.agent_id')->where([
            'name'      => $agent_name,
            'mobile'    => $agent_mobile,
        ])->one();
        if (!empty($agent)) {
            return json_encode([
                'code'      => -1, 
                'errMsg'    => "{$agent_name}({$agent_mobile})已存在！",
            ]);
        } else {
            $agent = new self();
            $agent->name = $agent_name;
            $agent->save(false);
            
            \Yii::$app->db->createCommand()->insert('client_agent_mobile', [
                'agent_id'  => $agent->agent_id,
                'mobile'    => $agent_mobile,
            ])->execute();
            
            $row = (new \yii\db\Query())->select('*')->from('client_agent_outlet')->where([
                'agent_id'  => $agent->agent_id,
                'outlet_id' => $outlet->outlet_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_agent_outlet', [
                    'agent_id'     => $agent->agent_id,
                    'outlet_id'    => $outlet->outlet_id,
                    'position'     => $agent_position,
                ])->execute();
            } else {
                return json_encode([
                    'code'      => -1, 
                    'errMsg'    => "{$agent_name}({$agent_mobile})已存在门店{$outlet_id}中！",
                ]);
            }
            
            return json_encode(['code' => 0]);
        }
        
    }
}
