<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_organization".
 *
 * @property integer $organization_id
 * @property integer $client_id
 * @property string $title
 */
class ClientOrganization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => 'Organization ID',
            'client_id' => 'Client ID',
            'title' => 'Title',
        ];
    }
    
    public function getEmployees()
    {
        return $this->hasMany(\app\models\ClientEmployee::className(), ['employee_id' => 'employee_id'])
                ->viaTable('client_employee_organization', ['organization_id' => 'organization_id']);
    }
    
    public function getDirectSuperiorOrganizations()
    {
        return $this->hasMany(\app\models\ClientOrganization::className(), ['organization_id' => 'superior_id'])
                ->viaTable('client_organization_chart', ['subordinate_id' => 'organization_id']);
        
    }
    
    public function getDirectSubordinateOrganizations()
    {
        return $this->hasMany(\app\models\ClientOrganization::className(), ['organization_id' => 'subordinate_id'])
                ->viaTable('client_organization_chart', ['superior_id' => 'organization_id']);
        
    }
}