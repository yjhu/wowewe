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
class ClientEmployee extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'client_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['client_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'employee_id' => 'Employee ID',
            'name' => 'Name',
            'client_id' => 'Client ID',
        ];
    }

    public function getMobiles() {
        $mobiles = [];
        $rows = (new \yii\db\Query())->select('*')->from('client_employee_mobile')->where([
                    'employee_id' => $this->employee_id,
                ])->all();
        foreach ($rows as $row) {
            $mobiles[] = $row['mobile'];
        }
        return $mobiles;
    }

    public function getOutlets() {
        return $this->hasMany(\app\models\ClientOutlet::className(), [
                    'outlet_id' => 'outlet_id'
                ])->viaTable('client_employee_outlet', [
                    'employee_id' => 'employee_id',
        ]);
    }

    public function getOutletCount() {
        return (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
            'employee_id' => $this->employee_id,
        ])->count();
    }

    public function getOrganizations() {
        return $this->hasMany(\app\models\ClientOrganization::className(), [
                    'organization_id' => 'organization_id'
                ])->viaTable('client_employee_organization', [
                    'employee_id' => 'employee_id',
        ]);
    }
         
    public function getOrganizationCount() {
        return (new \yii\db\Query())->select('*')->from('client_employee_organization')->where([
            'employee_id' => $this->employee_id,
        ])->count();
    }

    public function getOutletPosition($outlet_id) {
        $row = (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
                    'employee_id' => $this->employee_id,
                    'outlet_id' => $outlet_id,
                ])->one();
        if (false === $row)
            return false;
        else
            return $row['position'];
    }

    public function getOrganizationPosition($organization_id) {
        $row = (new \yii\db\Query())->select('*')->from('client_employee_organization')->where([
                    'employee_id' => $this->employee_id,
                    'organization_id' => $organization_id,
                ])->one();
        if (false === $row)
            return false;
        else
            return $row['position'];
    }

    public static function findOneByWechatOpenid($gh_id, $openid) {
        $client_wechat = \app\models\ClientWechat::findOne([
                    'gh_id' => $gh_id,
        ]);
        $woso_client = $client_wechat->client;
        $wx_user = \app\models\MUser::findOne([
                    'gh_id' => $gh_id,
                    'openid' => $openid,
        ]);
        foreach ($wx_user->bindMobileNumbers as $mobile) {
            $employee = self::find()->join('INNER JOIN', 'client_employee_mobile', 
                        'client_employee.employee_id=client_employee_mobile.employee_id'
                    )->where([
                        'client_id' => $woso_client->client_id,
                        'mobile' => $mobile,
                    ])->one();
            if (!empty($employee))
                return $employee;
        }
        return false;
    }
    
    public function getWechat() {
        return \app\models\MUser::find()->join('INNER JOIN', 'wx_openid_bind_mobile', 
            'wx_user.gh_id = wx_openid_bind_mobile.gh_id and wx_user.openid = wx_openid_bind_mobile.openid'
        )->where([
            'in', 'wx_openid_bind_mobile.mobile', $this->mobiles
        ])->andWhere([
            'subscribe' => 1,
        ])->one();
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            \Yii::$app->db->createCommand()->delete('client_employee_outlet', [
                'employee_id' => $this->employee_id,
            ])->execute();
            \Yii::$app->db->createCommand()->delete('client_employee_organization', [
                'employee_id' => $this->employee_id,
            ])->execute();
            \Yii::$app->db->createCommand()->delete('client_employee_mobile', [
                'employee_id' => $this->employee_id,
            ])->execute();
            return true;
        } else {
            return false;
        }
    }
    public static function addOutletEmployee($employee_name, $employee_mobile, $employee_position, $outlet_id) {
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        if (empty($outlet)) return json_encode (['code' => -1, 'errMsg' => "门店不存在！（{$outlet_id}）" ]);
        
        $employee = self::find()->join('INNER JOIN', 'client_employee_mobile', 'client_employee.employee_id=client_employee_mobile.employee_id')->where([
            'name'      => $employee_name,
            'mobile'    => $employee_mobile,
        ])->one();
        if (!empty($employee)) {
            return json_encode([
                'code'      => -1, 
                'errMsg'    => "{$employee_name}({$employee_mobile})已存在！",
            ]);
        } else {
            $employee = new self();
            $employee->name = $employee_name;
            $employee->save(false);
            
            \Yii::$app->db->createCommand()->insert('client_employee_mobile', [
                'employee_id'  => $employee->employee_id,
                'mobile'       => $employee_mobile,
            ])->execute();
            
            $row = (new \yii\db\Query())->select('*')->from('client_employee_outlet')->where([
                'employee_id'  => $employee->employee_id,
                'outlet_id'    => $outlet->outlet_id,
            ])->one();
            if (false === $row) {
                \Yii::$app->db->createCommand()->insert('client_employee_outlet', [
                    'employee_id'  => $employee->employee_id,
                    'outlet_id'    => $outlet->outlet_id,
                    'position'     => $employee_position,
                ])->execute();
            } else {
                return json_encode([
                    'code'      => -1, 
                    'errMsg'    => "{$employee_name}({$employee_mobile})已存在门店{$outlet_id}中！",
                ]);
            }
            
            return json_encode(['code' => 0]);
        }
    }
}
