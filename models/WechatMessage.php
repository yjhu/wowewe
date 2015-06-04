<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wechat_message".
 *
 * @property integer $message_id
 * @property string $sender_id
 * @property string $reciever_id
 * @property string $content_id
 * @property string $send_time
 * @property string $recieve_time
 */
class WechatMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_message';
    }
    
    public function behaviors() {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'send_time',
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'reciever_id', 'content_id'], 'integer'],
            [['send_time', 'recieve_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'Message ID',
            'sender_id' => 'Sender ID',
            'reciever_id' => 'Reciever ID',
            'content_id' => 'Content ID',
            'send_time' => 'Send Time',
            'recieve_time' => 'Recieve Time',
        ];
    }
    
    public function getContent()
    {
        return $this->hasOne(WechatMessageContent::className(), [
            'content_id'    => 'content_id',
        ]);
    }
    
    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            $sender = MUser::findOne(['id' => $this->sender_id]);
            $reciever = MUser::findOne(['id' => $this->reciever_id]);
            $content = $this->content->content;
            $content = $sender->nickname . "说：" . PHP_EOL . PHP_EOL . $content;
            if (strtotime($reciever->msg_time) > strtotime('-2 days')) {
                if ($reciever->sendWxm($content)) {
                    $this->updateAttributes(['recieve_time' => date('Y-m-d H:i:s')]);
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
    
    public static function sendMessageAjax($sender_id, $reciever_id, $content_type, $content) {
        $message_content = new WechatMessageContent;
        $message_content->content_type = $content_type;
        $message_content->content = $content;
        $message_content->save(false);
        
        $messaging  = new WechatMessage;
        $messaging->sender_id = $sender_id;
        $messaging->reciever_id = $reciever_id;
        $messaging->content_id = $message_content->content_id;
        $messaging->save(false);
        
        return json_encode(['code' => 0]);
    }
}
