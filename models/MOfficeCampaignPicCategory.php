<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_campaign_pic_category".
 *
 * @property integer $id
 * @property string $name
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
        ];
    }
}
