<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_hd201509t4".
 *
 * @property integer $hd201509t4_id
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 * @property integer $score
 * @property string $create_time
 * @property integer $status
 */
class MHd201509t4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_hd201509t4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'openid', 'mobile', 'score', 'status'], 'required'],
            [['score', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['gh_id', 'openid'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hd201509t4_id' => 'Hd201509t4 ID',
            'gh_id' => 'Gh ID',
            'openid' => 'Openid',
            'mobile' => '手机号码',
            'score' => '捐献积分',
            'create_time' => '捐献时间',
            'status' => '捐献状态',
        ];
    }

    public static function confirmAjax($openid,$score)
    {
        $hd201509t4 = self::findOne(['openid' => $openid]);

        if(empty($hd201509t4))
        {
            U::W("----------hd201509t4 is null--------");
             return \yii\helpers\Json::encode(['code' => 1]);
        }

        $hd201509t4->status = 1; //提交状态
        $hd201509t4->score = $score;
        $hd201509t4->create_time = date('y-m-d h:i:s',time());
        $hd201509t4->save(false);

        return \yii\helpers\Json::encode(['code' => 0]);
    }


    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        return $model;
    }

    static function gethd201509t4StatusOption($key=null)
    {
        $arr = array(
            0 => '未提交',
            1 => '已提交',
            2 => '捐献成功',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

}
