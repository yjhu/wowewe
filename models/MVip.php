<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_vip".
 *
 * @property integer $id
 * @property string $vip_mobile
 * @property string $manager
 * @property string $manager_mobile
 * @property string $vip_level
 */
class MVip extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_vip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_mobile', 'manager', 'manager_mobile', 'vip_level'], 'required'],
            [['vip_mobile', 'manager_mobile'], 'string', 'max' => 16],
            [['manager'], 'string', 'max' => 32],
            [['vip_level'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vip_mobile' => 'vip手机号码',
            'manager' => '客户经理姓名',
            'manager_mobile' => '客户经理手机号码',
            'vip_level' => 'vip级别',
        ];
    }
}
