<?php

namespace app\models;

use Yii;
use yii\helpers\Json;

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
    
    public function isMsc()
    {
        if (!empty($this->outlets)) return true;
        foreach($this->getDirectSubordinateOrganizations() as $sub) {
            if ($sub->isMsc()) return true;
        }
        return false;
    }
    
    public function getMscIdArray() {
        $result = [];
        if ($this->isMsc()) {
            if (!empty($this->outlets)) {
                $result = array_merge ($result, [$this->organization_id]);
            } else {
                foreach($this->getDirectSubordinateOrganizations() as $sub) {
                    $result = array_merge($result, $sub->getMscIdArray());
                }
            }
        }
        return $result;
    }
    
    public function getSubordinateIdArray() {
        $result = [$this->organization_id];
        foreach($this->getDirectSubordinateOrganizations() as $sub) {
            $result = array_merge($result, $sub->getSubordinateIdArray());
        }        
        return $result;
    }
    
    public function getOutlets()
    {
        return $this->hasMany(\app\models\ClientOutlet::className(), ['supervision_organization_id' => 'organization_id']);
    }
    
    public function getDirectSuperiorOrganizations()
    {
//        return $this->hasMany(\app\models\ClientOrganization::className(), ['organization_id' => 'superior_id'])
//                ->viaTable('client_organization_chart', ['subordinate_id' => 'organization_id']);
        $rows = (new \yii\db\Query())->select('*')->from('client_organization_chart')->where([
            'subordinate_id'   => $this->organization_id,
        ])->all();
        $subordinates = [];
        foreach ($rows as $row) {
            $subordinates[] = self::findOne(['organization_id' => $row['superior_id']]);
        }
        return $subordinates;
        
    }
    
    public function getDirectSubordinateOrganizations()
    {
//        return $this->hasMany(\app\models\ClientOrganization::className(), ['organization_id' => 'subordinate_id'])
//                ->viaTable('client_organization_chart', ['superior_id' => 'organization_id']);
        $rows = (new \yii\db\Query())->select('*')->from('client_organization_chart')->where([
            'superior_id'   => $this->organization_id,
        ])->all();
        $subordinates = [];
        foreach ($rows as $row) {
            $subordinates[] = self::findOne(['organization_id' => $row['subordinate_id']]);
        }
        return $subordinates;
    }
    
    public static function createAjax($client_id, $superior_id, $orgnazation_title) {
        $organization = new self;
        $organization->title = $orgnazation_title;
        $organization->client_id = $client_id;
        $organization->save(false);
        
        \Yii::$app->db->createCommand()->insert('client_organization_chart', [
            'subordinate_id' => $organization->organization_id,
            'superior_id' => $superior_id,
        ])->execute();
        
        return Json::encode(['ret_code' => 0, 'organization_id' => $organization->organization_id]);
    }
    
    public static function renameAjax($organization_id, $orgnazation_title) {
        $organization = self::findOne(['organization_id' => $organization_id]);
        $organization->title = $orgnazation_title;
        $organization->save(false);              
        return Json::encode(['ret_code' => 0]);
    }
    
    public static function deleteAjax($organization_id) {
        $organization = self::findOne(['organization_id' => $organization_id]);
        if (!empty($organization->directSubordinateOrganizations) ||
                !empty($organization->employees) ||
                !empty($organization->outlets)) {
            return Json::encode(['ret_code' => -1]);
        } else {
            \Yii::$app->db->createCommand()
                    ->delete('client_organization_chart', [
                        'subordinate_id' => $organization->organization_id
                    ])->execute();
            $organization->delete();
            return Json::encode(['ret_code' => 0]);
        }
    }
}
