<?php

namespace app\models;

/*
  DROP TABLE IF EXISTS wx_office;
  CREATE TABLE wx_office (
  office_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gh_id VARCHAR(32) NOT NULL DEFAULT '',
  scene_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '部门的推广id',
  title VARCHAR(128) NOT NULL DEFAULT '',
  branch VARCHAR(128) NOT NULL DEFAULT '',
  region VARCHAR(128) NOT NULL DEFAULT '',
  address VARCHAR(128) NOT NULL DEFAULT '',
  manager VARCHAR(32) NOT NULL DEFAULT '',
  member_cnt int(10) unsigned NOT NULL DEFAULT '0',
  mobile VARCHAR(16) NOT NULL DEFAULT '',
  pswd VARCHAR(16) NOT NULL DEFAULT '123456',
  lat float(10,6) NOT NULL DEFAULT '0.000000',
  lon float(10,6) NOT NULL DEFAULT '0.000000',
  lat_bd09 float(10,6) NOT NULL DEFAULT '0.000000',
  lon_bd09 float(10,6) NOT NULL DEFAULT '0.000000',
  visable tinyint(3) NOT NULL DEFAULT 0,
  is_jingxiaoshang tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '是否是经销商',
  role tinyint(3) unsigned NOT NULL DEFAULT 1,
  status tinyint(3) unsigned NOT NULL DEFAULT 0,
  KEY gh_id_idx(gh_id)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;



  ALTER TABLE wx_gh DROP menu;





  ALTER TABLE wx_office ADD is_jingxiaoshang tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT '是否是经销商';
  ALTER TABLE wx_office ADD role tinyint(3) unsigned NOT NULL DEFAULT 1;
  ALTER TABLE wx_office ADD status tinyint(3) unsigned NOT NULL DEFAULT 0;
  ALTER IGNORE TABLE wx_office ADD UNIQUE KEY idx_gh_id_title(gh_id, title);
  ALTER TABLE wx_channel ADD is_jingxiaoshang tinyint(3) unsigned NOT NULL DEFAULT 1;
  INSERT IGNORE INTO wx_office (gh_id, scene_id, title, mobile, is_jingxiaoshang) SELECT gh_id, scene_id, title, mobile, is_jingxiaoshang FROM wx_channel WHERE gh_id='gh_03a74ac96138';
  ALTER TABLE wx_channel DROP is_jingxiaoshang;
  INSERT INTO wx_office (gh_id, title, role) VALUES ('gh_03a74ac96138', 'root', 9);
  INSERT INTO wx_office (gh_id, title, role) VALUES ('gh_03a74ac96138', 'admin', 2);

  ALTER TABLE wx_staff ADD scene_id int(10) unsigned NOT NULL DEFAULT '0';
  ALTER TABLE wx_staff ADD cat tinyint(3) NOT NULL DEFAULT 0 COMMENT '推广者身份类型, 0:员工, 1:外部推广者';
  ALTER TABLE wx_staff ADD KEY office_id_idx(office_id);
  UPDATE wx_staff t1, wx_user t2 SET t1.scene_id = t2.scene_id WHERE t1.gh_id=t2.gh_id AND t1.openid=t2.openid AND t1.gh_id='gh_03a74ac96138' AND t1.openid!='' AND t2.scene_id!=0;
  //SELECT  t1.gh_id, t1.openid, t1.name, t1.scene_id, t2.gh_id,t2.openid,t2.nickname, t2.scene_id FROM wx_staff t1 INNER JOIN wx_user t2 ON t1.gh_id=t2.gh_id AND t1.openid=t2.openid AND t1.gh_id='gh_03a74ac96138' AND t1.openid!='';


  DELETE FROM wx_staff WHERE gh_id!='gh_03a74ac96138';
  //ALTER TABLE wx_staff CHANGE scene_id scene_id VARCHAR(64) NOT NULL DEFAULT '';
  //UPDATE wx_staff SET scene_id='' WHERE scene_id='0';
  INSERT INTO wx_staff (gh_id, office_id, scene_id, name, cat) SELECT gh_id, office_id, scene_id, title, 2 FROM wx_office WHERE gh_id='gh_03a74ac96138' AND scene_id!='0'

  //ALTER TABLE wx_user CHANGE scene_pid scene_pid VARCHAR(64) NOT NULL DEFAULT '';
  //UPDATE wx_user SET scene_pid='' WHERE scene_pid='0';
  //ALTER TABLE wx_office DROP scene_id;
  //ALTER TABLE wx_user DROP scene_id;







  ALTER TABLE wx_office ADD visable tinyint(3) NOT NULL DEFAULT 0;
  UPDATE wx_office SET visable=1 WHERE gh_id = 'gh_03a74ac96138' AND office_id<='24';
  UPDATE wx_office SET visable=2 WHERE gh_id = 'gh_03a74ac96138' AND office_id='25';
  UPDATE wx_office SET visable=1 WHERE gh_id = 'gh_1ad98f5481f3';

  ALTER TABLE wx_office ADD lat float(10,6) NOT NULL DEFAULT '0.000000';
  ALTER TABLE wx_office ADD lon float(10,6) NOT NULL DEFAULT '0.000000';
  ALTER TABLE wx_office ADD lat_bd09 float(10,6) NOT NULL DEFAULT '0.000000';
  ALTER TABLE wx_office ADD lon_bd09 float(10,6) NOT NULL DEFAULT '0.000000';

  UPDATE wx_office SET lat='30.520065', lon='114.322433' WHERE gh_id = 'gh_03a74ac96138' AND office_id='1';
  UPDATE wx_office SET lat='30.574804', lon='114.334366' WHERE gh_id = 'gh_03a74ac96138' AND office_id='3';
  UPDATE wx_office SET lat='30.617111', lon='114.299980' WHERE gh_id = 'gh_03a74ac96138' AND office_id='6';
  UPDATE wx_office SET lat='30.617111', lon='114.299980', lat_bd09='30.617111', lon_bd09='114.299980' WHERE gh_id = 'gh_03a74ac96138' AND office_id='6';

  //XIANGYANG GPS INFO
  UPDATE wx_office SET lat_bd09='32.1153970000', lon_bd09='112.7717480000', lat='32.1094640678', lon='112.7652361297' WHERE gh_id = 'gh_03a74ac96138' AND office_id='1';
  UPDATE wx_office SET lat_bd09='32.1287956212', lon_bd09='112.7644646810', lat='32.1230200000', lon='112.7579100000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='2';
  UPDATE wx_office SET lat_bd09='31.7198170283', lon_bd09='112.2706539097', lat='31.7141380000', lon='112.2640440000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='3';
  UPDATE wx_office SET lat_bd09='31.7125650283', lon_bd09='112.2664239097', lat='31.7068860000', lon='112.2598140000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='4';
  UPDATE wx_office SET lat_bd09='32.0902490383', lon_bd09='112.1975186408', lat='32.0839890000', lon='112.1910710000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='5';
  UPDATE wx_office SET lat_bd09='32.0436327632', lon_bd09='112.1437720534', lat='32.0379520000', lon='112.1371720000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='6';
  UPDATE wx_office SET lat_bd09='32.0193676327', lon_bd09='112.1617267899', lat='32.0135900000', lon='112.1551780000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='7';
  UPDATE wx_office SET lat_bd09='32.0237720000', lon_bd09='112.1586380000', lat='32.0179923900', lon='112.1520854662' WHERE gh_id = 'gh_03a74ac96138' AND office_id='8';
  UPDATE wx_office SET lat_bd09='31.7822720000', lon_bd09='111.8511950000', lat='31.7759513760', lon='111.8448019889' WHERE gh_id = 'gh_03a74ac96138' AND office_id='9';
  UPDATE wx_office SET lat_bd09='31.7825006240', lon_bd09='111.8554630111', lat='31.7761800000', lon='111.8490700000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='10';
  UPDATE wx_office SET lat_bd09='32.3791448173', lon_bd09='111.6754709434', lat='32.3734670000', lon='111.6688980000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='11';
  UPDATE wx_office SET lat_bd09='32.3895210958', lon_bd09='111.6844945538', lat='32.3837490000', lon='111.6779470000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='12';
  UPDATE wx_office SET lat_bd09='32.2677741087', lon_bd09='111.6514546159', lat='32.2618750000', lon='111.6449440000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='13';
  UPDATE wx_office SET lat_bd09='32.2685751087', lon_bd09='111.6466576159', lat='32.2626760000', lon='111.6401470000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='14';
  UPDATE wx_office SET lat_bd09='32.1242896586', lon_bd09='112.2269758102', lat='32.1180630000', lon='112.2205550000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='15';
  UPDATE wx_office SET lat_bd09='32.0623648618', lon_bd09='112.1484136233', lat='32.0566820000', lon='112.1417990000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='16';
  UPDATE wx_office SET lat_bd09='32.0724396183', lon_bd09='112.1637159572', lat='32.0666510000', lon='112.1571280000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='17';
  UPDATE wx_office SET lat_bd09='32.0457927632', lon_bd09='112.1416120534', lat='32.0401120000', lon='112.1350120000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='18';
  UPDATE wx_office SET lat_bd09='32.0492924490', lon_bd09='112.1597993874', lat='32.0436000000', lon='112.1532000000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='19';
  UPDATE wx_office SET lat_bd09='32.0489583197', lon_bd09='112.1493941856', lat='32.0432775565', lon='112.1427941322' WHERE gh_id = 'gh_03a74ac96138' AND office_id='20';
  UPDATE wx_office SET lat_bd09='32.0521728900', lon_bd09='112.1325031975', lat='32.0464160000', lon='112.1259210000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='21';
  UPDATE wx_office SET lat_bd09='32.0567040857', lon_bd09='112.1427807138', lat='32.0510220000', lon='112.1361720000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='22';
  UPDATE wx_office SET lat_bd09='31.8833807792', lon_bd09='111.2698470213', lat='31.8771540000', lon='111.2634270000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='23';
  UPDATE wx_office SET lat_bd09='31.8797357494', lon_bd09='111.2686621197', lat='31.8735070000', lon='111.2622350000' WHERE gh_id = 'gh_03a74ac96138' AND office_id='24';

  UPDATE wx_office SET lat_bd09='30.4963970000', lon_bd09='114.4192950000', lat='30.490629', lon='114.413484' WHERE gh_id = 'gh_1ad98f5481f3' AND office_id='51';
  UPDATE wx_office SET lat_bd09='30.5183090000', lon_bd09='114.3233280000', lat='30.511008', lon='114.316840' WHERE gh_id = 'gh_1ad98f5481f3' AND office_id='52';

  //XIANGYANG GPS INFO END


  //i want delete some fields
  ALTER TABLE wx_office DROP manager, DROP member_cnt, DROP mobile, DROP pswd;

  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','枣阳','枣阳营业厅','枣阳光武路85号老国税大楼','郑静','6','18607277303');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','枣阳','枣阳盛鑫广场营业厅','枣阳盛鑫广场','屈伸','4','18607277298');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','宜城','宜城营业厅','宜城市振兴大道315号','肖雨','2','18671000057');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','宜城','宜城新建街营业厅','宜城市新建街亚一金店旁','罗菲','2','18607277067');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','襄州','襄州营业厅','襄州区张湾镇航空路117-6','于芳芳','3','18607277158');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','襄州','襄州民发世界城营业厅','襄阳襄州区民发世界城小区3号门','王霞','2','18607273305');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','襄城','襄城南街自有营业厅','襄阳襄城南街99号477医院旁','刘玉琦','9','18671002229');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','襄城','襄城鼓楼自有营业厅','襄阳襄城区鼓楼巷一号楼一楼','张琼','7','18607277369');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','南漳','南漳营业厅','南漳县水镜路159号','朱昌健','4','18602777102');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','南漳','南漳凯达广场营业厅','南漳县凯达广场','朱昌健','3','18602777102');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','河口','老河口营业厅','老河口花园路1号','苏佩佩','4','18607277193');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','河口','老河口市中山路自有营业厅','老河口中山路与东启街交汇口','李霞','2','13135870620');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','谷城','谷城营业厅','谷城城关镇粉水路83-2号','翟飞','5','15607277779');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','谷城','谷城县府街自有营业厅','谷城城关镇防疫站旁','尚莹莹','3','18607277009');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','二汽','二汽营业厅','襄阳二汽开发区富康大道8号','张婧','3','18672715758');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区新华北路营业厅','襄阳樊城区新华北路科技馆门口','郭佳','5','18607279989');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区三元路营业厅','襄阳樊城区长征路74号三元公寓1幢1层103号','杨兴娥','5','18671012223');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区人民路自有营业厅','襄阳樊城区人民路人和秀景一楼门面','黄贞','4','18672700027');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区人民广场营业厅','襄阳樊城区人民广场豪门新天地一楼','王璞梵','5','18671069995');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区前进路营业厅','襄阳樊城区前进路中段（金城大酒店对面）','陈荣印','4','18671068678');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区汉江路营业厅','襄阳樊城区汉江路188号','王琼','12','18607271107');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','樊城','城区长虹路营业厅','襄阳樊城区长虹路与建华路交叉路口海润名都一楼','毛珍珍','6','18607277381');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','保康','保康营业厅','保康县城关镇迎宾路63号','王亚男','4','18507271778');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','襄阳','保康','保康新街营业厅','保康新建街','王亚男','3','18507271778');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','其它','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','公司领导','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','综合部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','工会','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','人力资源部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','计划财务部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','网络建设部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','运行维护部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','市场销售部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','客户服务部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','二汽经营部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','电子商务部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','宽带服务中心','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','集团客户事业部','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','樊城营销中心','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','襄城营销中心','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','襄州分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','枣阳分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','宜城分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','老河口分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','谷城分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','南漳分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','保康分公司','','','','');
  INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_03a74ac96138','','','华盛公司','','','','');


 */

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\MGh;
use app\models\U;

