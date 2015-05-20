<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_outlet".
 *
 * @property integer $outlet_id
 * @property integer $client_id
 * @property integer $supervison_organization_id
 * @property string $title
 * @property string $address
 * @property string $telephone
 * @property integer $category
 * @property double $longitude
 * @property double $latitude
 */
class ClientOutlet extends \yii\db\ActiveRecord
{
    const CATEGORY_SELFOWNED    = 0;    // 自营厅
    const CATEGORY_COOPERATED   = 1;    // 合作厅
    const CATEGORY_BLENDED      = 2;    // 混杂模式
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_outlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'supervison_organization_id', 'category'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['title', 'address', 'telephone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'outlet_id' => 'Outlet ID',
            'client_id' => 'Client ID',
            'supervison_organization_id' => 'Supervison Organization ID',
            'title' => 'Title',
            'address' => 'Address',
            'telephone' => 'Telephone',
            'category' => 'Category',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }
    
    public function getEmployees() {
        return $this->hasMany(\app\models\ClientEmployee::className(), [
            'employee_id' => 'employee_id',
        ])->viaTable('client_employee_outlet', [
            'outlet_id' => 'outlet_id',
        ]);
    }
    
    public function getEmployeeCount() {
        return (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
            'outlet_id' => $this->outlet_id,
        ])->count();
    }
    
    public function getAgents() {
        return $this->hasMany(\app\models\ClientAgent::className(), [
            'agent_id' => 'agent_id',
        ])->viaTable('client_agent_outlet', [
            'outlet_id' => 'outlet_id',
        ]);
    }
    
    public function getAgentCount() {
        return (new \yii\db\Query())->select('*')->from('client_agent_outlet')->where([
            'outlet_id' => $this->outlet_id,
        ])->count();
    }
}
