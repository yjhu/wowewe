<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "woso_client".
 *
 * @property integer $client_id
 * @property string $title
 * @property string $title_abbrev
 * @property string $province
 * @property string $city
 */
class WosoClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'woso_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'title_abbrev', 'province', 'city'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'client_id' => 'Client ID',
            'title' => 'Title',
            'title_abbrev' => 'Title Abbrev',
            'province' => 'Province',
            'city' => 'City',
        ];
    }
    
    public function getWechats() {
        return $this->hasMany(\app\models\ClientWechat::className(), [
            'client_id' => 'client_id',
        ]);
    }
}
