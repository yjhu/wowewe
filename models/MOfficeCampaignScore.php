<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_time',
                'updatedAtAttribute' => 'created_time',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }
    
    public function getCampaignDetail()
    {
        return $this->hasOne(MOfficeCampaignDetail::className(), 
                ['id' => 'office_campaign_id']);
    }
    
    const CAMPAIGN_ENDDATE = 25;
    
    public static function getOfficeScoreByOfficeAndPicCategory($office_id, $pic_category, $date = null)
    {
        if ($date == null) $timestamp = time();
        else               $timestamp = strtotime($date);
        
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        $day = date('d', $timestamp);
        if ($day > self::CAMPAIGN_ENDDATE) {
            $month = $month + 1;
            if ($month > 12) {
                $year = $year + 1;
                $month = 1;
            }
        }
       
        $end_time = sprintf("%04d-%02d-%02d 23:59:59", $year, $month, self::CAMPAIGN_ENDDATE);
        $end_date = \DateTime::createFromFormat("Y-m-d H:i:s", $end_time);
        $start_date = clone($end_date);
        $start_date->sub(date_interval_create_from_date_string('1 month'));
//        $start_date = date_sub($start_date, date_interval_create_from_date_string('1 month'));
        
        $scores = self::find()->joinWith('campaignDetail')
                    ->andWhere(['wx_office_campaign_detail.office_id' => $office_id])
                    ->andWhere(['wx_office_campaign_detail.pic_category' => $pic_category])
                    ->andWhere('wx_office_campaign_detail.created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                    ->andWhere('wx_office_campaign_detail.created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                    ->all()
                    ;
        if (empty($scores)) {
            return false;
        }
        
        $count = 0;
        $total = 0;
        foreach ($scores as $score) {
            $count++;
            $total += $score->score;
        }
        return ['count' => $count, 'total' => $total];
    }
}
