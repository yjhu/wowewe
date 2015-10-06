<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_helpdoc".
 *
 * @property integer $helpdoc_id
 * @property string $title
 * @property string $content
 * @property integer $sort
 * @property integer $visual
 * @property string $relate
 */
class MHelpdoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_helpdoc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['sort', 'visual'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['relate'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'helpdoc_id' => '文档编号',
            'title' => '标题',
            'content' => '内容',
            'sort' => '排序',
            'visual' => '可见',
            'relate' => '关联主题',
        ];
    }


    static function getVisualOption($key=null)
    {
        $arr = array(
            1 => '显示',
            0 => '隐藏',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


}
