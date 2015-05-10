<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_marketing_region".
 *
 * @property integer $id
 * @property string $name
 */
class MMarketingRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_marketing_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['office_total_counter'], 'integer'],
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
    
    public function getMscs()
    {
        return $this->hasMany(MMarketingServiceCenter::className(), ['region_id' => 'id']);               
    }
    
    public function getOfficeCount()
    {
        if (!empty($this->office_total_count)) return $this->office_total_count;
        $count = 0;
        foreach($this->mscs as $msc) {
           $count += $msc->getOfficeCount();
        }
        $this->office_total_count = $count;
        $this->save(false);
        return $count;
    }
    
    public function getDetailedOfficeCount()
    {
        return $this->office_detailed_count;
//        if (!empty($this->office_detailed_count)) return $this->office_detailed_count;
//        $count = 0;
//        foreach($this->mscs as $msc) {
//           $count += $msc->getDetailedOfficeCount();
//        }
//        $this->updateAttributes(['office_detailed_count' => $count]);
//        return $count;
    }
    public function getScoredOfficeCount()
    {
        $count = 0;
        foreach($this->mscs as $msc) {
           $count += $msc->getScoredOfficeCount();
        }
        return $count;
    }
     public function getScoredOfficeCountByScorer($scorer_id)
    {
        $count = 0;
        foreach($this->mscs as $msc) {
           $count += $msc->getScoredOfficeCountByScorer($scorer_id);
        }
        return $count;
    }
}
