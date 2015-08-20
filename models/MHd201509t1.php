<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_hd201509t1".
 *
 * @property integer $hd201509_id
 * @property string $mobile
 */
class MHd201509t1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_hd201509t1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile'], 'required'],
            [['mobile'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hd201509_id' => 'Hd201509 ID',
            'mobile' => 'Mobile',
        ];
    }
}
