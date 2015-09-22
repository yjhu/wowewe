<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_zhongqiu_vote".
 *
 * @property integer $qingshi_vote_id
 * @property string $author_openid
 * @property string $vote_openid
 * @property integer $vote_score
 * @property string $vote_time
 */
class MZhongqiuVote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_zhongqiu_vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_openid', 'vote_openid', 'vote_score'], 'required'],
            [['vote_score'], 'integer'],
            [['vote_time'], 'safe'],
            [['author_openid', 'vote_openid'], 'string', 'max' => 255]
        ];
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
            'vote_score' => 'Vote Score',
            'vote_time' => 'Vote Time',
        ];
    }


    public static function toupiaoAjax($author_openid, $vote_openid, $score)
    {

        $zhongqiu_vote = self::findOne(['vote_openid' => $vote_openid]);

        //U::W("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
        //U::W($zhongqiu_vote);

        //U::W($author_openid);
        //U::W($vote_openid);
        //U::W($score);

        if(empty($zhongqiu_vote))
        {
            $zhongqiu_vote = new \app\models\MZhongqiuVote;
        }
        else
        {
            //已经投过一次票了，提示用户已投过票，只能每人只能投一次票哟
            return \yii\helpers\Json::encode(['code' => 11]);
        }

        $zhongqiu_vote->author_openid = $author_openid;
        $zhongqiu_vote->vote_openid = $vote_openid;
        $zhongqiu_vote->vote_score = $score;
        $zhongqiu_vote->save(false);

        //写入到投票表中；
        $zhongqiu_score = \app\models\MZhongqiuScore::findOne(['author_openid' => $author_openid]);
        //U::W("++++++++++++++++++++++++++++++++++++++++++");
        //U::W($zhongqiu_score);

        if(empty($zhongqiu_score))
        {
            $zhongqiu_score = new \app\models\MZhongqiuScore;
        }

        $zhongqiu_score->author_openid = $author_openid;
        $zhongqiu_score->score = $zhongqiu_score->score + $score;
        $zhongqiu_score->status = 0;
        
        //$zhongqiu_score->create_time = $qa->create_time;
        $zhongqiu_score->save(false);
   

        return \yii\helpers\Json::encode(['code' => 0]);
    }

}
