<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_score_event".
 *
 * @property integer $id
 * @property string $gh_id
 * @property string $openid
 * @property integer $office_id
 * @property integer $cat
 * @property string $create_time
 * @property integer $score
 * @property string $memo
 * @property string $code
 * @property integer $status
 */
class MOfficeScoreEvent extends \yii\db\ActiveRecord
{
    const CAT_ADD_NEW_MEMBER = 0;
    const CAT_ADD_ORDER = 1;
    /*
    *
    *
    */
    /*10元和100元代金卷*/
    const CAT_30YUAN_DAIJINJUAN = 101;
    const CAT_100YUAN_DAIJINJUAN = 102;

    

    const CAT_ADD_NEW_MEMBER_SCORE = 100;
    const CAT_ADD_ORDER_SCORE = 100;
    /*10元和100元代金卷 消减积分数*/
    const CAT_30YUAN_DAIJINJUAN_SCORE = 2000;
    const CAT_100YUAN_DAIJINJUAN_SCORE = 10000;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_office_score_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'openid', 'office_id', 'cat', 'score', 'memo',  'status'], 'required'],
            [['office_id', 'cat', 'score', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['gh_id', 'openid', 'code'], 'string', 'max' => 64],
            [['memo'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gh_id' => 'Gh ID',
            'openid' => 'Openid',
            'office_id' => 'Office ID',
            'cat' => '事件类型',
            'create_time' => '时间',
            'score' => '积分',
            'memo' => '备注',
            'code' => '兑换码',
            'status' => '审核状态',
        ];
    }

    static function getOseStatusOption($key=null)
    {
        $arr = array(
            0 => '未审核',
            1 => '审核成功',
            2 => '审核失败',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    static function getCatNameOption($key=null)
    {
        $arr = array(
            self::CAT_ADD_NEW_MEMBER => '新增会员',
            self::CAT_ADD_ORDER => '会员订单',
            self::CAT_30YUAN_DAIJINJUAN => '30元终端合约优惠券',
            self::CAT_100YUAN_DAIJINJUAN => '100元4G业务代金券',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    static function getOfficeName($model)
    {
        $office = MOffice::findOne(["office_id" => $model->office_id]);
        if(empty($office))
            $title = "--";
        else
            $title = $office->title;

        return $title;
    }
    
    static function getStatusName($model)
    {
        $status = $model->status;
        return self::getOseStatusOption($status);
    }


    public function afterSave($insert, $changedAttributes)
    {
            if($this->status == 1)/*审核失败， 发兑换码 */
            {
                $code = uniqid();
                $this->updateAttributes(['code' => $code]);
            }
            else if ($this->status == 2) /*如果审核失败 ，退还渠道消减的积分*/
            { 
                $office = MOffice::findOne(['office_id' => $this->office_id]);
                if(!empty($office))
                {
                    $office->score = $office->score + $this->score;
                    $office->save();
                }
            }
            else{
                $this->updateAttributes(['code' => ""]);
            }
   

    }



    public static function confirmAjax($office_id, $cat)
    {
        $office = MOffice::findOne(['office_id' => $office_id]);
        if(empty($office))
            $score = 0;
        else
            $score = $office->score;

        if($cat == self::CAT_30YUAN_DAIJINJUAN)
            $dh_score = self::CAT_30YUAN_DAIJINJUAN_SCORE;
        else if($cat == self::CAT_100YUAN_DAIJINJUAN)
            $dh_score = self::CAT_100YUAN_DAIJINJUAN_SCORE;
        else 
            $dh_score =  self::CAT_30YUAN_DAIJINJUAN_SCORE;


        if($score < $dh_score)
        {
             U::W("----------score not enough--------");
             return \yii\helpers\Json::encode(['code' => 1]);
        }
        else
        {
            $office_score_event = new MOfficeScoreEvent;
            $office_score_event->gh_id = 'gh_03a74ac96138';
            $office_score_event->openid = '';
            $office_score_event->office_id = $office_id;
            $office_score_event->cat = $cat;
            $office_score_event->score = $dh_score;
            $office_score_event->memo = self::getCatNameOption($cat);
            $office_score_event->status = 0;
            $office_score_event->code = '';
            $office_score_event->create_time = date('y-m-d h:i:s',time());
            $office_score_event->save(false);

            $office = MOffice::findOne(['office_id' => $office_id]);
            $office->score = $office->score - $dh_score;
            $office->save(false);
        }

        return \yii\helpers\Json::encode(['code' => 0]);
    }



}
