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
            $mobiles[] = $rows['mobile'];
        }
        return $mobiles;
    }
}
