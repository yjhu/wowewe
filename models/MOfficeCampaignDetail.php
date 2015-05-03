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


        public function afterDelete()
        {
            $file = $this->getPicFile();
            @unlink($file);
            parent::afterDelete();
        }

        public function getPicFile()
        {
            return Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . self::PHOTO_PATH . DIRECTORY_SEPARATOR . $this->pic_url;
        }

        public function getPicFileSize()
        {
            return filesize($this->getPicFile());
        }

        public function getImageUrl()
        {
            //$gh_id = $this->gh_id;

            $pic_url = $this->pic_url;
            $log_file_path = $this->getPicFile();
            /*
            if ((!file_exists($log_file_path)) || $this->getPicFileSize() == 0|| $this->getPicFileSize() == 47)
            {
                Yii::$app->wx->setGhId($gh_id);    
                Yii::$app->wx->WxMediaDownload($this->media_id, $log_file_path);
            } 
            */                
            $url = Yii::$app->request->getHostInfo() . Yii::$app->request->getBaseUrl() . '/'. self::PHOTO_PATH. '/' ."{$this->pic_url}";
            return $url;
        }

        public static function getDetailByOfficeAndPicCategory($office_id, $pic_category, $date = null) 
        {
            $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
            $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();

            $detail = self::find()
                        ->andWhere(['office_id' => $office_id, 'pic_category' => $pic_category])
                        ->andWhere('created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                        ->andWhere('created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                        ->one();

            return $detail;
        
        }

        const DETAIL_COMPLETE ='complete';
        const DETAIL_IMCOMPLETE = 'imcomplete';
        const DETAIL_PARTIALLY = 'partially';

        public static function getDetailReadyStatus($office_id, $date = null) 
        {
            $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
            $end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();

            $pic_categories = MOfficeCampaignPicCategory::find()->all();
            $category_count = 0; $detail_count = 0;
            foreach($pic_categories as $pic_category) {
                $category_count++;
                $detail = self::find()
                        ->andWhere(['office_id' => $office_id, 'pic_category' => $pic_category->id])
                        ->andWhere('created_time >= :start_time', [':start_time' => $start_date->format("Y-m-d H:i:s")])
                        ->andWhere('created_time < :end_time', [':end_time' => $end_date->format("Y-m-d H:i:s")])
                        ->one();
                if (!empty($detail)) $detail_count++;
            }
            if ($category_count == $detail_count) return self::DETAIL_COMPLETE;
            if ($detail_count == 0) return self::DETAIL_IMCOMPLETE;
            else                    return self::DETAIL_PARTIALLY;
        }

}