class MOffice extends ActiveRecord implements IdentityInterface {

    public $need_scene_id;

    public static function tableName() {
        return 'wx_office';
    }

    public function rules() {
        return [
            [['title', 'address', 'manager', 'mobile'], 'string', 'max' => 128],
            [['title', 'address', 'manager', 'mobile'], 'filter', 'filter' => 'trim'],
            [['lat', 'lon', 'visable'], 'number'],
            [['is_jingxiaoshang', 'role'], 'number'],
            [['pswd'], 'string', 'max' => 24, 'min' => 1],
            [['pswd'], 'required'],
            [['need_scene_id'], 'integer', 'integerOnly' => true, 'min' => 0, 'max' => 1],
        ];
    }

    public function attributeLabels() {
        return [
            'office_id' => '营业厅编号',
            'title' => '营业厅名称',
            'address' => '营业厅地址',
            'manager' => '主管姓名',
            'mobile' => '手机号',
            'lat' => '纬度',
            'lon' => '经度',
            'visable' => '是否显示',
            'is_jingxiaoshang' => '是否是经销商',
            'scene_id' => '推广ID',
            'pswd' => '登录密码',
        ];
    }

    const STATUS_DELETED = 10;
    const STATUS_ACTIVE = 0;
    const ROLE_NONE = 0;
    const ROLE_OFFICE = 1;
    const ROLE_ADMIN = 2;
    const ROLE_ROOT = 9;

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public function getId() {
        return $this->office_id;
    }

