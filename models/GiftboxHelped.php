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
    
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $giftbox = GiftboxClaimed::findOne(['id' => $this->giftbox_id]);
            if ($giftbox->isCompleted()) {
                $giftbox->updateAttributes(['status' => GiftboxClaimed::STATUS_COMPLETED]);
            }
        }
    }
    
    public static function toHelpAjax($giftbox_id, $gh_id, $openid) {
        $helping = self::findOne([
            'giftbox_id' => $giftbox_id,
            'helper_ghid' => $gh_id,
            'helper_openid' => $openid,
        ]);
        if (empty($helping) || 
                MGh::GH_XIANGYANGUNICOM_OPENID_YJHU == $openid ||
                MGh::GH_XIANGYANGUNICOM_OPENID_KZENG == $openid) {
            $giftbox = GiftboxClaimed::findOne(['id' => $giftbox_id]);
            if (GiftboxClaimed::STATUS_COMPLETED == $giftbox->status)
                return \yii\helpers\Json::encode(['code' => 0]); 
            $helping = new self;
            $helping->giftbox_id = $giftbox_id;
            $helping->helper_ghid = $gh_id;
            $helping->helper_openid = $openid;
            $helping->helping_time = time();
            $helping->save(false);
            return \yii\helpers\Json::encode(['code' => 0]);
        } else {
            return \yii\helpers\Json::encode([
                'code' => -1,
                'errmsg' => '您已经帮抢了一次。',
            ]);
        }
    }
}
