<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_wechat".
 *
 * @property integer $wechat_id
 * @property integer $client_id
 * @property string $gh_id
 */
class ClientWechat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_wechat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['gh_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wechat_id' => 'Wechat ID',
            'client_id' => 'Client ID',
            'gh_id' => 'Gh ID',
        ];
    }
}
