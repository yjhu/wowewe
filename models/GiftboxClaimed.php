<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "giftbox_claimed".
 *
 * @property integer $id
 * @property string $claimer_ghid
 * @property string $claimer_openid
 * @property integer $claiming_time
 * @property integer $status
 * @property integer $category_id
 * @property integer $getting_time
 */
class GiftboxClaimed extends \yii\db\ActiveRecord
{
    const STATUS_UNDERWAY = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_REWARDING = 3;
    const STATUS_REWARDED = 4;
    
    const NEED_HELPERS_NUM = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'giftbox_claimed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['claimer_ghid', 'claimer_openid', 'claiming_time'], 'required'],
            [['claiming_time', 'status', 'category_id', 'getting_time'], 'integer'],
            [['claimer_ghid', 'claimer_openid'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'claimer_ghid' => 'Claimer Ghid',
            'claimer_openid' => 'Claimer Openid',
            'claiming_time' => 'Claiming Time',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'getting_time' => 'Getting Time',
        ];
    }
    
    public function getClaimer() 
    {
        return $this->hasOne(MUser::className(), [
            'gh_id' => 'claimer_ghid',
            'openid' => 'claimer_openid',
        ]);
    }
    
    public function getGiftboxCategory()
    {
        return $this->hasOne(GiftboxCategory::className(), [
            'id' => 'category_id',
        ]);
    }
    
    public function getHelpers() 
    {
        return $this->hasMany(GiftboxHelped::className(), [
            'giftbox_id' => 'id',
        ]);
    }
    
    public function getHelpersNumber() 
    {
        return GiftboxHelped::find()->where([
            'giftbox_id' => $this->id,
        ])->count();
    }
    
    public function getHelpersNeeded() 
    {
        return self::NEED_HELPERS_NUM - $this->getHelpersNumber();
    }
    
    public function isCompleted()
    {
        return $this->getHelpersNumber() == self::NEED_HELPERS_NUM;
    }
    
    public static function thatsitAjax($giftbox_id, $giftbox_catid)
    {
        $giftbox = self::findOne(['id' => $giftbox_id]);
        $giftbox->category_id = $giftbox_catid;
        $giftbox->status = self::STATUS_REWARDING;
        $giftbox->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }
    
    public static function ivegetitAjax($giftbox_id)
    {
        $giftbox = self::findOne(['id' => $giftbox_id]);
        $giftbox->getting_time = time();
        $giftbox->status = self::STATUS_REWARDED;
        $giftbox->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }
}
