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
 * @property integer $status
 */
class MQingshiAuthor extends \yii\db\ActiveRecord
{

    const AUDIT_NONE = 0;
    const AUDIT_FAIL = 1;
    const AUDIT_PASS = 2;


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
            [['gh_id', 'author_openid', 'p1', 'p2', 'p3', 'status'], 'required'],
            [['create_time'], 'safe'],
            [['status'], 'integer'],
            [['gh_id', 'author_openid'], 'string', 'max' => 255],
            [['p1', 'p2', 'p3'], 'string', 'max' => 64]
        ];
    }

    static function getQingshiStatusOption($key=null)
    {
        $arr = array(
            self::AUDIT_NONE => '未审核',
            self::AUDIT_FAIL => '审核失败',
            self::AUDIT_PASS => '审核成功',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    public static function xiehaoleAjax($id,$p1,$p2,$p3)
    {
        $qingshi_author = self::findOne(['id' => $id]);
     
        if(!empty($qingshi_author->p1))
        {
            //已经写了诗，提示用户不能再写了，每人一次投稿机会
            return \yii\helpers\Json::encode(['code' => 11]);
        }

        $qingshi_author->p1 = $p1;
        $qingshi_author->p2 = $p2;
        $qingshi_author->p3 = $p3;
        $qingshi_author->status = 0;
        $qingshi_author->save(false);
        
        return \yii\helpers\Json::encode(['code' => 0]);
    }


    public function getUser()
    {
        $model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->author_openid]);
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'gh_id' => 'Gh ID',
            'author_openid' => 'Author Openid',
            'p1' => '第一行',
            'p2' => '第二行',
            'p3' => '第三行',
            'create_time' => '创建时间',
            'status' => '状态',
        ];
    }
}
