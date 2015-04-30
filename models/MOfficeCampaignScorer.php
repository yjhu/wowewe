<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_office_campaign_scorer".
 *
 * @property integer $id
 * @property string $name
 * @property string $department
 * @property string $position
 * @property string $mobile
 */
class MOfficeCampaignScorer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_office_campaign_scorer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'department', 'position', 'mobile'], 'string', 'max' => 255]
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
            'department' => 'Department',
            'position' => 'Position',
            'mobile' => 'Mobile',
        ];
    }
}
