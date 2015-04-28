<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_campaign_pic_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort_order
 */
class MOfficeCampaignPicCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_office_campaign_pic_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort_order'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sort_order' => 'Sort Order',
        ];
    }
}
