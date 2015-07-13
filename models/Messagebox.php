<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_messagebox".
 *
 * @property integer $msg_id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property integer $receiver
 */
class Messagebox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_messagebox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author', 'receiver_type', 'receiver'], 'required'],
            [['content'], 'string'],
            [['receiver_type'], 'integer'],
            [['receiver'], 'integer'],
            [['title'], 'string', 'max' => 256],
            [['author'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg_id' => '消息编号',
            'title' => '标题',
            'content' => '内容',
            'author' => '作者',
            'receiver_type' => '接受者类型',
            'receiver' => '接受者',
        ];
    }


    public static function getReceiverTypeOptionName($key=null)
    {
        $arr = array(
            '0' => '经销商',
            '1' => '粉丝群',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    const PICURL = 'https://mmbiz.qlogo.cn/mmbiz/UoUa8K14mcDycwfU7TaJTYms2PWsXfPrqQBXRRYHIo7B1wlr2PAtMHIyPcQegMHbsT1FR5FwicYgVMia2ia1eVfIg/0?wx_fmt=jpeg';
    public function afterSave($insert, $changedAttributes) {  
        \Yii::warning('yjhu:'.__METHOD__);
        \Yii::warning(\yii\helpers\Json::encode($this));
        if (1 == $this->receiver_type) {
            $wechat = \Yii::$app->user->getWechat();
            \Yii::warning(\yii\helpers\Json::encode($wechat));
            $articles = [
                ['title'=>$this->title, 'description'=>$this->content, 'url'=>'', 'picurl'=>self::PICURL]
            ]; 
            $receivers = MUser::getValidRecvFans($this->receiver);
            \Yii::warning(\yii\helpers\Json::encode($receivers));
            foreach ($receivers as $recvr) {
//                $wechat->WxMessageCustomSendNews($recvr->openid, $articles);
                $ret = $wechat->WxMessageCustomSendNews(MGh::GH_XIANGYANGUNICOM_OPENID_KZENG, $articles);
                \Yii::warning(\yii\helpers\Json::encode($ret));
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function getOfficeNameOptionAll($gh_id, $json = true, $need_prompt = true) {
        $offices = \app\models\MOffice::find()->where("gh_id = :gh_id", [':gh_id' => $gh_id])->asArray()->orderBy(['title' => SORT_ASC])->all();
        $listData = $need_prompt ? ['0' => '全部'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $text = $office['title'];
            $listData[$value] = $text;
        }
        return $json ? json_encode($listData) : $listData;
    }




}
