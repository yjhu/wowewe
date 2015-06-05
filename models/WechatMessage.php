<?php

namespace app\models;

use Yii;

require_once 'utils/emoji.php';
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
//            $content = $this->content->content;
//            $content = $sender->nickname . "说：" . PHP_EOL . PHP_EOL . $content;
            if (strtotime($reciever->msg_time) > strtotime('-2 days')) {
                if ($reciever->sendWechatMessage($this)) {
                    $this->updateAttributes(['recieve_time' => date('Y-m-d H:i:s')]);
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function getSender() {
        return $this->hasOne(MUser::className(), ['id' => 'sender_id']);
    }
    
    public function getReciever() {
        return $this->hasOne(MUser::className(), ['id' => 'reciever_id']);
    }
    
    public static function getUniqueRecieverIds($sender_id) {
        $messages = self::find()
                ->where(['sender_id' => $sender_id])
                ->orderBy(['send_time' => SORT_DESC])
                ->all();
        $reciever_ids = [];
        foreach ($messages as $message) {
            if (in_array($message->reciever_id, $reciever_ids)) {
                continue;
            } else {
                $reciever_ids[] = $message->reciever_id;
            }
        }
        return $reciever_ids;
    }
    
    public static function getUniqueSenderIds($reciever_id) {
        $messages = self::find()
                ->where(['reciever_id' => $reciever_id])
                ->orderBy(['send_time' => SORT_DESC])
                ->all();
        $sender_ids = [];
        foreach ($messages as $message) {
            if (in_array($message->sender_id, $sender_ids)) {
                continue;
            } else {
                $sender_ids[] = $message->sender_id;
            }
        }
        return $sender_ids;
    }
    
    public static function getUniqueCommunicateeIds($attendee_id) {
        $messages = self::find()
                ->where(['reciever_id' => $attendee_id])
                ->orWhere(['sender_id' => $attendee_id])
                ->orderBy(['send_time' => SORT_DESC])
                ->all();
        $communicatee_ids = [];
        foreach ($messages as $message) {
            if ($message->sender_id == $attendee_id) {
                $communicatee_id = $message->reciever_id;
            } else {
                $communicatee_id = $message->sender_id;
            }
            if (in_array($communicatee_id, $communicatee_ids)) {
                continue;
            } else {
                $communicatee_ids[] = $communicatee_id;
            }
        }
        return $communicatee_ids;
    }
    
    public static function getRecentMessages($sender_id, $reciever_id) {
        $messages = self::find()
            ->where(['sender_id' => $sender_id, 'reciever_id' => $reciever_id])
            ->orWhere(['sender_id' => $reciever_id, 'reciever_id' => $sender_id])
            ->orderBy(['send_time'=>SORT_DESC])
            ->limit(50)
            ->all(); 
        return array_reverse($messages);
    }
    
    public static function getRecentMessagesAjax($sender_id, $reciever_id) {
        $messages = self::getRecentMessages($sender_id, $reciever_id);
        $json_resps = [];
        foreach ($messages as $message) {
            $resp = [];
            if ($message->sender_id == $sender_id) {
                $resp['sending'] = true;
            } else {
                $resp['sending'] = false;
            }
            $resp['msgid'] = $message->message_id;
            $resp['send_time'] = $message->send_time;
            $resp['content'] = emoji_unified_to_html(emoji_softbank_to_unified($message->content->content));
            $json_resps[] = $resp;
        }
        return json_encode($json_resps);
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
        
        return json_encode([
            'code' => 0, 
            'msgid' => $messaging->message_id,
            'send_time' => date('Y-m-d H:i:s'),
            'content'   => emoji_unified_to_html(emoji_softbank_to_unified($content)),
        ]);
    }
}
