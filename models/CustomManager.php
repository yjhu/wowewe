<?php

namespace app\models;

use Yii;

/*
DROP TABLE IF EXISTS wx_custom_manager;
CREATE TABLE IF NOT EXISTS wx_custom_manager (
    custom_manager_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    custom_id int(10) unsigned NOT NULL DEFAULT '0',    
    manager_id int(10) unsigned NOT NULL DEFAULT '0',
    UNIQUE KEY idx_custom_id_manager_id(custom_id, manager_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/

/**
 * This is the model class for table "wx_vipmanager".
 *
 * @property integer $vipmamnager_id
 * @property integer $vip_id
 * @property integer $manager_id
 */
class CustomManager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_custom_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_id', 'manager_id'], 'required'],
            [['custom_id', 'manager_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'custom_id' => 'Custom ID',
            'manager_id' => 'Manager ID',
        ];
    }

    public function getCustom()
    {
        return $this->hasOne(Vip::className(), ['custom_id' => 'custom_id']);
    }

    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['manager_id' => 'manager_id']);
    }


}