    public function getAuthKey() {
        return $this->office_id;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return $password === $this->pswd;
    }

    public function getUsername() {
        return $this->title;
    }

    public static function findByUsername($nickname) {
        return static::findOne(['title' => $nickname, 'status' => static::STATUS_ACTIVE]);
    }

    public function getGh() {
        return $this->hasOne(MGh::className(), ['gh_id' => 'gh_id']);
    }

    public function getStaffs() {
        return $this->hasMany(MStaff::className(), ['office_id' => 'office_id']);
    }

    public function getManager() {
        return MStaff::findOne(['office_id' => $this->office_id, 'is_manager' => 1]);
    }

    public function getDirector() {
        return $this->hasOne(MStaff::className(), ['name' => 'manager', 'mobile' => 'mobile']);
    }

    public function getSupervisor() {
        return $this->hasOne(MStaff::className(), ['staff_id' => 'staff_id'])
                        ->viaTable('wx_rel_supervision_staff_office', ['office_id' => 'office_id']);
    }

    public function getMsc() {
        return $this->hasOne(MMarketingServiceCenter::className(), ['id' => 'msc_id'])
                        ->viaTable('wx_rel_office_msc', ['office_id' => 'office_id']);
    }

    public function getSceneids() {
        $staffs = $this->staffs;
        $scene_ids = \yii\helpers\ArrayHelper::getColumn($staffs, 'scene_id');
        return array_diff($scene_ids, [0]);
    }

