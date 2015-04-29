<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_campaign_score".
 *
 * @property integer $id
 * @property string $office_campaign_id
 * @property string $staff_id
 * @property integer $score
 */
class MOfficeCampaignScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_office_campaign_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['office_campaign_id', 'staff_id', 'score'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'office_campaign_id' => 'Office Campaign ID',
            'staff_id' => 'Staff ID',
            'score' => 'Score',
        ];
    }
    
    public function getCampaignDetail()
    {
        return $this->hasOne(MOfficeCampaignDetail::className(), ['id' => 'office_campaign_id']);
    }
}
