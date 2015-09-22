<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_hd201509t5".
 *
 * @property integer $hd201509t5_id
 * @property string $mobile
 * @property string $yfzx
 * @property string $fsc
 * @property integer $tcnx
 */
class MHd201509t5 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_hd201509t5';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'yfzx', 'fsc', 'tcnx'], 'required'],
            [['tcnx'], 'integer'],
            [['mobile'], 'string', 'max' => 16],
            [['yfzx', 'fsc'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hd201509t5_id' => 'Hd201509t5 ID',
            'mobile' => 'Mobile',
            'yfzx' => '营服中心',
            'fsc' => '分市场',
            'tcnx' => '套餐类型',
        ];
    }
}
