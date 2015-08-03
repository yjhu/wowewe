<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_qingshi_score".
 *
 * @property integer $score_id
 * @property integer $author_openid
 * @property integer $score
 * @property integer $status
 */
class MQingshiScore extends \yii\db\ActiveRecord
{
    const SCORE_NO = 0;
    const SCORE_YES = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_qingshi_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_openid', 'score', 'status'], 'required'],
            [['author_openid'], 'string', 'max' => 255],
            [['score', 'status'], 'integer']
        ];
    }


    public function getUser()
    {
        $model = MUser::findOne(['openid'=>$this->author_openid]);
        return $model;
    }


    static function getQingshiScoreStatusOption($key=null)
    {
        $arr = array(
            self::SCORE_NO => '否',
            self::SCORE_YES => '是',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'score_id' => '编号',
            'author_openid' => 'Author Openid',
            'score' => '获得票数',
            'status' => '是否领奖',
        ];
    }
}
