<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "newfan_lottery".
 *
 * @property integer $id
 * @property string $newfan_ghid
 * @property string $newfan_openid
 * @property integer $draw_time
 * @property string $draw_content
 * @property integer $getting_time
 */
class NewfanLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newfan_lottery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newfan_ghid', 'newfan_openid', 'draw_time', 'draw_content'], 'required'],
            [['draw_time', 'getting_time'], 'integer'],
            [['newfan_ghid', 'newfan_openid', 'draw_content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newfan_ghid' => 'Newfan Ghid',
            'newfan_openid' => 'Newfan Openid',
            'draw_time' => 'Draw Time',
            'draw_content' => 'Draw Content',
            'getting_time' => 'Getting Time',
        ];
    }
    
    public function getFan()
    {
        return $this->hasOne(MUser::className(), [
            'gh_id' => 'newfan_ghid',
            'openid' => 'newfan_openid',
        ]);
    }
}
