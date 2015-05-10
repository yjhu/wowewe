<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "wx_office_campaign_detail".
 *
 * @property integer $id
 * @property string $office_id
 * @property string $pic_url
 * @property string $pic_category
 * @property string $created_time
 */
class MOfficeCampaignDetail extends \yii\db\ActiveRecord {

    const PHOTO_PATH = 'office_campaign_detail';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wx_office_campaign_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['office_id', 'pic_category'], 'integer'],
            [['created_time'], 'safe'],
            [['pic_url'], 'string', 'max' => 255]
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

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'office_id' => 'Office ID',
            'pic_url' => 'Pic Url',
            'pic_category' => 'Pic Category',
            'created_time' => 'Created Time',
        ];
    }

    public function getPicCategory() {
        return $this->hasOne(MOfficeCampaignPicCategory::className(), ['id' => 'pic_category']);
    }
    
    public function getOffice() {
        return $this->hasOne(MOffice::className(), ['office_id' => 'office_id']);
    }

    public function afterSave( $insert, $changedAttributes ) {
        if ($insert) {
            if (1 == self::getDetailsCount()) {
                \app\models\MMarketingServiceCenter::updateAll(['office_detailed_count' => 0, 'office_scored_count' => 0]);
                \app\models\MMarketingRegion::updateAll(['office_detailed_count' => 0, 'office_scored_count' => 0]);
            }
            if(self::DETAIL_COMPLETE == self::getDetailReadyStatus($this->office_id)) {
                $office = $this->office;
                $msc = $office->msc;
                $mr = $msc->marketingRegion;
//                if (0 == $msc->office_detailed_count) {
//                    $detailed_count = $msc->getDetailedOfficeCount();
//                    $msc->updateAttributes(['office_detailed_count' => $detailed_count]);
//                } else {
//                    $msc->updateCounters(['office_detailed_count' => 1]);
//                }
//                if ( 0 == $mr->office_detailed_count ) {
//                    $detailed_count = $mr->getDetailedOfficeCount();
//                    $mr->updateAttributes(['office_detailed_count' => $detailed_count]);
//                } else {
//                    $mr->updateCounters(['office_detailed_count' => 1]);
//                }
                $msc->updateCounters(['office_detailed_count' => 1]);
                $mr->updateCounters(['office_detailed_count' => 1]);
                
            }
        }
    }
    
    public function afterDelete() {
        $media_urls = explode(",", $this->pic_url);
        foreach ($media_urls as $media_url) {
            $file = $this->getPicFileByMedia($media_url);
            @unlink($file);
        }
        parent::afterDelete();
    }

    public function getPicFileByMedia($media_url) {
        return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . $media_url;
    }

    public function getPicFile() {
        $media_urls = explode(",", $this->pic_url);
        return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . $media_url[0];
    }

    public function getPicFileSize() {
        return filesize($this->getPicFile());
    }

    public function getImageUrls() {
        $media_urls = explode(",", $this->pic_url);
        $urls = [];
        foreach ($media_urls as $media_url) {
            $urls[] = Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/' . self::PHOTO_PATH . '/' . "{$media_url}";
        }
        return $urls;
    }

    public function getImageUrl() {
        //$gh_id = $this->gh_id;

        $media_urls = explode(",", $this->pic_url);
//            $log_file_path = $this->getPicFile();
        /*
          if ((!file_exists($log_file_path)) || $this->getPicFileSize() == 0|| $this->getPicFileSize() == 47)
          {
          Yii::$app->wx->setGhId($gh_id);
          Yii::$app->wx->WxMediaDownload($this->media_id, $log_file_path);
          }
         */
        $url = Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/' . self::PHOTO_PATH . '/' . "{$media_urls[0]}";
        return $url;
    }
    
    static function getDetailsCount($date = null) {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate($date);
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate($date);

        $count = self::find()
                ->andWhere('created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                ->andWhere('created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                ->count();

        return $count;
    }

    public static function getDetailByOfficeAndPicCategory($office_id, $pic_category, $date = null) {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate($date);
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate($date);

        $detail = self::find()
                ->andWhere(['office_id' => $office_id, 'pic_category' => $pic_category])
                ->andWhere('created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                ->andWhere('created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                ->one();

        return $detail;
    }

    const DETAIL_COMPLETE = 'complete';
    const DETAIL_IMCOMPLETE = 'imcomplete';
    const DETAIL_PARTIALLY = 'partially';

    public static function getDetailReadyStatus($office_id, $date = null) {
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate($date);
        $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate($date);

        $pic_categories = MOfficeCampaignPicCategory::find()->all();
        $office = \app\models\MOffice::findOne(['office_id' => $office_id]);
        $category_count = 0;
        $detail_count = 0;
        foreach ($pic_categories as $pic_category) {
            if ((!$office->is_selfOperated) && $pic_category->sort_order == 6)
                continue;
            $category_count++;
            $detail = self::find()
                    ->andWhere(['office_id' => $office_id, 'pic_category' => $pic_category->id])
                    ->andWhere('created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                    ->andWhere('created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                    ->one();
            if (!empty($detail))
                $detail_count++;
        }
        if ($category_count == $detail_count)
            return self::DETAIL_COMPLETE;
        if ($detail_count == 0)
            return self::DETAIL_IMCOMPLETE;
        else
            return self::DETAIL_PARTIALLY;
    }

}
