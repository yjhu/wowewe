<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_employee".
 *
 * @property integer $id
 * @property string $gh_id
 * @property string $name
 * @property string $department
 * @property string $position
 * @property string $mobile
 */
class ClientEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'name', 'department', 'position', 'mobile'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gh_id' => 'Gh ID',
            'name' => 'Name',
            'department' => 'Department',
            'position' => 'Position',
            'mobile' => 'Mobile',
        ];
    }
}
