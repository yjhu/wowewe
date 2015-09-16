<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_hd201509t2".
 *
 * @property integer $hd201509t2_id
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 * @property string $create_time
 * @property integer $status
 */
class MHd201509t2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_hd201509t2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'openid', 'mobile', 'status'], 'required'],
            [['create_time'], 'safe'],
            [['status'], 'integer'],
            [['gh_id', 'openid'], 'string', 'max' => 255],
            [['yfzx'], 'string', 'max' => 128],
            [['fsc'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hd201509t2_id' => '编号',
            'gh_id' => 'Gh ID',
            'openid' => 'Openid',
            'mobile' => '手机号码',
            'yfzx' => '营服中心',
            'fsc' => '分市场',
            'create_time' => '时间',
            'status' => '充值状态',
        ];
    }


    public static function confirmAjax($openid)
    {
        $hd201509t2 = self::findOne(['openid' => $openid]);

        if(empty($hd201509t2))
        {
            U::W("----------hd201509t2 is null--------");
             return \yii\helpers\Json::encode(['code' => 1]);
        }

        $hd201509t2->status = 1;
        $hd201509t2->create_time = date('y-m-d h:i:s',time());
        $hd201509t2->save(false);

        return \yii\helpers\Json::encode(['code' => 0]);
    }


    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        return $model;
    }



    static function getHd201509t2StatusOption($key=null)
    {
        $arr = array(
            0 => '否',
            1 => '是',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

}
