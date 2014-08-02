<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_office;
CREATE TABLE wx_office (
	office_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	scene_id int(10) unsigned NOT NULL DEFAULT '0',
	title VARCHAR(128) NOT NULL DEFAULT '',
	branch VARCHAR(128) NOT NULL DEFAULT '',
	region VARCHAR(128) NOT NULL DEFAULT '',
	address VARCHAR(128) NOT NULL DEFAULT '',
	manager VARCHAR(32) NOT NULL DEFAULT '',
	member_cnt int(10) unsigned NOT NULL DEFAULT '0',
	mobile VARCHAR(16) NOT NULL DEFAULT '',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

class MOffice extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
	{
		return 'wx_office';
	}

	public function rules()
	{
		return [
			['title', 'string', 'max' => 128],
			['title', 'filter', 'filter' => 'trim'],
		];
	}

	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	public static function findByUsername($nickname)
	{
		return static::findOne(['manager' => $nickname]);
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		return null;
	}

	public function getUsername()
	{
		return $this->manager;
	}

	public function getId()
	{
		return $this->office_id;
	}

	public function getAuthKey()
	{
		return $this->office_id;
	}

	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	public function validatePassword($password)
	{
		return $password === $this->mobile;
	}
	
/*
	static function getOfficeNameX($key=null)
	{
		$arr = array(
			self::GRADE_UNPAY => '潜在客户',
			self::GRADE_NONE => '店铺客户',
			self::GRADE_NORMAL => '普通会员',
			self::GRADE_HIGH => '高级会员',
			self::GRADE_VIP => 'VIP会员',			
			self::GRADE_HVIP => '至尊VIP',						
		);		
		return $key === null ? $arr : $arr[$key];
	}

*/

	//$item = \app\models\MItem::findOne(['gh_id'=>$gh_id, 'cid' => \app\models\MItem::ITEM_CAT_CARD_WO]);
	//$item->title
	//Html::dropDownList('office_id', 0, MOffice::getOfficeNameOption($gh_id));
	public static function getOfficeNameOption($gh_id, $need_prompt=true)
	{
		$offices = MOffice::find()->where("gh_id = :gh_id AND office_id <= :office_id", [':gh_id'=>$gh_id, ':office_id'=>24])->asArray()->all();					
		$listData = $need_prompt ? ['0'=>'请选择营业厅'] ? [];
		foreach($offices as $office)
		{
			$value = $office['office_id'];
			$text = $office['title'];
			$listData[$value]=$text;
		}
		return $listData;
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

*/
