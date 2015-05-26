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
    
    const PICS_DIRECTORY        = 'outlets';
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
            [['client_id', 'supervision_organization_id', 'category'], 'integer'],
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
            'supervision_organization_id' => 'Supervision Organization ID',
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
    public function deleteEmployee($employee_id) {
        \Yii::$app->db->createCommand()->delete('client_employee_outlet', [
            'employee_id'  => $employee_id,
            'outlet_id'    => $this->outlet_id,
        ])->execute();
        $employee = \app\models\ClientEmployee::findOne(['employee_id' => $employee_id]);
        if (empty($employee->outlets) && empty($employee->organizations)) {
            return $employee->delete();
        }
        return true;
    }
    
    public function alterAgent($agent_id, $mobile, $position) {
        \Yii::$app->db->createCommand()->update('client_agent_mobile', [
            'mobile' => $mobile,
        ], [
            'agent_id' => $agent_id,
        ])->execute();
        \Yii::$app->db->createCommand()->update('client_agent_outlet', [
            'position' => $position,
        ], [
            'agent_id'  => $agent_id,
            'outlet_id' => $this->outlet_id,
        ])->execute();
        
        return true;
    }
    
    public function alterEmployee($employee_id, $mobile, $position) {
        \Yii::$app->db->createCommand()->update('client_employee_mobile', [
            'mobile' => $mobile,
        ], [
            'employee_id' => $employee_id,
        ])->execute();
        \Yii::$app->db->createCommand()->update('client_employee_outlet', [
            'position' => $position,
        ], [
            'employee_id'  => $employee_id,
            'outlet_id'    => $this->outlet_id,
        ])->execute();
        
        return true;
    }
    
    public function deleteAgent($agent_id) {
        \Yii::$app->db->createCommand()->delete('client_agent_outlet', [
            'agent_id'  => $agent_id,
            'outlet_id' => $this->outlet_id,
        ])->execute();
        $agent = \app\models\ClientAgent::findOne(['agent_id' => $agent_id]);
        if (empty($agent->outlets)) {
            return $agent->delete();
        }
        return true;
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
    
    public function getPromoter($gh_id) {
        if (empty($this->original_office_id)) {
            $office = new \app\models\MOffice;
            $office->title = $this->title;
            $office->gh_id = $gh_id;
            $office->save(false);
            $this->updateAttributes(['original_office_id' => $office->office_id]);
        } 
        
        $promoter = \app\models\MStaff::find()->where([
            'office_id'  => $this->original_office_id,
            'gh_id'      => $gh_id,
            'cat'        => \app\models\MStaff::SCENE_CAT_OFFICE,
        ])->one();
        if (empty($promoter)) {
            $promoter = new \app\models\MStaff();
            $promoter->name = $this->title;  
            $promoter->office_id = $this->original_office_id;
            $promoter->gh_id = $gh_id;
            $promoter->cat   = \app\models\MStaff::SCENE_CAT_OFFICE;
            $promoter->save(false);
        }
        return $promoter;      
    }
    
    public function getSupervisionOrganization() {
        return $this->hasOne(\app\models\ClientOrganization::className(), ['organization_id' => 'supervision_organization_id']);
    }
    
    public function setLocation($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        return $this->save(false);
    }
    
    public function getPicPathname($media_id) {
        $pic_fname = $media_id . '.jpg';        
        return \Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'images'. DIRECTORY_SEPARATOR . self::PICS_DIRECTORY . DIRECTORY_SEPARATOR .$pic_fname;
    }
    
    public function getPicUrl($media_id) {
        $pic_fname = $media_id . '.jpg';
        return \Yii::$app->request->getHostInfo() . \Yii::$app->request->getBaseUrl() . '/images/' . self::PICS_DIRECTORY . '/' . $pic_fname;
    }
    
    public function addPics($gh_id, $media_ids) {
        foreach ($media_ids as $media) {
            $pic_pathname = $this->getPicPathname($media);           
            \Yii::$app->wx->setGhId($gh_id);
            \Yii::$app->wx->WxMediaDownload($media, $pic_pathname);
            \app\models\U::compress_image_file($pic_pathname);
        }
        if (empty($this->pics)) $pics = implode(',', $media_ids);
        else                    $pics = $this->pics .','.implode (',', $media_ids);
        $this->updateAttributes(['pics' => $pics]);
    }
    
    public function getPicUrls() {        
         $media_ids = explode(',', $this->pics);
         $urls = [];
         foreach($media_ids as $media_id) {
             $urls[] = $this->getPicUrl($media_id);
         }
         return $urls;
    }
    
    public function deleteAllPics() {
        $media_ids = explode(',', $this->pics);        
        foreach($media_ids as $mediaid) {
            @unlink($this->getPicPathname($mediaid));
        }
        $this->updateAttributes(['pics' => '']);
    }
    
    public function deletePic($media_id) {
        $media_ids = explode(',', $this->pics);        
        foreach($media_ids as $index => $mediaid) {
            if ($media_id == $mediaid) {
                @unlink($this->getPicPathname($mediaid));
                unset($media_ids[$index]);
                break;
            }
        }
        $this->updateAttributes(['pics' => implode(',', $media_ids)]);       
    }
    
    public static function setOutletLocationAjax($outlet_id, $latitude, $longitude) {
        $outlet = self::findOne(['outlet_id' => $outlet_id]);
        if (empty($outlet)) {
            return json_encode(['code' => -1, 'msg' => '该门店为空。']);
        } 
        if ($outlet->setLocation($latitude, $longitude)) {
//            if (empty($outlet->address)) {
                $outlet->updateAttributes(['address' => \app\models\U::getQqAddress($longitude, $latitude)]);
//            }
            return json_encode(['code' => 0, 'msg' => '门店位置已更新。']);
        } else {
            return json_encode(['code' => -1, 'msg' => '门店位置无法保存。']);
        }
    }
    
    public static function setOutletInfoAjax($outlet_id, $telephone, $address) {
        $outlet = self::findOne(['outlet_id' => $outlet_id]);
        if (empty($outlet)) {
            return json_encode(['code' => -1, 'msg' => '该门店为空。']);
        } 
        if (1 == $outlet->updateAttributes([
            'telephone' => $telephone,
            'address'   => $address,
        ])) {
            return json_encode(['code' => 0, 'msg' => '门店信息已更新。']);
        } else {
            return json_encode(['code' => -1, 'msg' => '门店信息保存错误。']);
        }
    }
    
    public static function setOutletPicsAjax($outlet_id, $gh_id, $media_ids, $action) {
//        \app\models\U::W(['setOutletPicsAjax--------------------',$media_ids]);
        if (!is_array($media_ids)) {
            if (is_string($media_ids)) {
                $media_ids = json_decode($media_ids);
            }
        }
        $outlet = self::findOne(['outlet_id' => $outlet_id]);
        if (empty($outlet)) {
            return json_encode(['code' => -1, 'msg' => '该门店为空。']);
        } 
        if ('add' == $action) {
            $outlet->addPics($gh_id, $media_ids);
            return json_encode([
                'code' => 0, 
                'msg' => '图片添加成功。', 
                'values' => $media_ids, 
                'action' => $action]
            );
        } else if ('delete' == $action) {
            foreach($media_ids as $media_id) {
                $outlet->deletePic($media_id);
            }
            return json_encode([
                'code' => 0, 
                'msg' => "图片删除成功。", 
                'values' => $media_ids, 
                'action' => $action
            ]);
        } else if ('replace' == $action){
            $outlet->deleteAllPics();
            $outlet->addPics($gh_id, $media_ids);
            return json_encode([
                'code' => 0, 
                'msg' => '图片添加成功。', 
                'values' => $media_ids, 
                'action' => $action]
            );
        } else {
            return json_encode([
                'code' => -1, 
                'msg' => "操作{$action}不支持！", 
                'action' => $action
            ]);
        }
    }
}