    public function getOfficeStaff() {
        return MStaff::findOne(['office_id' => $this->office_id, 'cat' => MStaff::SCENE_CAT_OFFICE]);
    }

    public function getNormalStaffs() {
        return MStaff::find()->where("office_id = :office_id AND cat != :cat", [':office_id' => $this->office_id, ':cat' => MStaff::SCENE_CAT_OFFICE])->all();
    }

    public static function getOfficeNameOption($gh_id, $json = true, $need_prompt = true) {
        $offices = MOffice::find()->where("gh_id = :gh_id AND visable = :visable", [':gh_id' => $gh_id, ':visable' => 1])->asArray()->all();
        $listData = $need_prompt ? ['0' => '请选择营业厅'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $listData[$value] = "{$office['title']}({$office['address']})";
        }
        return $json ? json_encode($listData) : $listData;
    }

    public static function getOfficeNameOptionSimple($gh_id, $json = true, $need_prompt = true) {
        $offices = MOffice::find()->where("gh_id = :gh_id AND visable = :visable", [':gh_id' => $gh_id, ':visable' => 1])->asArray()->all();
        $listData = $need_prompt ? ['0' => '请选择营业厅'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $text = $office['title'];
            $listData[$value] = $text;
        }
        return $json ? json_encode($listData) : $listData;
    }

