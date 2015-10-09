<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sceneid_mobile".
 *
 * @property integer $scene_id
 * @property string $mobile
 * @property string $ticket
 * @property integer $expire_seconds
 * @property string $url
 * @property string $qr_url
 * @property integer $created_at
 * @property integer $updated_at
 */
class SceneidMobile extends \yii\db\ActiveRecord
{
    const SCENE_LOCK_WAIT_TIME_SECOND = 10;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sceneid_mobile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expire_seconds', 'created_at', 'updated_at'], 'integer'],
            [['mobile'], 'string', 'max' => 11],
            [['ticket', 'url', 'qr_url'], 'string', 'max' => 255],
            [['mobile'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scene_id' => 'Scene ID',
            'mobile' => 'Mobile',
            'ticket' => 'Ticket',
            'expire_seconds' => 'Expire Seconds',
            'url' => 'Url',
            'qr_url' => 'Qr Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public static function getModelBySceneId($sceneid) {
        return self::findOne(['scene_id' => $sceneid]);
    } 
    
    public static function getModelByMobile($mobile) {
        $model = null;
        if (\Yii::$app->mutex->acquire(self::tableName(), self::SCENE_LOCK_WAIT_TIME_SECOND)) {
            $model = self::findOne(['mobile' => $mobile]);
            if (empty($model)) {
                $model = new self;
                $model->mobile = $mobile;
                $model->created_at = time();
                $model->save(false);
            }                    
            \Yii::$app->mutex->release(self::tableName());
            if ($model->updated_at + $model->expire_seconds < time()) {
                $gh_id = MGh::GH_XIANGYANGUNICOM;
                \Yii::$app->wx->setGhId($gh_id); 
                $scene_id = $model->scene_id + 100000;
                $arr = \Yii::$app->wx->WxgetQRCode($scene_id, 0, 300);
                $model->updated_at = time();
                $model->ticket = $arr['ticket'];
                $model->expire_seconds = $arr['expire_seconds'];
                $model->url = $arr['url'];
                $qr_url = \Yii::$app->wx->WxGetQRUrl($arr['ticket']);
                $log_file_path = \Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
                Wechat::downloadFile($qr_url, $log_file_path);
                $model->qr_url = \Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg";
                $model->save(false);
            } 
        } else {
            \Yii::error('acquire lock error');
        }
        return $model;
    }
}
