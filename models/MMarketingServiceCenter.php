<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_msc".
 *
 * @property integer $id
 * @property string $name
 * @property string $region_id
 */
class MMarketingServiceCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_msc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
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
            'region_id' => 'Region ID',
        ];
    }
    
    public function getMarketingRegion()
    {
        return $this->hasOne(MMarketingRegion::className(), ['id' => 'region_id']);
    }

     public function getOffices()
    {
        return $this->hasMany(MOffice::className(), ['office_id' => 'office_id'])
            ->viaTable('wx_rel_office_msc', ['msc_id' => 'id']);
    }
    
    public function getOfficeCount()
    {
        $count = 0;
        foreach($this->offices as $office) {
            if (!empty($office->supervisor)) $count++;
        }
        return $count;
    }
    public function getDetailedOfficeCount()
    {
        $count = 0;
        foreach($this->offices as $office) {
            if (MOfficeCampaignDetail::getDetailReadyStatus($office->office_id) == MOfficeCampaignDetail::DETAIL_COMPLETE)
                $count++;
        }
        return $count;
    }
    public function getScoredOfficeCount()
    {
        $count = 0;
        foreach($this->offices as $office) {
            if (MOfficeCampaignScore::getScore($office->office_id) !== false) $count++;
        }
        return $count;
    }
    public function getScoredOfficeCountByScorer($scorer_id)
    {
        $count = 0;
        foreach($this->offices as $office) {
            if (MOfficeCampaignScore::getScoreByScorer($office->office_id, $scorer_id) !== false) $count++;
        }
        return $count;
    }
  
}
