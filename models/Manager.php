<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_manager".
 *
 * @property integer $manager_id
 * @property string $name
 * @property string $mobile
 */
class Manager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'mobile'], 'required'],
            [['name', 'mobile'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manager_id' => 'Manager ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
        ];
    }

    public function getManagers()
    {
        return $this->hasMany(Vipmanager::className(), ['manager_id' => 'manager_id']);
    }


}
