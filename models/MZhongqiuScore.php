<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_zhongqiu_score".
 *
 * @property integer $score_id
 * @property string $author_openid
 * @property integer $score
 * @property string $create_time
 * @property integer $status
 */
class MZhongqiuScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_zhongqiu_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_openid', 'status'], 'required'],
            [['score', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['author_openid'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'score_id' => 'Score ID',
            'author_openid' => 'Author Openid',
            'score' => 'Score',
            'create_time' => 'Create Time',
            'status' => '领奖状态 0未领奖；1已领奖',
        ];
    }


    public function getUser()
    {
        $model = MUser::findOne(['openid'=>$this->author_openid]);
        return $model;
    }


}
