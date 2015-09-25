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
            [['gh_id', 'openid', 'office_id', 'cat', 'score', 'memo', 'code', 'status'], 'required'],
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
            'create_time' => 'Create Time',
            'score' => 'Score',
            'memo' => 'Memo',
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


}
