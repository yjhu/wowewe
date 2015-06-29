<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newfan_reward".
 *
 * @property integer $id
 * @property string $newfan_ghid
 * @property string $newfan_openid
 * @property integer $getting_time
 */
class NewfanReward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newfan_reward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newfan_ghid', 'newfan_openid'], 'required'],
            [['getting_time'], 'integer'],
            [['newfan_ghid', 'newfan_openid'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newfan_ghid' => 'Newfan Ghid',
            'newfan_openid' => 'Newfan Openid',
            'getting_time' => 'Getting Time',
        ];
    }
    
    public function getFan()
    {
        return $this->hasOne(MUser::className(), [
            'gh_id' => 'newfan_ghid',
            'openid' => 'newfan_openid',
        ]);
    }


    public static function rewardconfirmAjax($newfan_openid)
    {
        U::W("=============ivegetit===============");
        U::W($newfan_openid);
        $newfan_reward = self::findOne(['newfan_openid' => $newfan_openid]);
        $newfan_reward->getting_time = time();
        $newfan_reward->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }    
}
