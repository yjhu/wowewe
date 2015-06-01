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
    
    
    public static function getScoreByPicCategory($office_id, $pic_category, $date = null)
    {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate($date);
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate($date);
        
        $scores = self::find()->joinWith('campaignDetail')
                    ->andWhere(['wx_office_campaign_detail.office_id' => $office_id])
                    ->andWhere(['wx_office_campaign_detail.pic_category' => $pic_category])
                    ->andWhere('wx_office_campaign_detail.created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                    ->andWhere('wx_office_campaign_detail.created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                    ->all()
                    ;
        if (empty($scores)) {
            return ['count' => 0, 'total' => 0];
        }
        $count = 0; $total = 0;
        foreach ($scores as $score) {
            $count++;
            $total += $score->score;
        }
        return ['count' => $count, 'total' => $total];
    }

    public static function getScoreByScorerAndPicCategory($office_id, $scorer_id, $pic_category, $date = null)
    {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();

        $score = self::find()->joinWith('campaignDetail')
                    ->andWhere(['wx_office_campaign_detail.office_id' => $office_id])
                    ->andWhere(['wx_office_campaign_detail.pic_category' => $pic_category])
                    ->andWhere(['staff_id' => $scorer_id])
                    ->andWhere('wx_office_campaign_detail.created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                    ->andWhere('wx_office_campaign_detail.created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                    ->one()
                    ;
        if (empty($score)) {
            return false;
        } else {
            return $score->score;
        }            
    }
    
    public static function getCommentByScorerAndPicCategory($office_id, $scorer_id, $pic_category, $date = null)
    {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();

        $score = self::find()->joinWith('campaignDetail')
                    ->andWhere(['wx_office_campaign_detail.office_id' => $office_id])
                    ->andWhere(['wx_office_campaign_detail.pic_category' => $pic_category])
                    ->andWhere(['staff_id' => $scorer_id])
                    ->andWhere('wx_office_campaign_detail.created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                    ->andWhere('wx_office_campaign_detail.created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                    ->one()
                    ;
        if (empty($score)) {
            return false;
        } else {
            return $score->comment;
        }            
    }
    
    
    
    public static function getScoreByScorer($office_id, $scorer_id, $date = null) {
        $office = \app\models\MOffice::findOne(['office_id' => $office_id]);
        $pic_categories = MOfficeCampaignPicCategory::find()->all();
        $total = 0;
        foreach($pic_categories as $pic_category) {
            if ((!$office->is_selfOperated) && $pic_category->sort_order == 6) continue;
            $score = self::getScoreByScorerAndPicCategory($office_id, $scorer_id, $pic_category->id, $date);
            if ($score === false) return false;
            $total += $score;
        }
        return $total;
    }
    
    public static function getScore($office_id, $date = null) {
        $pic_categories = MOfficeCampaignPicCategory::find()->all();
        $office = \app\models\MOffice::findOne(['office_id' => $office_id]);
        $total = 0;
        foreach($pic_categories as $pic_category) {
            if ((!$office->is_selfOperated) && $pic_category->sort_order == 6) continue;
            $scores = self::getScoreByPicCategory($office_id, $pic_category->id, $date);
            if ($scores['count'] == 0) return false;
            $total += $scores['count'] == 1 ? $scores['total'] : $scores['total']/$scores['count'];
        }
        return $total;
    }
    
    public static function getScoreRanking($is_selfOperated = 0, $date = null) {
        $ranking = array();
        $mrs = MMarketingRegion::find()->all();
        foreach($mrs as $mr) {
            foreach($mr->mscs as $msc) {
                foreach($msc->offices as $office) {
                    if ($office->is_selfOperated != $is_selfOperated)continue;
                    $score = self::getScore($office->office_id, $date);
                    if ($score !== false) {
                        $ranking[] = ['office_id' => $office->office_id, 'score' => $score];
                    }
                }
            }
        }
        
        if (count($ranking) == 0) {
            return $ranking;
        }

        $scores = [];
        foreach($ranking as $key => $row) {
            $scores[$key] = $row['score'];
        }        
        array_multisort($scores, SORT_DESC, $ranking);
        //return arsort($ranking);
        return $ranking;
    }
}
