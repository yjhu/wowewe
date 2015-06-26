<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "giftbox_sharelog".
 *
 * @property integer $id
 * @property integer $giftbox_id
 * @property string $sharer_ghid
 * @property string $sharer_openid
 * @property string $sharing_to
 * @property integer $sharing_time
 */
class GiftboxShareLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'giftbox_sharelog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['giftbox_id', 'sharer_ghid', 'sharer_openid'], 'required'],
            [['giftbox_id', 'sharing_time'], 'integer'],
            [['sharer_ghid', 'sharer_openid', 'sharing_to'], 'string', 'max' => 255]
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
            'sharer_ghid' => 'Sharer Ghid',
            'sharer_openid' => 'Sharer Openid',
            'sharing_to' => 'Sharing To',
            'sharing_time' => 'Sharing Time',
        ];
    }
    
    public static function loggingAjax($giftbox_id, $gh_id, $openid, $shareTo)
    {
        $log = new self;
        $log->giftbox_id = $giftbox_id;
        $log->sharer_ghid = $gh_id;
        $log->sharer_openid = $openid;
        $log->sharing_to = $shareTo;
        $log->sharing_time = time();
        $log->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }
}
