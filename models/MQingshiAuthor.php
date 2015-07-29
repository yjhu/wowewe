<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_qingshi_author".
 *
 * @property integer $id
 * @property string $gh_id
 * @property string $author_openid
 * @property string $p1
 * @property string $p2
 * @property string $p3
 * @property string $create_time
 * @property integer $ststus
 */
class MQingshiAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_qingshi_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'author_openid', 'p1', 'p2', 'p3', 'ststus'], 'required'],
            [['create_time'], 'safe'],
            [['ststus'], 'integer'],
            [['gh_id', 'author_openid'], 'string', 'max' => 255],
            [['p1', 'p2', 'p3'], 'string', 'max' => 64]
        ];
    }

    public static function xiehaoleAjax($id,$p1,$p2,$p3)
    {
        $qingshi_author = self::findOne(['id' => $id]);
        $qingshi_author->p1 = $p1;
        $qingshi_author->p2 = $p2;
        $qingshi_author->p3 = $p3;
        $qingshi_author->status = 0;
        $qingshi_author->create_time = time();
        $qingshi_author->save(false);
        
        return \yii\helpers\Json::encode(['code' => 0]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gh_id' => 'Gh ID',
            'author_openid' => 'Author Openid',
            'p1' => 'P1',
            'p2' => 'P2',
            'p3' => 'P3',
            'create_time' => 'Create Time',
            'ststus' => 'Ststus',
        ];
    }
}
