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
        $this->hasOne(MMarketingRegion::className(), ['id' => 'region_id']);
    }
}
