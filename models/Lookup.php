<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_lookup".
 *
 * @property integer $lookup_id
 * @property integer $cat
 * @property string $name
 * @property integer $cat_val
 * @property integer $sort_order
 */
class Lookup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_lookup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat', 'name', 'cat_val', 'sort_order'], 'required'],
            [['cat', 'cat_val', 'sort_order'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lookup_id' => 'Lookup ID',
            'cat' => 'Cat',
            'name' => 'Name',
            'cat_val' => 'Cat Val',
            'sort_order' => 'Sort Order',
        ];
    }
}
