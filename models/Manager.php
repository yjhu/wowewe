<?php

namespace app\models;

use Yii;
/*
DROP TABLE IF EXISTS wx_manager;
CREATE TABLE IF NOT EXISTS wx_manager (
    manager_id int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    mobile VARCHAR(32) NOT NULL DEFAULT '',    
    name VARCHAR(32) NOT NULL DEFAULT '',    
    UNIQUE KEY idx_mobile(mobile)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
*/
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
        return $this->hasMany(CustomManager::className(), ['manager_id' => 'manager_id']);
    }


}
