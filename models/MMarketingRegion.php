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
    
    public function getOffices()
    {
        return $this->hasMany(MOffice::className(), ['office_id' => 'office_id'])
                ->viaTable('wx_rel_office_msc', ['msc_id' => 'id']);
    }
}
