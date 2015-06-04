<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wechat_message_content".
 *
 * @property integer $content_id
 * @property integer $content_type
 * @property string $content
 */
class WechatMessageContent extends \yii\db\ActiveRecord
{
    const MSGTYPE_TEXT          = 1;
    const MSGTYPE_IMAGE         = 2;
    const MSGTYPE_VOICE         = 3;
    const MSGTYPE_VIDEO         = 4;
    const MSGTYPE_MUSIC         = 5;
    const MSGTYPE_NEWS          = 6;
    const MSGTYPE_SHORTVIDEO    = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_message_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_type'], 'integer'],
            [['content'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'content_type' => 'Content Type',
            'content' => 'Content',
        ];
    }
    
    public function getMessaging()
    {
        return $this->hasMany(WechatMessage::className(), [
            'content_id'    => 'content_id',
        ]);
    }
    
    public function getContentType()
    {
        return $this->content_type;
    }
    
    public function getContentTypeString()
    {
        $strArr = [
            self::MSGTYPE_TEXT          => Wechat::MSGTYPE_TEXT,
            self::MSGTYPE_IMAGE         => Wechat::MSGTYPE_IMAGE,
            self::MSGTYPE_VOICE         => Wechat::MSGTYPE_VOICE,
            self::MSGTYPE_VIDEO         => Wechat::MSGTYPE_VIDEO,
            self::MSGTYPE_MUSIC         => Wechat::MSGTYPE_MUSIC,
            self::MSGTYPE_NEWS          => Wechat::MSGTYPE_NEWS,
            self::MSGTYPE_SHORTVIDEO    => Wechat::MSGTYPE_SHORTVIDEO,
        ];
        return $strArr[$this->content_type];
    }
}