    public static function getOfficeNameOptionSimple1($gh_id, $json = true, $need_prompt = true) {
        $offices = MOffice::find()->where("gh_id = :gh_id AND visable >= :visable", [':gh_id' => $gh_id, ':visable' => 1])->asArray()->all();
        $listData = $need_prompt ? ['0' => '请选择营业厅'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $text = $office['title'];
            $listData[$value] = $text;
        }
        return $json ? json_encode($listData) : $listData;
    }

    public static function getOfficeNameOptionSimple2($gh_id, $json = true, $need_prompt = true) {
        $offices = MOffice::find()->where("gh_id = :gh_id AND role = :role AND is_jingxiaoshang=:is_jingxiaoshang", [':gh_id' => $gh_id, ':role' => 1, ':is_jingxiaoshang' => 0])->asArray()->all();
        $listData = $need_prompt ? ['0' => '请选择营业厅'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $text = $office['title'];
            $listData[$value] = $text;
        }
        U::utf8_array_asort($listData);
        return $json ? json_encode($listData) : $listData;
    }

    public static function getOfficeNameOptionAll($gh_id, $json = true, $need_prompt = true) {
        $offices = MOffice::find()->where("gh_id = :gh_id", [':gh_id' => $gh_id])->asArray()->orderBy(['title' => SORT_ASC])->all();
        $listData = $need_prompt ? ['0' => '请选择营业厅'] : [];
        foreach ($offices as $office) {
            $value = $office['office_id'];
            $text = $office['title'];
            $listData[$value] = $text;
        }
        return $json ? json_encode($listData) : $listData;
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            if ($this->need_scene_id) {
                $staff = new MStaff;
                $staff->gh_id = $this->gh_id;
                $staff->office_id = $this->office_id;
                $staff->scene_id = MStaff::newSceneId($this->gh_id);
                $staff->name = $this->title;
                $staff->cat = MStaff::SCENE_CAT_OFFICE;
                if (!$staff->save(false)) {
                    U::W(['error', __METHOD__, $staff]);
                }
            }
        }
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->lat = $this->lon = 0;
            }
            return true;
        }
        return false;
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            foreach ($this->staffs as $staff) {
                $staff->delete();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getQrImageUrl() {
        $officeStaff = $this->officeStaff;
        if (empty($officeStaff)) {
            return false;
        }
        return $officeStaff->getQrImageUrl();
    }

    public function hasOfficeStaff() {
        return !empty($this->officeStaff);
    }

    public function getScoreOfAllStaffs() {
        $staffs = $this->getNormalStaffs();
        $staff_count = 0;
        foreach ($staffs as $staff)
            $staff_count += $staff->getScore();
        return $staff_count;
    }

    public function getScore() {
        $officeStaff = $this->getOfficeStaff();
        if (empty($officeStaff))
            return 0;
        $count = MUser::find()->where(['gh_id' => $this->gh_id, 'scene_pid' => $officeStaff->scene_id, 'subscribe' => 1])->count();
        return $count;
    }

    public static function getOfficeScoreTop($gh_id) {
        $key = __METHOD__ . "{$gh_id}";
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $offices = MOffice::findAll(['gh_id' => $gh_id]);
        $rows = [];
        foreach ($offices as $office) {
            $row = [];
            $row['office_id'] = $office->office_id;
            $row['scene_id'] = $office->scene_id;
            $row['title'] = $office->title;
            $row['is_jingxiaoshang'] = $office->is_jingxiaoshang;
            $row['cnt_office'] = $office->getScore();
            $row['cnt_staffs'] = $office->getScoreOfAllStaffs();
            $row['cnt_sum'] = $row['cnt_office'] + $row['cnt_staffs'];
            $rows[] = $row;
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 12 * 3600);
        return $rows;
    }

    public function getScoreOfAllStaffsByRange($date_start, $date_end) {
        $staffs = $this->getNormalStaffs();
        $staff_count = 0;
        foreach ($staffs as $staff)
            $staff_count += $staff->getScoreByRange($date_start, $date_end);
        return $staff_count;
    }

    public function getScoreByRange($date_start, $date_end) {
        $officeStaff = $this->getOfficeStaff();
        if (empty($officeStaff))
            return 0;
        return $officeStaff->getScoreByRange($date_start, $date_end);
    }

    public static function getOfficeScoreTopByRange($gh_id, $date_start, $date_end) {
        $key = __METHOD__ . "{$gh_id}-{$date_start}-{$date_end}";
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $offices = MOffice::findAll(['gh_id' => $gh_id]);
        $rows = [];
        foreach ($offices as $office) {
            $row = [];
            $row['office_id'] = $office->office_id;
            $row['scene_id'] = $office->scene_id;
            $row['title'] = $office->title;
            $row['is_jingxiaoshang'] = $office->is_jingxiaoshang;
            $row['cnt_office'] = $office->getScoreByRange($date_start, $date_end);
            $row['cnt_staffs'] = $office->getScoreOfAllStaffsByRange($date_start, $date_end);
            $row['cnt_sum'] = $row['cnt_office'] + $row['cnt_staffs'];
            $rows[] = $row;
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 12 * 3600);
        return $rows;
    }

    public function getScoreOfAllStaffsByMonth($month) {
        $staffs = $this->getNormalStaffs();
        $staff_count = 0;
        foreach ($staffs as $staff)
            $staff_count += $staff->getScoreByMonth($month);
        return $staff_count;
    }

    public function getScoreByMonth($month) {
        $officeStaff = $this->getOfficeStaff();
        if (empty($officeStaff))
            return 0;
        return $officeStaff->getScoreByMonth($month);
    }

    public static function getOfficeScoreTopByMonth($gh_id, $month) {
        $key = __METHOD__ . "{$gh_id}-{$month}";
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $offices = MOffice::findAll(['gh_id' => $gh_id]);
        $rows = [];
        foreach ($offices as $office) {
            $row = [];
            $row['office_id'] = $office->office_id;
            $row['scene_id'] = $office->scene_id;
            $row['title'] = $office->title;
            $row['is_jingxiaoshang'] = $office->is_jingxiaoshang;
            $row['cnt_office'] = $office->getScoreByMonth($month);
            $row['cnt_staffs'] = $office->getScoreOfAllStaffsByMonth($month);
            $row['cnt_sum'] = $row['cnt_office'] + $row['cnt_staffs'];
            $rows[] = $row;
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 12 * 3600);
        return $rows;
    }

    public static function getNearestOffices($gh_id, $lon, $lat) {
        $key = __METHOD__ . "{$gh_id}_{$lon}_{$lat}";
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $map = new MMapApi;
        $rows = MOffice::find()->where(['gh_id' => $gh_id])->asArray()->all();
        foreach ($rows as $key => &$row) {
            if ($row['lon'] < 1) {
                unset($rows[$key]);
                continue;
            }
            $row['distance'] = $map->getDistance($lon, $lat, $row['lon'], $row['lat']);
        }
        unset($row);
        \yii\helpers\ArrayHelper::multisort($rows, 'distance');
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 5 * 60);
        return $rows;
    }

}

