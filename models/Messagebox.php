<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_messagebox".
 *
 * @property integer $msg_id
 * @property string $title
 * @property string $content
 * @property string $author
 * @property integer $receiver
 */
class Messagebox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_messagebox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'author', 'receiver_type', 'receiver'], 'required'],
            [['content'], 'string'],
            [['receiver_type'], 'integer'],
            [['receiver'], 'integer'],
            [['title'], 'string', 'max' => 256],
            [['author'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg_id' => '消息编号',
            'title' => '标题',
            'content' => '内容',
            'author' => '作者',
            'receiver_type' => '接受者类型',
            'receiver' => '接受者',
        ];
    }
}
