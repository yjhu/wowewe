<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_vip".
 *
 * @property integer $vip_id
 * @property string $name
 * @property string $mobile
 * @property string $join_time
 * @property string $start_time
 * @property string $end_time
 * @property integer $cat_val
 */
class Vip extends \yii\db\ActiveRecord
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
            [['name', 'mobile', 'cat_val'], 'required'],
            [['join_time', 'start_time', 'end_time'], 'safe'],
            [['cat_val'], 'integer'],
            [['name', 'mobile'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vip_id' => 'Vip ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'join_time' => 'Join Time',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'cat_val' => 'Cat Val',
        ];
    }

    public function getVipmanager()
    {
        return $this->hasOne(Vipmanager::className(), ['vip_id' => 'vip_id']);
    }



}
