<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_oldcustomer".
 *
 * @property integer $oldcustomer_id
 * @property string $mobile
 * @property string $blank
 */
class MOldcustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_oldcustomer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'blank'], 'required'],
            [['mobile', 'blank'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldcustomer_id' => 'Oldcustomer ID',
            'mobile' => 'Mobile',
            'blank' => 'Blank',
        ];
    }
}
