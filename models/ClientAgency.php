<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_agency".
 *
 * @property integer $id
 * @property string $gh_id
 * @property string $contact_person
 * @property string $msc_brev_name
 * @property string $title
 * @property string $mobile
 */
class ClientAgency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gh_id', 'contact_person', 'msc_brev_name', 'title', 'mobile'], 'string', 'max' => 255]
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
            'contact_person' => 'Contact Person',
            'msc_brev_name' => 'Msc Brev Name',
            'title' => 'Title',
            'mobile' => 'Mobile',
        ];
    }
}
