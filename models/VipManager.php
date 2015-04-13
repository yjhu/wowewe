<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_vipmanager".
 *
 * @property integer $vipmamnager_id
 * @property integer $vip_id
 * @property integer $manager_id
 */
class Vipmanager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_vipmanager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vip_id', 'manager_id'], 'required'],
            [['vip_id', 'manager_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vipmamnager_id' => 'Vipmamnager ID',
            'vip_id' => 'Vip ID',
            'manager_id' => 'Manager ID',
        ];
    }

    public function getVip()
    {
        return $this->hasOne(Vip::className(), ['vip_id' => 'vip_id']);
    }

    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['manager_id' => 'manager_id']);
    }


}