/*
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','枣阳','枣阳营业厅','枣阳光武路85号老国税大楼','郑静','6','18607277303');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','枣阳','枣阳盛鑫广场营业厅','枣阳盛鑫广场','屈伸','4','18607277298');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','宜城','宜城营业厅','宜城市振兴大道315号','肖雨','2','18671000057');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','宜城','宜城新建街营业厅','宜城市新建街亚一金店旁','罗菲','2','18607277067');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','襄州','襄州营业厅','襄州区张湾镇航空路117-6','于芳芳','3','18607277158');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','襄州','襄州民发世界城营业厅','襄阳襄州区民发世界城小区3号门','王霞','2','18607273305');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','襄城','襄城南街自有营业厅','襄阳襄城南街99号477医院旁','刘玉琦','9','18671002229');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','襄城','襄城鼓楼自有营业厅','襄阳襄城区鼓楼巷一号楼一楼','张琼','7','18607277369');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','南漳','南漳营业厅','南漳县水镜路159号','朱昌健','4','18602777102');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','南漳','南漳凯达广场营业厅','南漳县凯达广场','朱昌健','3','18602777102');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','河口','老河口营业厅','老河口花园路1号','苏佩佩','4','18607277193');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','河口','老河口市中山路自有营业厅','老河口中山路与东启街交汇口','李霞','2','13135870620');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','谷城','谷城营业厅','谷城城关镇粉水路83-2号','翟飞','5','15607277779');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','谷城','谷城县府街自有营业厅','谷城城关镇防疫站旁','尚莹莹','3','18607277009');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','二汽','二汽营业厅','襄阳二汽开发区富康大道8号','张婧','3','18672715758');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区新华北路营业厅','襄阳樊城区新华北路科技馆门口','郭佳','5','18607279989');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区三元路营业厅','襄阳樊城区长征路74号三元公寓1幢1层103号','杨兴娥','5','18671012223');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区人民路自有营业厅','襄阳樊城区人民路人和秀景一楼门面','黄贞','4','18672700027');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区人民广场营业厅','襄阳樊城区人民广场豪门新天地一楼','王璞梵','5','18671069995');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区前进路营业厅','襄阳樊城区前进路中段（金城大酒店对面）','陈荣印','4','18671068678');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区汉江路营业厅','襄阳樊城区汉江路188号','王琼','12','18607271107');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','樊城','城区长虹路营业厅','襄阳樊城区长虹路与建华路交叉路口海润名都一楼','毛珍珍','6','18607277381');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','保康','保康营业厅','保康县城关镇迎宾路63号','王亚男','4','18507271778');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','保康','保康新街营业厅','保康新建街','王亚男','3','18507271778');
INSERT INTO wx_office (gh_id,branch,region,title,address,manager,member_cnt,mobile) VALUES ('gh_1ad98f5481f3','襄阳','','其它','','','167','');

SELECT t1.gh_id, t1.office_id, t1.title, t1.scene_id, COUNT(*) as cnt_office FROM wx_office t1 
INNER JOIN wx_user t2 ON t1.gh_id = t2.gh_id AND t1.scene_id = t2.scene_pid 
WHERE t1.scene_id != 0
GROUP BY t1.gh_id, t1.scene_id
ORDER BY cnt_office DESC
EOD;

        $sql = <<<EOD
SELECT t1.gh_id, t1.office_id, t1.title, t1.scene_id, COUNT(*) as cnt_office FROM wx_office t1 
INNER JOIN wx_user t2 ON t1.gh_id = t2.gh_id AND t1.scene_id = t2.scene_pid 
WHERE t1.gh_id='$gh_id' AND t1.scene_id != 0
GROUP BY t1.gh_id, t1.scene_id
ORDER BY cnt_office DESC
EOD;
        $rows = Yii::$app->db->createCommand($sql)->queryAll();
        U::W($rows);

    public function getScoreOfAllStaffs()
    {
        $staffs = MStaff::find()->where(['gh_id'=>$this->gh_id, 'office_id'=>$this->office_id])->asArray()->all();
        $openids = [];
        //U::W($staffs);                            
        foreach($staffs as $staff)
        {
            if (!empty($staff['openid']))
                $openids[] = $staff['openid'];
        }

        if (empty($openids))
        {
            $staff_count = 0;
        }
        else
        {
            $users = MUser::find()->where(['gh_id'=>$this->gh_id, 'openid'=>$openids])->asArray()->all();
            $scene_ids = [];                                                    
            foreach($users as $user)
            {
                if ($user['scene_id'] != 0)
                    $scene_ids[] = $user['scene_id'];
            }
            //U::W($scene_ids);
            if (empty($scene_ids))
                $staff_count = 0;
            else                                                        
                $staff_count = MUser::find()->where(['gh_id'=>$this->gh_id, 'scene_pid' => $scene_ids])->count();                                
        }
        return $staff_count;        
    }

public function afterFind()
{
    $officeStaff = $this->officeStaff;
    $this->need_scene_id = empty($officeStaff) ? 0 : 1;
}

    
*/

