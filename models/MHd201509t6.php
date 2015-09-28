<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_hd201509t6".
 *
 * @property integer $hd201509t6_id
 * @property string $gh_id
 * @property string $openid
 * @property string $mobile
 * @property string $yfzx
 * @property string $fsc
 * @property integer $tcnx
 * @property integer $hbme
 * @property string $create_time
 * @property integer $status
 * @property string $qdbm
 */
class MHd201509t6 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_hd201509t6';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'openid', 'mobile', 'yfzx', 'fsc', 'tcnx', 'hbme', 'status', 'qdbm'], 'required'],
            [['tcnx', 'hbme', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['gh_id', 'openid'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 16],
            [['yfzx', 'fsc'], 'string', 'max' => 128],
            [['qdbm'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hd201509t6_id' => '编号',
            'gh_id' => 'Gh ID',
            'openid' => 'Openid',
            'mobile' => '手机号码',
            'yfzx' => '营服中心',
            'fsc' => '分市场',
            'tcnx' => '套餐类型',
            'hbme' => '红包(元)',
            'create_time' => '时间',
            'status' => '是否领取',
            'qdbm' => '渠道编码',
        ];
    }


    public static function confirmAjax($openid, $qdbm)
    {
        $hd201509t6 = self::findOne(['openid' => $openid]);

        if(empty($hd201509t6))
        {
            U::W("----------hd201509t6 is null--------");
             return \yii\helpers\Json::encode(['code' => 1]);
        }

        $hd201509t6->status = 1;
        $hd201509t6->qdbm = $qdbm;
        $hd201509t6->create_time = date('y-m-d h:i:s',time());
        $hd201509t6->save(false);

        return \yii\helpers\Json::encode(['code' => 0]);
    }


    public static function hangbaoAjax($openid, $tcnx)
    {
        $hd201509t6 = self::findOne(['openid' => $openid]);

        if(empty($hd201509t6))
        {
            U::W("----------hd201509t6 is null--------");
             return \yii\helpers\Json::encode(['code' => 1]);
        }

        //新用户 60：25：15 ---> 75:15:10
        $gailv1 = array(
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,
        50,50,50,50,50,50,50,50,50,50,
        50,50,50,50,50,
        100,100,100,100,100,100,100,100,100,100
        );
        //76套餐以下 95:5:0
        $gailv2 = array(
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,
        50,50,50,50,50
        );
        //76套餐以上 40:40:20
        $gailv3 = array(
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        20,20,20,20,20,20,20,20,20,20,
        50,50,50,50,50,50,50,50,50,50,
        50,50,50,50,50,50,50,50,50,50,
        50,50,50,50,50,50,50,50,50,50,
        50,50,50,50,50,50,50,50,50,50,
        100,100,100,100,100,100,100,100,100,100,
        100,100,100,100,100,100,100,100,100,100
        );

        //echo $a[mt_rand(0,99)];

        if($tcnx == 0)
        {
            $hbme = $gailv1[mt_rand(0,99)];
        }
        else if($tcnx == 1)
        {
            $hbme = $gailv2[mt_rand(0,99)];
        }
        else
        {
            $hbme = $gailv3[mt_rand(0,99)];
        }

        $hd201509t6->status = 0;
        $hd201509t6->hbme = $hbme;
        $hd201509t6->create_time = date('y-m-d h:i:s',time());
        $hd201509t6->save(false);

        return \yii\helpers\Json::encode(['code' => 0]);
    }


    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        return $model;
    }

    static function gethd201509t6StatusOption($key=null)
    {
        $arr = array(
            0 => '未领',
            1 => '已领',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function gethd201509t6TcnxOption($key=null)
    {
        $arr = array(
            0 => '新用户',
            1 => '76元以下套餐',
            2 => '76元以上套餐',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    static function getTcnxName($model)
    {
        return self::gethd201509t6TcnxOption($model->tcnx);
    }

    static function getStatusName($model)
    {
        return self::gethd201509t6StatusOption($model->status);
    }


}
