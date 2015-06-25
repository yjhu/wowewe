<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "giftbox_helped".
 *
 * @property integer $id
 * @property integer $giftbox_id
 * @property string $helper_ghid
 * @property string $helper_openid
 * @property integer $helping_time
 */
class GiftboxHelped extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'giftbox_helped';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['giftbox_id', 'helper_ghid', 'helper_openid'], 'required'],
            [['giftbox_id', 'helping_time'], 'integer'],
            [['helper_ghid', 'helper_openid'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'giftbox_id' => 'Giftbox ID',
            'helper_ghid' => 'Helper Ghid',
            'helper_openid' => 'Helper Openid',
            'helping_time' => 'Helping Time',
        ];
    }
    
    public function getHelper()
    {
        return $this->hasOne(MUser::className(), [
            'gh_id' => 'helper_ghid',
            'openid' => 'helper_openid',
        ]);
    }
}
