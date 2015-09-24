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
}
