<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_qdbm".
 *
 * @property integer $qdbm_id
 * @property string $gsyf
 * @property string $qdmc
 * @property string $qdbm
 * @property string $blank
 */
class MQdbm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_qdbm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gsyf', 'qdmc', 'qdbm', 'blank'], 'required'],
            [['gsyf', 'qdmc'], 'string', 'max' => 128],
            [['qdbm', 'blank'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qdbm_id' => 'Qdbm ID',
            'gsyf' => '归属营服',
            'qdmc' => '渠道名称',
            'qdbm' => '渠道编码',
            'blank' => '预留字段',
        ];
    }
}
