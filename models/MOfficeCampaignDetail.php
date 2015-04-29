<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_campaign_detail".
 *
 * @property integer $id
 * @property string $office_id
 * @property string $pic_url
 * @property string $pic_category
 * @property string $created_time
 */
class MOfficeCampaignDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_office_campaign_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['office_id', 'pic_category'], 'integer'],
            [['created_time'], 'safe'],
            [['pic_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'office_id' => 'Office ID',
            'pic_url' => 'Pic Url',
            'pic_category' => 'Pic Category',
            'created_time' => 'Created Time',
        ];
    }
    
    public function getPicCategory()
    {
        return $this->hasOne(MOfficeCampaignPicCategory::className(), ['id' => 'pic_category']);
    }
}
