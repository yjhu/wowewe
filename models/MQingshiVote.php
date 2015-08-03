<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_qingshi_vote".
 *
 * @property integer $qingshi_vote_id
 * @property string $author_openid
 * @property string $vote_openid
 * @property string $vote_time
 */
class MQingshiVote extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_qingshi_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_openid', 'vote_openid'], 'required'],
            [['vote_time'], 'safe'],
            [['author_openid', 'vote_openid'], 'string', 'max' => 255]
        ];
    }

    public function getUser()
    {
        $model = MUser::findOne(['openid'=>$this->author_openid]);
        return $model;
    }


    public static function toupiaoAjax($author_openid, $vote_openid)
    {
        $qingshi_vote = self::findOne(['vote_openid' => $vote_openid]);

        if(empty($qingshi_vote))
        {
            $qingshi_vote = new \app\models\MQingshiVote;
        }
        else
        {
            //已经投过一次票了，提示用户已投过票，只能每人只能投一次票哟
            return \yii\helpers\Json::encode(['code' => 11]);
        }

        $qingshi_vote->author_openid = $author_openid;
        $qingshi_vote->vote_openid = $vote_openid;
        $qingshi_vote->save(false);

        //写入到投票表中；
        $qingshi_score = \app\models\MQingshiScore::findOne(['author_openid' => $author_openid]);
        U::W($qingshi_score);

        if(empty($qingshi_score))
        {
            $qingshi_score = new \app\models\MQingshiScore;
        }

        $qingshi_score->author_openid = $author_openid;
        $qingshi_score->score = $qingshi_score->score + 1;
        $qingshi_score->status = 0;
        $qingshi_score->save(false);

        return \yii\helpers\Json::encode(['code' => 0]);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qingshi_vote_id' => 'Qingshi Vote ID',
            'author_openid' => 'Author Openid',
            'vote_openid' => 'Vote Openid',
            'vote_time' => 'Vote Time',
        ];
    }
}
