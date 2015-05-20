<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_employee".
 *
 * @property integer $employee_id
 * @property string $name
 * @property integer $client_id
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
            [['client_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'name' => 'Name',
            'client_id' => 'Client ID',
        ];
    }
    
    public function getOrganizations()
    {
        return $this->hasMany(\app\models\ClientOrganization::className(), ['organization_id' => 'organization_id'])
                ->viaTable('client_employee_organization', ['employee_id' => 'employee_id']);
    }
    
    public function getMobiles()
    {
        $mobiles = [];
        $rows = (new \yii\db\Query())->select('*')->from('client_employee_mobile')->where([
            'employee_id' => $this->employee_id,
        ])->all();
        foreach ($rows as $row) {
            $mobiles[] = $row['mobile'];
        }
        return $mobiles;
    }
}
