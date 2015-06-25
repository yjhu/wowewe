<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "giftbox_category".
 *
 * @property integer $id
 * @property string $content
 * @property integer $quantity
 * @property integer $remaining
 */
class GiftboxCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'giftbox_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'remaining'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'quantity' => 'Quantity',
            'remaining' => 'Remaining',
        ];
    }
}
