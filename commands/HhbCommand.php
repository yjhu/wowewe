<?php

/*
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php help
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb 
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb tmp
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb update
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportItemcat
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb up
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb handlebought
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb handlesold
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb sendduoduomail
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SendCartTool
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb TestDomains --key=tui
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb GetUsers
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb PutUsers
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleFetchTianya
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb GetUsersByDir
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportAreaCode
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SaveTradeToMongo
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSm



C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=qq_100.txt	
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=ASINA_200.txt	
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=email-2013-7-9.txt
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmBlack --filename=blackword_ymt.txt
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmBlack --filename=blackword_guodu.txt


cd work
tar zxvf stat_trade_2012-05-24.log.tar.gz 
find *.gz >> ./buyer/gz.log
rm -f *.gz

php /mnt/wwwroot/apps/sms/protected/yiic.php hhb GetUsersByDir


C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php webapp C:\htdocs\xxx

生成待填写的翻译文件
C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php message C:\htdocs\parsecode\yii\demos\sms\protected\messages\config.php

/usr/bin/php /mnt/wwwroot/apps/sms/protected/yiic.php hhb
/usr/bin/php /mnt/wwwroot/apps/sms/protected/yiic.php hhb up
/usr/bin/php /mnt/wwwroot/apps/sms/protected/yiic.php hhb tmp

unrar x map.rar
create database yii DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE tool_shop ADD create_time int(10) unsigned NOT NULL default 0 after nearest_delist_time;	

tar zcvf stat_trade_2012-05-24.log.tar.gz stat_trade_2012-05-24.log 
tar zcvf stat_trade_2012-06-0102.log.tar.gz stat_trade_2012-06-01.log stat_trade_2012-06-02.log 
tar zcvf stat_trade_2012-06-0304.log.tar.gz stat_trade_2012-06-03.log stat_trade_2012-06-04.log 
tar zxvf stat_trade_2012-05-24.log.tar.gz 
tar zcvf stat_trade_2012-09-0109.log.tar.gz stat_trade_2012-09-0*.log


tar zcvf guide_trade_2012-05-26.log.tar.gz guide_trade_2012-05-26.log guide_trade_2012-05-27.log guide_trade_2012-05-28.log guide_trade_2012-05-29.log
tar zcvf guide_trade_2012-05-30.log.tar.gz guide_trade_2012-05-30.log
tar zcvf guide_trade_2012-05-31.log.tar.gz *.log


C:\xampp\mysql\bin\mysql -u root -p
use yii;

UPDATE smtp_acc_1 SET cnt='0';
UPDATE smtp_acc_1 SET code='0';		
UPDATE smtp_acc_1 SET msg='';	

crm_member
的内容来源于两部分，1:crm API, 2 交易记录
buy_id来自于crm api

#md5sum stat_trade_2013-0413-0430.log.tar.gz
# md5sum * 			(将当前目录所有文件求chksum)
用windows的winmd5计算chksum,2者进行对比
*/

$err_seller_nick = $err_tid = $err_oid = $err_num_iid = null;

class HhbCommand extends CConsoleCommand
{
	const SMTP_ACC_TABLE = 'smtp_acc_5';
//	const EMAIL_CNT_LIMIT_PER_DAY_PER_ACC = 1;
	const EMAIL_CNT_LIMIT_PER_DAY_PER_ACC = 30;
	
	public static function hhbErrorHandler($code,$message,$file,$line) {
		ob_start();
		Yii::app()->displayError($code,$message,$file,$line);
		$txt=ob_get_flush();
		Util::log("$txt", Yii::app()->getRuntimePath()."/hhbErrorHandler.log");
		sleep(3);
	} 
	
	public function init() 
	{
		set_time_limit(0);			
		if (!ini_set('memory_limit', '-1'))
			L("ini_set(memory_limit) error");    	
		set_error_handler("HhbCommand::hhbErrorHandler");		
	}
	
	public function actionIndex() 
	{
		echo "Index...";
		$time=microtime(true);
/*
			buyer_credit_level int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			vip_info tinyint(1) unsigned NOT NULL DEFAULT '0',						
			sex CHAR(1) NOT NULL DEFAULT '',						

*/	
		$sql=<<<EOD

		ALTER IGNORE TABLE sm_seller2 
		DROP nick_s, 
		DROP type, 
		DROP shop_created, 
		DROP receiver_address, 
		DROP has_shop, 
		DROP seller_credit_good_num, 
		DROP seller_credit_total_num;

		DROP TABLE IF EXISTS sm_order_all_short;
		CREATE TABLE  sm_order_all_short ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT oid,cid,receiver_mobile,buyer_email,buyer_alipay_no,buyer_nick,createdx,price,order_from,buyer_credit_level,buyer_credit_score,vip_info,sex,created,x_vip_info,x_sm_mob_cat,receiver_phone,receiver_state,receiver_city,receiver_district,receiver_name,title_short FROM sm_order_all_new;
		ALTER TABLE sm_order_all_short ADD x_send_cnt int(10) unsigned NOT NULL DEFAULT '0', ADD x_send_time date NOT NULL;
		// copy sm_order_all_short -> sm_order_all_short_sm, sm_order_all_short_e

		SELECT oid,receiver_mobile,receiver_phone FROM sm_order_all_test WHERE LEFT(receiver_mobile, 1) != '1';		
		SELECT receiver_mobile,receiver_phone,buyer_alipay_no INTO OUTFILE 'a3.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_test WHERE LEFT(receiver_mobile, 1) != '1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0) LIMIT 10000;				
		SELECT receiver_mobile,buyer_alipay_no FROM sm_order_all_test WHERE LEFT(receiver_mobile, 1) != '1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);				 
		
		// 删除receiver_mobile和buyer_alipay_no都不是mobile号的记录
		// sm_order_all_short_sm
		
		DELETE FROM sm_order_all_short_sm WHERE LEFT(receiver_mobile, 1) != '1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);
		ALTER IGNORE TABLE sm_order_all_short_sm ADD PRIMARY KEY (cid,receiver_mobile,buyer_alipay_no);
		ALTER IGNORE TABLE sm_order_all_short_sm DROP PRIMARY KEY;

		//ALTER TABLE sm_order_all_test ADD KEY idx_oid (oid);
		//SELECT oid,cid,receiver_mobile,buyer_alipay_no INTO OUTFILE 'a2.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_test ORDER BY oid;						


		//FROM sm_order_all_test WHERE INSTR(buyer_email, '@') = 0 AND INSTR(buyer_alipay_no, '@') = 0;

		//sm_order_all_short_e
		DELETE FROM sm_order_all_test_em WHERE INSTR(buyer_email, '@') = 0 AND INSTR(buyer_alipay_no, '@') = 0;
		ALTER IGNORE TABLE sm_order_all_test_em ADD PRIMARY KEY (cid,buyer_email,buyer_alipay_no);
		ALTER IGNORE TABLE sm_order_all_test_em DROP PRIMARY KEY, DROP receiver_mobile, DROP x_sm_mob_cat, DROP receiver_phone, DROP vip_info;


		DROP TABLE IF EXISTS sm_order_all_new;
		CREATE TABLE  IF NOT EXISTS  sm_order_all_new (
			tid bigint(20) unsigned NOT NULL DEFAULT '0', 	
			oid bigint(20) unsigned NOT NULL DEFAULT '0', 				
			cid int(10) unsigned NOT NULL DEFAULT '0',				
			receiver_mobile VARCHAR(32) NOT NULL,					
			buyer_email VARCHAR(32) NOT NULL,			
			buyer_alipay_no VARCHAR(32) NOT NULL,		
			buyer_nick VARCHAR(32) NOT NULL,				
			createdx datetime NOT NULL,			
			price int(10) unsigned NOT NULL DEFAULT '0',
			seller_type CHAR(1) NOT NULL DEFAULT '',
			order_from VARCHAR(12) NOT NULL DEFAULT '',			
			
			seller_nick VARCHAR(32) NOT NULL,	
			seller_mobile VARCHAR(32) NOT NULL,
			seller_email VARCHAR(32) NOT NULL,			
			seller_alipay_no VARCHAR(32) NOT NULL,
			seller_phone VARCHAR(32) NOT NULL,
			seller_name VARCHAR(32) NOT NULL,					
						
			nick VARCHAR(32) NOT NULL DEFAULT '',
			buyer_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			buyer_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_total_num int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			seller_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_total_num int(10) unsigned NOT NULL DEFAULT '0'	,	
			has_shop tinyint(1) unsigned NOT NULL DEFAULT '0',		
			type CHAR(1) NOT NULL DEFAULT '',						
			vip_info VARCHAR(12) NOT NULL DEFAULT '',
			sex CHAR(1) NOT NULL DEFAULT '',						
			avatar VARCHAR(128) NOT NULL,								
			created date NOT NULL,
			last_visit datetime NOT NULL,						
			location_state VARCHAR(32) NOT NULL,
			location_city VARCHAR(32) NOT NULL,		
			is_golden_seller tinyint(1) unsigned NOT NULL DEFAULT '0',
			is_lightning_consignment tinyint(1) unsigned NOT NULL DEFAULT '0',			
			x_vip_info tinyint(1) unsigned NOT NULL DEFAULT '0',	

			x_sm_mob_cat tinyint(1) NOT NULL DEFAULT '-1',
			
			receiver_zip CHAR(6) NOT NULL,
			receiver_phone VARCHAR(32) NOT NULL,			
			receiver_state VARCHAR(32) NOT NULL,
			receiver_city VARCHAR(32) NOT NULL,		
			receiver_district VARCHAR(32) NOT NULL,											
			receiver_name VARCHAR(32) NOT NULL,								
			receiver_address VARCHAR(120) NOT NULL,	
			buyer_area VARCHAR(32) NOT NULL,				
			sku_properties_name VARCHAR(60) NOT NULL,	
			title_short VARCHAR(200) NOT NULL,						
			title VARCHAR(300) NOT NULL
			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;




		ALTER IGNORE TABLE sm_order_all ADD PRIMARY KEY (oid);
		ALTER IGNORE TABLE sm_order_all DROP PRIMARY KEY;
		ALTER TABLE sm_order_all PARTITION BY HASH(cid) PARTITIONS 3;		
		ALTER TABLE sm_order_all ADD KEY idx_cid (cid);

		ALTER TABLE sm_order_all COALESCE PARTITION 2;
		ALTER TABLE sm_order_all REMOVE PARTITIONING;
		ALTER IGNORE TABLE sm_order_all DROP KEY idx_cid;

		DELETE FROM sm_order_all WHERE cid='0';
		DELETE FROM sm_order_all WHERE price<='1';


		DROP TABLE IF EXISTS sm_cid_parent_as_leaf;
		CREATE TABLE  IF NOT EXISTS  sm_cid_parent_as_leaf (
			cid int(10) unsigned NOT NULL DEFAULT '0',		
			PRIMARY KEY (cid)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


//		DROP TABLE IF EXISTS sm_order_all_tmp;
//		CREATE TABLE sm_order_all_tmp like sm_order_all;
//		ALTER TABLE sm_itemcat ADD x_hide tinyint(1) unsigned NOT NULL DEFAULT '0';
		ALTER TABLE sm_itemcat DROP x_parent_as_leaf, ADD x_order_cnt int(10) unsigned NOT NULL default 0, ADD x_label VARCHAR(32) NOT NULL DEFAULT '', ADD x_hide  tinyint(1) unsigned NOT NULL DEFAULT '0'; 
		ALTER TABLE sm_itemcat ADD x_split tinyint(1) unsigned NOT NULL DEFAULT '0';


//		ALTER TABLE sm_order_all_test ADD KEY idx_cid_receiver_mobile (cid,receiver_mobile);
		ALTER TABLE sm_order_all ADD KEY idx_cid_receiver_mobile (cid,receiver_mobile);




		DROP TABLE IF EXISTS sm_buyer_all;
		CREATE TABLE  IF NOT EXISTS  sm_buyer_all (
			nick VARCHAR(32) NOT NULL DEFAULT '',
			buyer_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_level int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_total_num int(10) unsigned NOT NULL DEFAULT '0',
			vip_info VARCHAR(12) NOT NULL DEFAULT '',
			sex CHAR(1) NOT NULL DEFAULT '',						
			avatar VARCHAR(128) NOT NULL,								
			created date NOT NULL,
			last_visit datetime NOT NULL,						
			location_state VARCHAR(32) NOT NULL,
			location_city VARCHAR(32) NOT NULL,		
			has_shop tinyint(1) unsigned NOT NULL DEFAULT '0',		
			type CHAR(1) NOT NULL DEFAULT '',			
			is_golden_seller tinyint(1) unsigned NOT NULL DEFAULT '0',
			is_lightning_consignment tinyint(1) unsigned NOT NULL DEFAULT '0',			
			seller_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_level int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_total_num int(10) unsigned NOT NULL DEFAULT '0'
						
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		ALTER IGNORE TABLE sm_buyer_all ADD PRIMARY KEY (nick);		
    		ALTER TABLE sm_buyer_all PARTITION BY KEY() PARTITIONS 100;		




				
		ALTER IGNORE TABLE sm_buyer_all ADD KEY idx_last_visit (last_visit);		
		CREATE TABLE sm_buyer_all_new ENGINE=MyISAM DEFAULT CHARSET=utf8 (SELECT * FROM sm_buyer_all ORDER BY last_visit DESC);
		ALTER IGNORE TABLE sm_buyer_all_new ADD PRIMARY KEY (nick);

		DROP TABLE IF EXISTS sm_buyer_all_tmp;		
		ALTER TABLE sm_buyer_all RENAME TO sm_buyer_all_tmp;		
		ALTER TABLE sm_buyer_all_new RENAME TO sm_buyer_all;				
		



/*

		DROP TABLE IF EXISTS sm_buyer_all_new;		
		CREATE TABLE sm_buyer_all_new ENGINE=MyISAM DEFAULT CHARSET=utf8 (SELECT * FROM sm_buyer_all ORDER BY last_visit DESC);

		ALTER IGNORE TABLE sm_buyer_all_new ADD PRIMARY KEY (nick);
		ALTER IGNORE TABLE sm_buyer_all_new DROP PRIMARY KEY;

		DROP TABLE IF EXISTS sm_buyer_all_old;		
		ALTER TABLE sm_buyer_all RENAME TO sm_buyer_all_old;		
		ALTER TABLE sm_buyer_all_new RENAME TO sm_buyer_all;				

		ALTER IGNORE TABLE sm_buyer_all ADD PRIMARY KEY (nick);

		ALTER TABLE sm_buyer_all REMOVE PARTITIONING;

		x_sm_cnt int(10) unsigned NOT NULL DEFAULT '0',
		x_sm_last date NOT NULL		
		ALTER TABLE sm_order_all PARTITION BY HASH(cid) PARTITIONS 128;
		ALTER TABLE yii_item RENAME TO tool_item;		
		ALTER IGNORE TABLE sm_buyer_all ADD KEY idx_last_visit (last_visit);
		ALTER IGNORE TABLE sm_buyer_all DROP KEY idx_last_visit;

		ALTER TABLE sm_user AUTO_INCREMENT = 1000;
		DROP TABLE IF EXISTS sm_seller;
		CREATE TABLE IF NOT EXISTS sm_seller (
			seller_nick VARCHAR(32) NOT NULL,	
			seller_name VARCHAR(32) NOT NULL,					
			seller_mobile VARCHAR(32) NOT NULL,
			seller_email VARCHAR(32) NOT NULL,			
			seller_alipay_no VARCHAR(32) NOT NULL,
			seller_phone VARCHAR(32) NOT NULL
			seller_type CHAR(1) NOT NULL DEFAULT '',
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 PARTITION BY HASH(cid) PARTITIONS 128;

		ALTER TABLE crm_member CHANGE grade grade tinyint(1) unsigned NOT NULL DEFAULT '9';
		ALTER TABLE sm_itemcat CHANGE  cid cid bigint(20) unsigned NOT NULL DEFAULT '0', CHANGE  parent_cid parent_cid bigint(20) unsigned NOT NULL DEFAULT '0';

		DROP TABLE IF EXISTS crm_sm_charge;
		CREATE TABLE crm_sm_charge (
			id int(10) unsigned NOT NULL AUTO_INCREMENT,			
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
			old int(10) unsigned NOT NULL DEFAULT '0', 		
			incr int(10) unsigned NOT NULL DEFAULT '0',
			created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,	
			created1 date NOT NULL,		// ???	
			memo varchar(32) NOT NULL DEFAULT '',				
			PRIMARY KEY (id),	
			KEY idx_user_id_created(user_id, created)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


		DROP TABLE IF EXISTS yii_itemcat;
		CREATE TABLE  IF NOT EXISTS  yii_itemcat (
			cid int(10) unsigned NOT NULL DEFAULT '0',	
			name varchar(64) NOT NULL DEFAULT '',									
			parent_cid int(10) unsigned NOT NULL DEFAULT '0',	
			is_parent tinyint(3) unsigned NOT NULL DEFAULT '0',	
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (cid),
			KEY idx_parent_cid (parent_cid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS yii_cid_brand;
		CREATE TABLE IF NOT EXISTS yii_cid_brand (
			cid int(10) unsigned NOT NULL DEFAULT '0',
			name varchar(64) NOT NULL DEFAULT '',
			name_alias varchar(64) NOT NULL DEFAULT '',
			vid int(10) unsigned NOT NULL DEFAULT '0',
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			KEY idx_cid (cid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS yii_brand_name;
		CREATE TABLE IF NOT EXISTS yii_brand_name (
			vid int(10) unsigned NOT NULL DEFAULT '0',
			name varchar(64) NOT NULL DEFAULT '',
			name_alias varchar(64) NOT NULL DEFAULT '',
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			name1 varchar(64) NOT NULL DEFAULT '',
			name2 varchar(64) NOT NULL DEFAULT '',
			PRIMARY KEY (vid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		


		CREATE TABLE dict_2_word (
			keyword varchar(64) NOT NULL DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


		DROP TABLE IF EXISTS sm_order_all;
		CREATE TABLE  IF NOT EXISTS  sm_order_all (
			tid bigint(20) unsigned NOT NULL DEFAULT '0', 			
			buyer_nick VARCHAR(32) NOT NULL,	
			buyer_alipay_no VARCHAR(32) NOT NULL,			
			buyer_email VARCHAR(32) NOT NULL,
			buyer_area VARCHAR(32) NOT NULL,	

			receiver_mobile VARCHAR(32) NOT NULL,					
			receiver_name VARCHAR(32) NOT NULL,					
			receiver_phone VARCHAR(32) NOT NULL,			
			receiver_zip CHAR(6) NOT NULL,
			receiver_state VARCHAR(32) NOT NULL,
			receiver_city VARCHAR(32) NOT NULL,		
			receiver_district VARCHAR(32) NOT NULL,								
			receiver_address VARCHAR(120) NOT NULL,
			createdx datetime NOT NULL,
			
			oid bigint(20) unsigned NOT NULL DEFAULT '0', 				
			cid int(10) unsigned NOT NULL DEFAULT '0',				
			title VARCHAR(300) NOT NULL,
			title_short VARCHAR(300) NOT NULL,			
			sku_properties_name VARCHAR(60) NOT NULL,	
			price int(10) unsigned NOT NULL DEFAULT '0',
			seller_type CHAR(1) NOT NULL DEFAULT '',
			order_from VARCHAR(12) NOT NULL DEFAULT '',			
			
			seller_nick VARCHAR(32) NOT NULL,	
			seller_name VARCHAR(32) NOT NULL,					
			seller_mobile VARCHAR(32) NOT NULL,
			seller_email VARCHAR(32) NOT NULL,			
			seller_alipay_no VARCHAR(32) NOT NULL,
			seller_phone VARCHAR(32) NOT NULL,
			
			x_cid_ori int(10) unsigned NOT NULL DEFAULT '0',							
			x_sm_mob_cat tinyint(1) NOT NULL DEFAULT '-1',
			x_sm_tot_cnt int(10) unsigned NOT NULL DEFAULT '0',
			x_sm_send_time date NOT NULL,
			
			nick VARCHAR(32) NOT NULL DEFAULT '',
			buyer_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			buyer_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			buyer_credit_total_num int(10) unsigned NOT NULL DEFAULT '0',
			vip_info VARCHAR(12) NOT NULL DEFAULT '',
			sex CHAR(1) NOT NULL DEFAULT '',						
			avatar VARCHAR(128) NOT NULL,								
			created date NOT NULL,
			last_visit datetime NOT NULL,						
			location_state VARCHAR(32) NOT NULL,
			location_city VARCHAR(32) NOT NULL,		
			has_shop tinyint(1) unsigned NOT NULL DEFAULT '0',		
			type CHAR(1) NOT NULL DEFAULT '',			
			is_golden_seller tinyint(1) unsigned NOT NULL DEFAULT '0',
			is_lightning_consignment tinyint(1) unsigned NOT NULL DEFAULT '0',			
			seller_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			seller_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			seller_credit_total_num int(10) unsigned NOT NULL DEFAULT '0'	,

			x_vip_info tinyint(1) unsigned NOT NULL DEFAULT '0'							

		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS crm_sm_word_blacklist;
CREATE TABLE IF NOT EXISTS crm_sm_word_blacklist (
	word VARCHAR(64) NOT NULL DEFAULT '',	
	PRIMARY KEY (word)	
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE yii_user ADD x_crm_send_sm_once_per_day tinyint(1) unsigned NOT NULL DEFAULT '0';

DROP TABLE IF EXISTS cloud_dwb_auction_trade_d;
CREATE TABLE IF NOT EXISTS cloud_dwb_auction_trade_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 		
	auction_id bigint(20)  NOT NULL DEFAULT '0', 	
	auction_price decimal(12,2)  NOT NULL DEFAULT '0',	
	alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 			
	alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',		
	alipay_winner_num bigint(20) NOT NULL DEFAULT '0', 		
	gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	 		
	gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	gmv_winner_num bigint(20) NOT NULL DEFAULT '0', 		
	same_day_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	same_day_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',				
	same_day_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	plot_gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 		
	plot_gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	plot_gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 			
	noplot_gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	noplot_gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	noplot_gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	plot_alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 			
	plot_alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	plot_alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 		
	noplot_alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	noplot_alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	noplot_alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 		
	add_cart_user_num bigint(20) NOT NULL DEFAULT '0', 	
	succ_refund_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	succ_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	alipay_order_num bigint(20) NOT NULL DEFAULT '0', 	
	gmv_order_num bigint(20) NOT NULL DEFAULT '0', 	
	KEY idx_user_id_thedate(user_id,thedate,auction_id)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS cloud_dwb_auction_pc_src_effect_d;
CREATE TABLE IF NOT EXISTS cloud_dwb_auction_pc_src_effect_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 	
	auction_id bigint(20)  NOT NULL DEFAULT '0', 
	src_id bigint(20)  NOT NULL DEFAULT '0', 			
	src_level bigint(20)  NOT NULL DEFAULT '0', 			
	src_parent_id bigint(20)  NOT NULL DEFAULT '0', 			
	iuv bigint(20)  NOT NULL DEFAULT '0', 			
	ipv bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_trade_num bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_auction_num bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_trade_amt bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_winner_num bigint(20)  NOT NULL DEFAULT '0', 			
	gmv_trade_num bigint(20)  NOT NULL DEFAULT '0', 			
	gmv_auction_num bigint(20)  NOT NULL DEFAULT '0', 			
	gmv_trade_amt bigint(20)  NOT NULL DEFAULT '0', 			
	gmv_winner_num bigint(20)  NOT NULL DEFAULT '0', 					
	KEY idx_user_id_thedate_auction_src(user_id,thedate,auction_id,src_id)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS cloud_shop_base_d;
CREATE TABLE IF NOT EXISTS cloud_shop_base_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 		
	pv bigint(20) NOT NULL DEFAULT '0', 	
	uv bigint(20) NOT NULL DEFAULT '0', 		
	ipv bigint(20) NOT NULL DEFAULT '0', 	
	iuv bigint(20) NOT NULL DEFAULT '0', 			
	visit_repeat_num bigint(20) NOT NULL DEFAULT '0', 	
	session_num bigint(20) NOT NULL DEFAULT '0', 		
	alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 			
	alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',		
	alipay_winner_num bigint(20) NOT NULL DEFAULT '0', 		
	gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	 		
	gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	gmv_winner_num bigint(20) NOT NULL DEFAULT '0', 		
	same_day_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	same_day_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',				
	same_day_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	plot_gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 		
	plot_gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	plot_gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 			
	noplot_gmv_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	noplot_gmv_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	noplot_gmv_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	plot_alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 			
	plot_alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	plot_alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 		
	noplot_alipay_trade_num bigint(20) NOT NULL DEFAULT '0', 	
	noplot_alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	noplot_alipay_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	trade_repeat_num bigint(20) NOT NULL DEFAULT '0', 		
	succ_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	succ_trade_num bigint(20) NOT NULL DEFAULT '0', 			
	succ_auction_num bigint(20) NOT NULL DEFAULT '0', 	
	retrade_rate_30d decimal(12,2)  NOT NULL DEFAULT '0',	
	related_trade_buyer_rate decimal(12,2)  NOT NULL DEFAULT '0',	
	avg_trade_cycle decimal(12,2)  NOT NULL DEFAULT '0',	
	avg_alipay_duration decimal(12,2)  NOT NULL DEFAULT '0',	
	shop_collect_num bigint(20) NOT NULL DEFAULT '0', 		
	auction_collect_num bigint(20) NOT NULL DEFAULT '0', 	
	lost_order_num bigint(20) NOT NULL DEFAULT '0', 			
	lost_order_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	avg_delivery_duration decimal(12,2)  NOT NULL DEFAULT '0',	
	alipay_order_num bigint(20) NOT NULL DEFAULT '0', 	
	delivery_trade_num bigint(20) NOT NULL DEFAULT '0', 
	x_shopcat_cid bigint(20) unsigned NOT NULL DEFAULT '0', 				
	KEY idx_user_id_thedate(user_id,thedate)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cloud_dwb_auction_collect_d;
CREATE TABLE IF NOT EXISTS cloud_dwb_auction_collect_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 		
	auction_id bigint(20)  NOT NULL DEFAULT '0', 		
	auction_collect_num bigint(20)  NOT NULL DEFAULT '0', 			
	KEY idx_user_id_thedate_auction(user_id,thedate,auction_id)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cloud_dws_auctionset_asso_d;
CREATE TABLE IF NOT EXISTS cloud_dws_auctionset_asso_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 	
	auction_id_1 bigint(20)  NOT NULL DEFAULT '0', 		
	auction_id_2 bigint(20)  NOT NULL DEFAULT '0', 			
	asso_access_num bigint(20)  NOT NULL DEFAULT '0', 			
	asso_access_user_num bigint(20)  NOT NULL DEFAULT '0', 			
	asso_alipay_num bigint(20)  NOT NULL DEFAULT '0', 			
	asso_alipay_user_num bigint(20)  NOT NULL DEFAULT '0', 				
	KEY idx_user_id_thedate(user_id,thedate)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cloud_dwb_auc_pc_page_traff_d;
CREATE TABLE IF NOT EXISTS cloud_dwb_auc_pc_page_traff_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 	
	auction_id bigint(20)  NOT NULL DEFAULT '0', 		
	iuv bigint(20)  NOT NULL DEFAULT '0', 			
	ipv bigint(20)  NOT NULL DEFAULT '0', 			
	page_duration bigint(20)  NOT NULL DEFAULT '0', 			
	bounce_cnt bigint(20)  NOT NULL DEFAULT '0', 			
	landing_cnt bigint(20)  NOT NULL DEFAULT '0', 			
	landing_uv bigint(20)  NOT NULL DEFAULT '0', 			
	exit_cnt bigint(20)  NOT NULL DEFAULT '0', 			
	KEY idx_user_id_thedate_auction(user_id,thedate,auction_id)		
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cloud_dws_auction_query_effect_d;
CREATE TABLE IF NOT EXISTS cloud_dws_auction_query_effect_d (
	thedate DATE NULL,	
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	sid bigint(20) unsigned NOT NULL DEFAULT '0', 	
	auction_id bigint(20)  NOT NULL DEFAULT '0', 		
	query_x varchar(128) NOT NULL DEFAULT '',	
	impression bigint(20)  NOT NULL DEFAULT '0', 			
	click bigint(20)  NOT NULL DEFAULT '0', 			
	uv bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_winner_num bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_auction_num bigint(20)  NOT NULL DEFAULT '0', 			
	alipay_trade_amt decimal(12,2)  NOT NULL DEFAULT '0',	
	alipay_trade_num bigint(20)  NOT NULL DEFAULT '0', 			
	KEY idx_user_id_thedate_auction(user_id,thedate,auction_id)			
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS yii_shopcat;
CREATE TABLE yii_shopcat (
	cid int(10) unsigned NOT NULL DEFAULT '0',
	parent_cid int(10) unsigned NOT NULL DEFAULT '0',
	name varchar(64) NOT NULL default '',	
	KEY idx_cid (cid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


ALTER TABLE  yii_user 
	ADD x_para_json text

DROP TABLE IF EXISTS crm_grade;
CREATE TABLE IF NOT EXISTS crm_grade (
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	amount_1 decimal(10,2)  NOT NULL DEFAULT '0',
	amount_2 decimal(10,2)  NOT NULL DEFAULT '0',
	amount_3 decimal(10,2)  NOT NULL DEFAULT '0',
	amount_4 decimal(10,2)  NOT NULL DEFAULT '0',	
	count_1 int(11) unsigned NOT NULL DEFAULT '0',	
	count_2 int(11) unsigned NOT NULL DEFAULT '0',	
	count_3 int(11) unsigned NOT NULL DEFAULT '0',	
	count_4 int(11) unsigned NOT NULL DEFAULT '0',		
	discount_1 decimal(10,2)  NOT NULL DEFAULT '0',
	discount_2 decimal(10,2)  NOT NULL DEFAULT '0',
	discount_3 decimal(10,2)  NOT NULL DEFAULT '0',
	discount_4 decimal(10,2)  NOT NULL DEFAULT '0',
	PRIMARY KEY (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


ALTER TABLE guide_par
		ADD easing varchar(32) NOT NULL DEFAULT 'easeNone' after intervl,
		ADD direction tinyint(3) unsigned NOT NULL DEFAULT '0' after intervl,		
		CHANGE intervl intervl smallint(6) unsigned NOT NULL DEFAULT '0';

ALTER TABLE guide_par 
		ADD price_min decimal(10,2)  NOT NULL DEFAULT '0.00',
		ADD fill_row tinyint(3) unsigned NOT NULL DEFAULT '0';			

DROP TABLE IF EXISTS guide_collect;
CREATE TABLE IF NOT EXISTS guide_collect (
	sid int(11) unsigned NOT NULL DEFAULT '0',
	user_id bigint(20) unsigned NOT NULL DEFAULT '0',
	buyer_nick varchar(64) NOT NULL DEFAULT '',
	num_iid bigint(20) unsigned NOT NULL DEFAULT '0', 	
	update_time TIMESTAMP,				
	PRIMARY KEY (sid, buyer_nick, num_iid),
	KEY idx_sid_update_time(sid, update_time)	
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE guide_par 
	ADD rate_select_by_hand tinyint(3) unsigned NOT NULL default 0,
	ADD rate_content_bad_key varchar(200) NOT NULL DEFAULT '',			
	ADD intervl smallint(6) unsigned NOT NULL DEFAULT '3'	

DROP TABLE IF EXISTS guide_lat_lon;
CREATE TABLE IF NOT EXISTS guide_lat_lon (
	addr varchar(128) NOT NULL DEFAULT '',	
	lat float(10,5) NOT NULL DEFAULT '0.00000',	
	lon float(10,5) NOT NULL DEFAULT '0.00000',
	PRIMARY KEY (addr)				
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS guide_par;
CREATE TABLE IF NOT EXISTS guide_par (
	sid int(11) unsigned NOT NULL DEFAULT '0',
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	cat tinyint(3) unsigned NOT NULL DEFAULT '0',
	row_cnt tinyint(3) unsigned NOT NULL DEFAULT '0',	
	is_map tinyint(3) unsigned NOT NULL DEFAULT '0',		
	title_ship varchar(128) NOT NULL DEFAULT '',	
	title_rate varchar(128) NOT NULL DEFAULT '',	
	title_trade varchar(128) NOT NULL DEFAULT '',		
	msg_ship varchar(4096) NOT NULL DEFAULT '',	
	msg_rate varchar(4096) NOT NULL DEFAULT '',	
	msg_trade varchar(4096) NOT NULL DEFAULT '',
	rate_content_len_min smallint(6) unsigned NOT NULL DEFAULT '0',	
	rate_content_len_max smallint(6) unsigned NOT NULL DEFAULT '0',	
	title_color varchar(8) NOT NULL DEFAULT '#ffffff',		
	title_bg_color varchar(8) NOT NULL DEFAULT '#cc0000',
	rate_select_by_hand tinyint(3) unsigned NOT NULL default 0,
	rate_content_bad_key varchar(200) NOT NULL DEFAULT '',			
	intervl smallint(6) unsigned NOT NULL DEFAULT '3'	
	tag_id int(10) unsigned NOT NULL DEFAULT '0';	
	PRIMARY KEY (sid),				
	UNIQUE KEY idx_user_id(user_id)	
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS crm_sm_stat;
CREATE TABLE IF NOT EXISTS crm_sm_stat (
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
	senddate DATE NULL,	
	sum int(11) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (user_id, senddate)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS fan_sent_log;
CREATE TABLE IF NOT EXISTS fan_sent_log (
	buyer_nick varchar(64) NOT NULL DEFAULT '',
	receiver_mobile VARCHAR(64) NOT NULL DEFAULT '',			
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,			
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 		
	PRIMARY KEY (buyer_nick)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS kit_mb_par;
CREATE TABLE IF NOT EXISTS kit_mb_par (
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
	mb_id int(11) NOT NULL DEFAULT '0',
	json text,
	PRIMARY KEY (user_id, mb_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS kit_mb_image;
CREATE TABLE IF NOT EXISTS kit_mb_image (
	title varchar(64) NOT NULL default '',
	url varchar(128) NOT NULL default '',		
	PRIMARY KEY (title)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS yii_log;
CREATE TABLE IF NOT EXISTS yii_log (
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
	`level` varchar(128) DEFAULT NULL,
	category varchar(128) DEFAULT NULL,
	logtime int(11) DEFAULT NULL,
	message text,
	PRIMARY KEY (id),
	KEY idx_user_id(user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

		ALTER TABLE crm_sm_queue CHANGE receiver_mobile receiver_mobile TEXT;

		DROP TABLE IF EXISTS crm_event_action;
		CREATE TABLE crm_event_action (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0',
			event smallint(6) unsigned NOT NULL DEFAULT '0',
			action smallint(6) unsigned NOT NULL DEFAULT '0',
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			startTime DATETIME NULL,	
			endTime DATETIME NULL,
			json varchar(2048) NOT NULL DEFAULT '',
			PRIMARY KEY (user_id,event,action)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		ALTER TABLE crm_member 
			ADD sm_is_black tinyint(3) unsigned NOT NULL default 0,
			ADD sm_tot_cnt int(10) unsigned NOT NULL default 0,
			ADD sm_send_time DATETIME NOT NULL default '1970-01-01 08:00:00';	
		
		ALTER TABLE crm_sm_queue ADD buyer_nick varchar(64) NOT NULL DEFAULT '' after user_id;


		DROP TABLE IF EXISTS crm_group;
		CREATE TABLE crm_group (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
			group_id int(10) unsigned NOT NULL AUTO_INCREMENT,						
			group_name varchar(64) NOT NULL DEFAULT '',
			PRIMARY KEY (group_id),	
			KEY idx_user_id(user_id)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS prom_coupon;
		CREATE TABLE prom_coupon (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
			coupon_id int(10) unsigned NOT NULL DEFAULT '0', 								
			denominations int(10) unsigned NOT NULL DEFAULT '0', 		
			`condition` int(10) unsigned NOT NULL DEFAULT '0', 					
			create_channel varchar(64) NOT NULL DEFAULT '',
			creat_time DATETIME NULL,	
			end_time DATETIME NULL,
			KEY idx_user_id(user_id),
			PRIMARY KEY (coupon_id)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		ALTER TABLE yii_user ADD  x_crm_coupon_sum int(10) NOT NULL DEFAULT '10000' ;

		DROP TABLE IF EXISTS prom_activity;
		CREATE TABLE prom_activity (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
			toolId int(10) unsigned NOT NULL DEFAULT '0', 								
			activityId int(10) unsigned NOT NULL DEFAULT '0', 					
			name varchar(64) NOT NULL DEFAULT '',
			description varchar(128) NOT NULL DEFAULT '',
			participateRange varchar(64) NOT NULL DEFAULT '',
			status varchar(64) NOT NULL DEFAULT '',
			type varchar(64) NOT NULL DEFAULT '',			
			startTime varchar(32) NOT NULL DEFAULT '',
			endTime varchar(32) NOT NULL DEFAULT '',	
			options int(10) unsigned NOT NULL DEFAULT '0',
			targetType tinyint(3) unsigned NOT NULL DEFAULT '0',	
			targetIdGroup int(10) unsigned NOT NULL DEFAULT '0', 		
			targetIdUserTag int(10) unsigned NOT NULL DEFAULT '0', 	
			KEY idx_user_id(user_id),
			KEY idx_toolId(toolId),			
			PRIMARY KEY (activityId)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS prom_detail_xszk;
		CREATE TABLE prom_detail_xszk (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
			toolId int(10) unsigned NOT NULL DEFAULT '0', 											
			activityId int(10) unsigned NOT NULL DEFAULT '0', 					
			detailId int(10) unsigned NOT NULL DEFAULT '0', 
			startTime varchar(32) NOT NULL DEFAULT '',
			endTime varchar(32) NOT NULL DEFAULT '',	
			participateType varchar(64) NOT NULL DEFAULT '',
			participateId varchar(128) NOT NULL DEFAULT '',
			status varchar(64) NOT NULL DEFAULT '',			
			decreaseMoney decimal(10,2)  NOT NULL DEFAULT '0',
			discountRate decimal(10,2)  NOT NULL DEFAULT '0',			
			discount tinyint(3) unsigned NOT NULL DEFAULT '0',	
			decrease tinyint(3) unsigned NOT NULL DEFAULT '0',				
			decrmultiple tinyint(3) unsigned NOT NULL DEFAULT '0',	
			`limit` tinyint(3) unsigned NOT NULL DEFAULT '0',	
			limitCount int(10) unsigned NOT NULL DEFAULT '10000',									
			freepost tinyint(3) unsigned NOT NULL DEFAULT '0',
			excludeArea varchar(256) NOT NULL DEFAULT '',			
			beginAddCart varchar(32) NOT NULL DEFAULT '',
			endAddCart varchar(32) NOT NULL DEFAULT '',				
			KEY idx_user_id(user_id),
			KEY idx_activityId(activityId),			
			KEY idx_participateId(participateId),						
			PRIMARY KEY (detailId)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;











		DROP TABLE IF EXISTS crm_taguser;
		CREATE TABLE crm_taguser (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 					
			tag_id int(10) unsigned NOT NULL DEFAULT '0',
			buyer_nick varchar(64) NOT NULL DEFAULT '',
			PRIMARY KEY (user_id,tag_id,buyer_nick)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		ALTER TABLE crm_member ADD group_ids VARCHAR(1024) NOT NULL DEFAULT '' after avg_price;
		ALTER TABLE yii_user ADD x_dead tinyint(1) unsigned NOT NULL DEFAULT '0';
		
		DROP TABLE IF EXISTS yii_user_arc;
		CREATE TABLE yii_user_arc like yii_user;

		DROP TABLE IF EXISTS yii_shop_arc;
		CREATE TABLE yii_shop_arc like yii_shop;

		ALTER TABLE tool_item ADD kit_modify_title tinyint(3) unsigned NOT NULL default 0;
		ALTER TABLE tool_item ADD kit_modify_price tinyint(3) unsigned NOT NULL default 0;		

		ALTER TABLE crm_member DROP sid;	
		ALTER TABLE yii_user ADD  x_crm_rpc int(10) unsigned NOT NULL DEFAULT '90' after x_crm_sm_sum;	// Reasonable Purchase Cycle，即合理购买周期

		ALTER TABLE yii_user ADD  x_t_token VARCHAR(512) NOT NULL DEFAULT '' after x_sina_token;				

		DROP TABLE IF EXISTS weibo_template;
		CREATE TABLE weibo_template (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 			
			open tinyint(1) unsigned NOT NULL DEFAULT '0',
			cat tinyint(3) unsigned NOT NULL DEFAULT '1',	
			title VARCHAR(64) NOT NULL DEFAULT '',			
			msg VARCHAR(256) NOT NULL DEFAULT '',
			title_include VARCHAR(64) NOT NULL DEFAULT '',			
			amount decimal(10,2)  NOT NULL DEFAULT '0.00',
			rate_len int(10) unsigned NOT NULL DEFAULT '0', 						
			PRIMARY KEY (user_id, cat)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		ALTER TABLE yii_user ADD  x_crm_sm_sum_alm int(10) NOT NULL DEFAULT '0' after x_crm_sm_sum;

		ALTER TABLE crm_sm_template_cond ADD  memo VARCHAR(512) NOT NULL DEFAULT '';
		ALTER TABLE yii_user ADD  x_crm_sm_deadline1 DATETIME NOT NULL;
		ALTER TABLE yii_user ADD  x_crm_sm_deadline2 DATETIME NOT NULL;		
		ALTER TABLE yii_user ADD  x_crm_sm_deadline3 DATETIME NOT NULL;
		ALTER TABLE yii_user ADD  x_crm_sm_deadline4 DATETIME NOT NULL;		
		ALTER TABLE yii_user ADD  x_crm_sm_deadline5 DATETIME NOT NULL;
		ALTER TABLE tool_shop ADD  top_appkey varchar(16) NOT NULL DEFAULT '' after user_id;

		ALTER TABLE yii_user ADD  x_crm_member_last_time int(10) unsigned NOT NULL DEFAULT '0';
		ALTER TABLE yii_user ADD  x_crm_sm_sum int(10) NOT NULL DEFAULT '0';		
		ALTER TABLE yii_user ADD  x_sina_token VARCHAR(512) NOT NULL DEFAULT '';		
		
		ALTER TABLE yii_user ADD  x_name VARCHAR(64) NOT NULL DEFAULT '' after x_mob;			
		ALTER TABLE yii_user ADD  x_phone VARCHAR(64) NOT NULL DEFAULT '' after x_mob;			
		
		DROP TABLE IF EXISTS crm_member;
		CREATE TABLE crm_member (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 					
			sid bigint(20) unsigned NOT NULL DEFAULT '0', 		
			buyer_id bigint(20) unsigned NOT NULL DEFAULT '0', 						
			buyer_nick varchar(64) NOT NULL DEFAULT '',		
			grade int(10) unsigned NOT NULL DEFAULT '0', 			
			last_trade_time DATETIME NOT NULL,
			trade_count int(10) unsigned NOT NULL DEFAULT '0', 
			trade_amount decimal(10,2)  NOT NULL DEFAULT '0.00',
			item_num int(10) unsigned NOT NULL DEFAULT '0', 
			close_trade_count int(10) unsigned NOT NULL DEFAULT '0', 
			close_trade_amount decimal(10,2)  NOT NULL DEFAULT '0.00',
			item_close_count int(10) unsigned NOT NULL DEFAULT '0', 			
			relation_source int(10) unsigned NOT NULL DEFAULT '2', 
			status VARCHAR(16) NOT NULL DEFAULT 'normal',
			avg_price decimal(10,2)  NOT NULL DEFAULT '0.00',
			province int(10) unsigned NOT NULL DEFAULT '0', 
			receiver_mobile VARCHAR(64) NOT NULL DEFAULT '',		
			receiver_name VARCHAR(64) NOT NULL DEFAULT '',			
			receiver_phone VARCHAR(64) NOT NULL DEFAULT '',			
			receiver_zip VARCHAR(64) NOT NULL DEFAULT '',
			receiver_state VARCHAR(64) NOT NULL DEFAULT '',
			receiver_city VARCHAR(64) NOT NULL DEFAULT '',		
			receiver_district VARCHAR(64) NOT NULL DEFAULT '',								
			receiver_address VARCHAR(255) NOT NULL DEFAULT '',
			buyer_alipay_no VARCHAR(64) NOT NULL DEFAULT '',			
			buyer_email VARCHAR(64) NOT NULL DEFAULT '',
			buyer_area VARCHAR(64) NOT NULL DEFAULT '',	
			PRIMARY KEY (user_id,buyer_nick),			
			KEY idx_user_id_last_trade_time(user_id, last_trade_time)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS crm_topats;
		CREATE TABLE crm_topats (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 							
			task_id bigint(20) unsigned NOT NULL DEFAULT '0', 				
			method VARCHAR(64) NOT NULL DEFAULT '',	
			created DATETIME NOT NULL,			
			download_url VARCHAR(1024) NOT NULL DEFAULT '',	
			check_code VARCHAR(128) NOT NULL DEFAULT '',
			progress VARCHAR(64) NOT NULL DEFAULT '',						
			status VARCHAR(64) NOT NULL DEFAULT 'new',						
			PRIMARY KEY (task_id)		
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS crm_sm_queue;
		CREATE TABLE crm_sm_queue (
			id int(10) unsigned NOT NULL AUTO_INCREMENT,			
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
			buyer_nick varchar(64) NOT NULL DEFAULT '',			
			status int(10) unsigned NOT NULL DEFAULT '0', 		
			sendtime DATETIME NOT NULL,	
			created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,			
			receiver_mobile VARCHAR(64) NOT NULL DEFAULT '',	
			cat int(10) unsigned NOT NULL DEFAULT '0', 
			msg VARCHAR(1024) NOT NULL DEFAULT '',
			msg_id VARCHAR(32) NOT NULL DEFAULT '',	
			err_code VARCHAR(8) NOT NULL DEFAULT '',				
			msg_recvtime VARCHAR(32) NOT NULL DEFAULT '',	
			msg_sendtime VARCHAR(32) NOT NULL DEFAULT '',		
			tel_code VARCHAR(8) NOT NULL DEFAULT '',										
			PRIMARY KEY (id),	
			KEY idx_msg_id(msg_id),			
			KEY idx_user_id_created(user_id, status, created)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS crm_sm_template_comm;
		CREATE TABLE crm_sm_template_comm (
			id int(10) unsigned NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 
			title VARCHAR(128) NOT NULL DEFAULT '',
			msg VARCHAR(1024) NOT NULL DEFAULT '',
			send_after int(10) unsigned NOT NULL DEFAULT '0', 			
			PRIMARY KEY (id),	
			KEY idx_user_id_type(user_id)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
		

		DROP TABLE IF EXISTS crm_sm_template_cond;
		CREATE TABLE crm_sm_template_cond (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 			
			open tinyint(1) unsigned NOT NULL DEFAULT '0',
			cat tinyint(3) unsigned NOT NULL DEFAULT '1',	
			msg VARCHAR(1024) NOT NULL DEFAULT '',
			send_after int(10) unsigned NOT NULL DEFAULT '0', 			
			amount decimal(10,2)  NOT NULL DEFAULT '0.00',
			rate_for tinyint(3) unsigned NOT NULL DEFAULT '0',				
			PRIMARY KEY (user_id, cat)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;



		DROP TABLE IF EXISTS crm_trade_active;
		CREATE TABLE crm_trade_active (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 			
			tid bigint(20) unsigned NOT NULL DEFAULT '0', 			
			alipay_no VARCHAR(64) NOT NULL DEFAULT '',	
			status VARCHAR(64) NOT NULL DEFAULT '',	
			type VARCHAR(64) NOT NULL DEFAULT '',				
			created DATETIME NOT NULL,							
			pay_time DATETIME NOT NULL,							
			modified DATETIME NOT NULL,							
			end_time DATETIME NOT NULL,										
			consign_time DATETIME NOT NULL,													
			shipping_type VARCHAR(64) NOT NULL DEFAULT '',	
			cod_status VARCHAR(64) NOT NULL DEFAULT '',	
			buyer_rate VARCHAR(8) NOT NULL DEFAULT '',	
			seller_rate VARCHAR(8) NOT NULL DEFAULT '',	
			buyer_message VARCHAR(512) NOT NULL DEFAULT '',			
			post_fee decimal(10,2)  NOT NULL DEFAULT '0.00',						
			total_fee decimal(10,2)  NOT NULL DEFAULT '0.00',			
			payment decimal(10,2)  NOT NULL DEFAULT '0.00',	
			received_payment decimal(10,2)  NOT NULL DEFAULT '0.00',				
			commission_fee decimal(10,2)  NOT NULL DEFAULT '0.00',	
			available_confirm_fee decimal(10,2)  NOT NULL DEFAULT '0.00',				
			buyer_nick VARCHAR(64) NOT NULL DEFAULT '',		
			alipay_id bigint(20) unsigned NOT NULL DEFAULT '0',			
			buyer_area VARCHAR(64) NOT NULL DEFAULT '',	
			buyer_email VARCHAR(64) NOT NULL DEFAULT '',	
			buyer_alipay_no VARCHAR(64) NOT NULL DEFAULT '',				
			receiver_name VARCHAR(64) NOT NULL DEFAULT '',	
			receiver_state VARCHAR(64) NOT NULL DEFAULT '',	
			receiver_city VARCHAR(64) NOT NULL DEFAULT '',				
			receiver_district VARCHAR(64) NOT NULL DEFAULT '',	
			receiver_address VARCHAR(255) NOT NULL DEFAULT '',	
			receiver_zip VARCHAR(64) NOT NULL DEFAULT '',				
			receiver_mobile VARCHAR(64) NOT NULL DEFAULT '',	
			receiver_phone VARCHAR(64) NOT NULL DEFAULT '',
			PRIMARY KEY (tid),	
			KEY idx_user_id_created(user_id, created)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS crm_order_active;
		CREATE TABLE crm_order_active (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 			
			tid bigint(20) unsigned NOT NULL DEFAULT '0', 				
			oid bigint(20) unsigned NOT NULL DEFAULT '0', 	
			status VARCHAR(64) NOT NULL DEFAULT '',	
			title VARCHAR(128) NOT NULL DEFAULT '',				
			price decimal(10,2)  NOT NULL DEFAULT '0.00',	
			num_iid bigint(20) unsigned NOT NULL DEFAULT '0', 				
			num int(10) unsigned NOT NULL DEFAULT '0', 
			discount_fee decimal(10,2)  NOT NULL DEFAULT '0.00',				
			total_fee decimal(10,2)  NOT NULL DEFAULT '0.00',	
			payment decimal(10,2)  NOT NULL DEFAULT '0.00',	
			sku_id VARCHAR(64) NOT NULL DEFAULT '',	
			sku_properties_name VARCHAR(128) NOT NULL DEFAULT '',	
			refund_id bigint(20) unsigned NOT NULL DEFAULT '0', 	
			refund_status VARCHAR(64) NOT NULL DEFAULT '',		
			end_time DATETIME NOT NULL,										
			buyer_rate VARCHAR(8) NOT NULL DEFAULT '',	
			seller_rate VARCHAR(8) NOT NULL DEFAULT '',				
			cid int(10) unsigned NOT NULL DEFAULT '0', 
			PRIMARY KEY (oid),				
			UNIQUE KEY idx_tid_oid(tid, oid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


		DROP TABLE IF EXISTS crm_trade_arc;
		CREATE TABLE crm_trade_arc like crm_trade_active;

		DROP TABLE IF EXISTS crm_order_arc;
		CREATE TABLE crm_order_arc like crm_order_active;


		ALTER TABLE yii_user CHANGE  x_pid x_pid bigint(20) unsigned NOT NULL DEFAULT '0';	
		ALTER TABLE yii_user CHANGE  receiver_mobile receiver_mobile VARCHAR(65535) NOT NULL DEFAULT '',	
		ALTER TABLE yii_user ADD KEY idx_x_pid (x_pid);
//		ALTER TABLE crm_order_active ADD KEY idx_user_id_end_time(user_id, end_time);
		ALTER TABLE crm_order_active ADD KEY idx_user_id(user_id);		

		//x_session,x_ver should be delete ????
		//ALTER TABLE yii_user ADD  
		//	x_top_appkey varchar(16) NOT NULL DEFAULT '' after x_session,
		//	x_top_session varchar(255) NOT NULL DEFAULT '' after x_session,
		//	x_refresh_token varchar(255) NOT NULL DEFAULT '' after x_session,
		//	x_r2_expires_in int(10) unsigned NOT NULL DEFAULT '0' after x_session,
		//	buyer_message VARCHAR(1024) NOT NULL DEFAULT '',
		//			buyer_rate tinyint(1) unsigned NOT NULL DEFAULT '0',
		//			seller_rate tinyint(1) unsigned NOT NULL DEFAULT '0',
		//			is_oversold tinyint(1) unsigned NOT NULL DEFAULT '0',
		//ALTER TABLE yii_user ADD  x_crm_sm_status_pay tinyint(1) unsigned NOT NULL DEFAULT '0';
		//	msg_crc bigint(20) unsigned NOT NULL DEFAULT '0', 			
		//ALTER TABLE tool_item ADD user_id bigint(20) unsigned NOT NULL DEFAULT '0' after num_iid;

		INSERT INTO crm_sm_template_comm (`id`, `user_id`, `title`, `msg`, `send_after`) VALUES (NULL, '0', 'Christmas', 'Happy christmas for you', '0');		
		INSERT INTO crm_sm_template_cond (`user_id`, `open`, `cat`, `msg`, `send_after`, `amount`) VALUES ('0', '0', '1', 'Please pay for your goods as early', '7200', '10');				
		INSERT INTO crm_sm_template_cond (`user_id`, `open`, `cat`, `msg`, `send_after`, `amount`) VALUES ('0', '0', '2', 'Already Ship', '0', '10');						
		INSERT INTO crm_sm_template_cond (`user_id`, `open`, `cat`, `msg`, `send_after`, `rate_for`) VALUES ('0', '0', '3', 'You just got a bad rate!', '0', '0');
		INSERT INTO crm_sm_template_cond (`user_id`, `open`, `cat`, `msg`, `send_after`, `amount`) VALUES ('0', '0', '4', 'Could you give me a good rate?', '7200', '0');				
		INSERT INTO crm_sm_template_cond (`user_id`, `open`, `cat`, `msg`) VALUES ('156043787', '0', '100', 'Welcome to my shop!');
					
		UPDATE yii_user SET x_ver='';		

		DROP TABLE IF EXISTS tbl_columns;
		CREATE TABLE IF NOT EXISTS tbl_columns (
			id VARCHAR(100) NOT NULL,
			data VARCHAR(1024) NULL DEFAULT NULL,
			updated int(10) unsigned NOT NULL DEFAULT '0',				
			PRIMARY KEY (id)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE  IF NOT EXISTS  yii_itemcat (
			cid int(10) unsigned NOT NULL DEFAULT '0',	
			name varchar(64) NOT NULL DEFAULT '',									
			parent_cid int(10) unsigned NOT NULL DEFAULT '0',	
			is_parent tinyint(3) unsigned NOT NULL DEFAULT '0',	
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (cid),
			KEY idx_parent_cid (parent_cid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


		ALTER TABLE tool_shop ADD black_sub_user_ids varchar(255)  NOT NULL default '' after update_time;

		ALTER TABLE tool_item 
			ADD opt_time int(10) unsigned NOT NULL default 0,
			ADD opt_score tinyint(3) unsigned NOT NULL default 0,
			ADD opt_r0 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r1 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r2 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r3 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r4 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r5 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r6 varchar(128) NOT NULL DEFAULT '',
			ADD opt_r7 varchar(128) NOT NULL DEFAULT ''
		;		
		


		ALTER TABLE yii_user ADD x_trade_date int(10) unsigned NOT NULL default 0 after x_lastview_date;		
		ALTER TABLE keyword_cid add auto_id int(10) unsigned NOT NULL AUTO_INCREMENT key
		
		DROP TABLE IF EXISTS keyword_cid;
		CREATE TABLE keyword_cid (
			keyword varchar(128) NOT NULL DEFAULT '',			
			c1 varchar(64) NOT NULL DEFAULT '',						
			c2 varchar(64) NOT NULL DEFAULT '',						
			c3 varchar(64) NOT NULL DEFAULT '',									
			cnt varchar(64) NOT NULL DEFAULT '',									
			buy varchar(64) NOT NULL DEFAULT '',												
			ppc varchar(8) NOT NULL DEFAULT ''  			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;



		ALTER TABLE yii_user ADD x_trade_active_appkey varchar(32)  NOT NULL default '' after x_lastview_date;	
		ALTER TABLE yii_user ADD x_trade_active_session varchar(255)  NOT NULL default '' after x_lastview_date;	

		ALTER TABLE yii_user ADD x_ver varchar(8192) NOT NULL DEFAULT '' after email;		
		ALTER TABLE yii_user DROP x_favorites_titles, DROP x_favorites_iids, DROP x_favorites_date, DROP x_mob;	
		ALTER TABLE yii_user CHANGE  x_sessions x_session varchar(8192) NOT NULL DEFAULT '';		
		ALTER TABLE yii_user ADD x_mob varchar(64) NOT NULL DEFAULT '' after x_session;
		ALTER TABLE tool_shop ADD user_id bigint(20) unsigned NOT NULL DEFAULT 0 after sid;	
		ALTER IGNORE TABLE tool_shop ADD UNIQUE KEY idx_user_id (user_id);		

		ALTER TABLE tool_shop ADD update_time int(10) unsigned NOT NULL default 0 after nearest_delist_time;		
		ALTER TABLE tool_shop ADD adjust_step tinyint(3) unsigned NOT NULL default 0 after nearest_delist_time;					
		ALTER TABLE tool_shop ADD adjust_tick tinyint(3) unsigned NOT NULL default 0 after nearest_delist_time;	

		DROP TABLE IF EXISTS tool_setting;
		CREATE TABLE tool_setting (
			json varchar(4096) NOT NULL DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;		

		ALTER TABLE yii_item RENAME TO tool_item;		

		DROP TABLE IF EXISTS smtp_acc_1;
		CREATE TABLE smtp_acc_1 (
			id int(10) unsigned NOT NULL AUTO_INCREMENT,
			email_cat tinyint(3) unsigned NOT NULL default 0,						
			email_full varchar(255) NOT NULL DEFAULT '',
			username varchar(255) NOT NULL DEFAULT '',			
			password varchar(255) NOT NULL DEFAULT '',
			cnt int(10) unsigned NOT NULL DEFAULT '0',
			sum int(10) unsigned NOT NULL DEFAULT '0',
			cnt_err int(10) unsigned NOT NULL DEFAULT '0',			
			code smallint(6) unsigned NOT NULL DEFAULT '0',
			msg varchar(512) NOT NULL DEFAULT '',
			PRIMARY KEY (id),
			UNIQUE KEY idx_email_full(email_full),
			KEY idx_email_cat_cnt (email_cat, cnt)	,
			KEY idx_cnt (cnt)				
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS kit_log;
		CREATE TABLE kit_log (
			user_id bigint(20) unsigned NOT NULL DEFAULT '0', 		
			created int(10) unsigned NOT NULL DEFAULT '0',
			op tinyint(3) unsigned NOT NULL DEFAULT '0',
			par1 varchar(64) NOT NULL DEFAULT '',
			par2 varchar(64) NOT NULL DEFAULT '',
			code smallint(6) unsigned NOT NULL DEFAULT '0',
			msg varchar(256) NOT NULL DEFAULT '',
			KEY idx_user_id_created (user_id, created)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		ALTER TABLE tool_shop ADD rate_after_buyer tinyint(3) unsigned NOT NULL default 0 after nearest_delist_time;	
		ALTER TABLE tool_shop ADD rate_qiang_time tinyint(3) unsigned NOT NULL default 0 after nearest_delist_time;			
		ALTER TABLE tool_shop ADD rate_email varchar(64) NOT NULL DEFAULT '' after nearest_delist_time;					
		ALTER TABLE tool_shop ADD rate_mob varchar(64) NOT NULL DEFAULT '' after nearest_delist_time;	
		ALTER TABLE tool_shop ADD rate_mb_id tinyint(3) unsigned NOT NULL default 1 after nearest_delist_time;			
		ALTER TABLE tool_shop ADD rate_mb1 varchar(512) NOT NULL DEFAULT '' after nearest_delist_time;									
		ALTER TABLE tool_shop ADD rate_mb2 varchar(512) NOT NULL DEFAULT '' after nearest_delist_time;	
		ALTER TABLE tool_shop ADD rate_mb3 varchar(512) NOT NULL DEFAULT '' after nearest_delist_time;											
		ALTER TABLE tool_shop ADD rate_black_name varchar(512) NOT NULL DEFAULT '' after nearest_delist_time;													

		ALTER TABLE data_sold_buyer ADD id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
		ALTER TABLE  data_sold_seller ADD id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY

		DROP TABLE IF EXISTS tool_log_rate;
		CREATE TABLE tool_log_rate (
			sid bigint(20) unsigned NOT NULL DEFAULT '0', 
			created int(10) unsigned NOT NULL DEFAULT '0',	
			code smallint(6) unsigned NOT NULL DEFAULT '0',
			errmsg varchar(128) NOT NULL DEFAULT '',			
			tid bigint(20) unsigned NOT NULL DEFAULT '0', 
			oid bigint(20) unsigned NOT NULL DEFAULT '0',
			role varchar(16) NOT NULL DEFAULT 'seller',
			nick varchar(64) NOT NULL DEFAULT '',
			result tinyint(3) unsigned NOT NULL default 0,			
			rated_nick varchar(64) NOT NULL DEFAULT '',	
			item_title varchar(128) NOT NULL DEFAULT '',	
			item_price decimal(10,2)  NOT NULL DEFAULT '0.00',			
			content varchar(512) NOT NULL DEFAULT '',	
			KEY idx_sid_created (sid, created)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;


		CREATE TABLE `topsyn_task` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `app_key` varchar(256) DEFAULT NULL COMMENT '应用的appkey',
		  `user_id` bigint(20) DEFAULT NULL COMMENT '用户id',
		  `user_nick` varchar(32) DEFAULT NULL COMMENT '用户nick',
		  `type` int(11) NOT NULL COMMENT '任务类型',
		  `params` varchar(1024) DEFAULT NULL COMMENT '任务中的自定义参数',
		  `status` int(11) NOT NULL COMMENT '任务的状态',
		  `start_position` bigint(20) DEFAULT NULL COMMENT '任务的开始位置',
		  `now_position` bigint(20) DEFAULT NULL COMMENT '任务执行到的当前位置',
		  `end_position` bigint(20) DEFAULT NULL COMMENT '任务执行的结束位置',
		  `priority` int(11) DEFAULT NULL COMMENT '任务的优先级',
		  `retries` int(11) DEFAULT NULL COMMENT '任务重试次数',
		  `error_message` varchar(1024) DEFAULT NULL COMMENT '任务的错误信息',
		  `execute_ip` varchar(64) DEFAULT NULL COMMENT '执行任务机器IP',
		  `last_execute_time` datetime DEFAULT NULL COMMENT '任务的上一次执行时间',
		  `version` bigint(20) NOT NULL DEFAULT '1' COMMENT '任务当前的版本号，由于区分任务的修改',
		  `env` int(11) NOT NULL DEFAULT '1' COMMENT '任务的当前环境',
		  `gmt_create` datetime NOT NULL COMMENT '记录创建时间',
		  `gmt_modified` datetime NOT NULL COMMENT '记录修改时间',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;


		DROP TABLE IF EXISTS sm_invalid_cid;
		CREATE TABLE  IF NOT EXISTS  sm_invalid_cid (    
			cid int(10) unsigned NOT NULL DEFAULT '0',		
			cnt bigint(20) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (cid)			
		) ENGINE = MEMORY;
    
		
*/

EOD;
		Yii::app()->db->createCommand($sql)->execute();		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		
	}

	public function actionRefreshToken($par1, $par2=555) 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		echo "par1=$par1, par2=$par2";		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";				
	}

	public function actionTmp() 
	{
		echo __FUNCTION__;
		$time=microtime(true);
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";				
	}

	public function actionDown() 
	{
		exit;
		echo __FUNCTION__;
		$time=microtime(true);		
		//Yii::app()->db->createCommand()->dropTable('tool_log');		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";				
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportItemcat
	public function actionImportItemcat() 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		set_time_limit(0);				
		$n = Top::importItemcat(APP_KEY_CART);		
		echo __FUNCTION__." $n done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmItemcat
	public function actionImportSmItemcat() 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		set_time_limit(0);	
		$n = MSmItemCat::model()->import(APP_KEY_CART);
		echo __FUNCTION__." $n done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportCidBrand
	public function actionImportCidBrand() 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		set_time_limit(0);				

		$sql = "SELECT * FROM yii_itemcat WHERE is_parent='0' AND status != '3' ";		
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		$idx = 0;
		while(($item=$dataReader->read())!==false) 
		{ 			
			$cid = $item['cid'];
			$rows = Top::getItemPropValues(APP_KEY_CART, $cid, 20000);
			//U::W($rows);
			foreach ($rows as $row) 
			{	
				if ($cid != $row->{'cid'})
					die('panic in'.__FUNCTION__);
				if (empty($row->{'name'}))
					continue;
				$status = ($row->{'status'} == 'normal' ? 0 : 1);
				$n = Yii::app()->db->createCommand("INSERT IGNORE INTO yii_cid_brand (cid, name, name_alias, vid, status) VALUES (:cid, :name, :name_alias, :vid, :status)")->execute(array(':cid'=>$cid, ':name'=>$row->name, ':name_alias'=>$row->name_alias,':vid'=>$row->{'vid'}, ':status'=>$status));				
			}
			$n = Yii::app()->db->createCommand("UPDATE yii_itemcat SET status = '3' WHERE cid='$cid' ")->execute();			
		}			
		echo __FUNCTION__." $n done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb GetBrandName
	public function actionGetBrandName() 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		set_time_limit(0);				

		$n = Yii::app()->db->createCommand("TRUNCATE TABLE yii_brand_name")->execute();;
		$n = Yii::app()->db->createCommand("INSERT INTO yii_brand_name (vid,name,name_alias) SELECT vid,name,name_alias FROM yii_cid_brand GROUP BY vid ORDER BY vid")->execute();

		$sql = "SELECT * FROM yii_brand_name ";		
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		while(($row=$dataReader->read())!==false) 		
		{		
			$vid = $row['vid'];
			$pieces = explode("/" , $row['name']);
			if (count($pieces) == 1) 
			{
				$name1 = strtoupper($pieces[0]);
				$n = Yii::app()->db->createCommand("UPDATE yii_brand_name SET name1 = :name1 WHERE vid=:vid ")->execute(array(':name1'=>$name1, ':vid'=>$vid));	
			} 
			else 
			{		
				$name1 = strtoupper($pieces[0]);
				$name2 = strtoupper($pieces[1]);			
				$n = Yii::app()->db->createCommand("UPDATE yii_brand_name SET name1 = :name1, name2 = :name2 WHERE vid=:vid ")->execute(array(':name1'=>$name1, ':name2'=>$name2, ':vid'=>$vid));					
			}
		}	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";	
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ExportBrandNameToTxt
	public function actionExportBrandNameToTxt() 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		set_time_limit(0);				
		$sql = "SELECT * FROM yii_brand_name ";		
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		while(($row=$dataReader->read())!==false) 				
		{		
			if ( $row['name1'] != '')
				$sum[] = $row['name1'];
			if ( $row['name2'] != '')
				$sum[] = $row['name2'];			
		}	
		$sum = array_unique($sum);
		sort($sum);
		$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'dict_brand.txt';				
		foreach ($sum as $item)
			error_log(trim($item)."\r\n", 3, $filename);	

		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";	
		return;		
	}

	public function actionHandleFetchWyl0() 
	{
		require_once('simplehtmldom/simple_html_dom.php');				
		set_time_limit(0);		
		$command = Yii::app()->db->createCommand();		
		$files=CFileHelper::findFiles(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'wyl',array(
			//'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		Util::write_log($files);	
		
		$idx = 0;
		foreach($files as $file)		
		{
/*			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log('is not .log');
				continue;
			}
*/			
			Util::write_log("$file");					
			$resp = file_get_contents($file);
			$html = str_get_html($resp);
			$trs = $html->find('td.diggtdright');			
			foreach($trs as $tr) 
			{	
				$keyword = strip_tags($tr->innertext);
				error_log(trim($keyword)."\r\n", 3, Yii::app()->getRuntimePath()."/wyl.log");				
				break;
			}
			$html->clear();
			unset($html);
			$idx++;
			//if ($idx == 1) break;
		}
	}

	public function actionHandleFetchWyl1() 
	{
		require_once('simplehtmldom/simple_html_dom.php');			
	
		echo __FUNCTION__;
		$time=microtime(true);	

		set_time_limit(0);		
		$idx = 350;
		while (1)
		{
			$sysParams["id"] = $idx+1;
			$requestUrl = 'http://www.wllxy.net/GXQMview.aspx' . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);
			try
			{		
				$resp = Util::my_curl($requestUrl, null);
			}
			catch (Exception $e)
			{
				Util::write_log("err:".$e->getCode().$e->getMessage());
				if ($e->getCode()=='302' || $e->getCode()=='500') {
					return;
				}	
				sleep(1);								
				continue;
			}
			$dbh = Yii::app()->db->pdoInstance;
			$html = str_get_html($resp);
			$trs = $html->find('td.diggtdright');			
			foreach($trs as $tr) 
			{	
				$keyword = trim(strip_tags($tr->innertext));
				if ($keyword != '*')
				{
					Util::write_log("$idx exist.");					
					error_log(trim($keyword)."\r\n", 3, Yii::app()->getRuntimePath()."/wyl_b.log");				
				}
				break;
			}
			$idx++;
			if ($idx >= 9700) 
			{
				Util::write_log("$idx end");			
				break;
			}
			$html->clear();
			unset($html);
			Util::write_log("$idx ...");
			sleep(8);			
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;
		
	}

	public function actionHandleFetchWyl2() 
	{
		require_once('simplehtmldom/simple_html_dom.php');			
	
		echo __FUNCTION__;
		$time=microtime(true);	

		set_time_limit(0);		
		
		$idx = 0;
		while (1)
		{
			$sysParams["id"] = $idx+1;
			$requestUrl = 'http://www.wllxy.net/article.aspx' . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);
			try
			{		
				$resp = Util::my_curl($requestUrl, null);
			}
			catch (Exception $e)
			{
				Util::write_log("err:".$e->getCode().$e->getMessage());
				if ($e->getCode()=='302' || $e->getCode()=='500') {
					return;
				}		
				sleep(1);								
				continue;
			}
			$dbh = Yii::app()->db->pdoInstance;
			$html = str_get_html($resp);
			$trs = $html->find('.articlecontent li');
			//unset($trs[0]);			
			foreach($trs as $tr) 
			{						
				//$tds = $tr->find('td');
				$keyword = strip_tags($tr->innertext);
				error_log(trim($keyword)."\r\n", 3, Yii::app()->getRuntimePath()."/wyl_ar.log");								
			}
			$idx++;
			if ($idx >= 170) 
			{
				Util::write_log("$idx end");			
				break;
			}
			$html->clear();
			unset($html);
			Util::write_log("$idx ...");
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;
		
	}

	public function actionHandleFetchTianya() 
	{
		require_once('simplehtmldom/simple_html_dom.php');			
	
		echo __FUNCTION__;
		$time=microtime(true);	

		set_time_limit(0);		
		$idx = 1;
		while (1)
		{
			$requestUrl = "http://bbs.tianya.cn/post-free-2081950-{$idx}.shtml";
			$resp = file_get_contents($requestUrl);
			file_put_contents(Yii::app()->getRuntimePath()."/tianya_{$idx}.html", $resp);
/*
			$html = str_get_html($resp);
			$trs = $html->find('.bbs-content');			
			foreach($trs as $tr) 
			{	
				$keyword = trim(strip_tags($tr->innertext));
//				if ($keyword != '*')
				{
					error_log(trim($keyword)."\r\n", 3, Yii::app()->getRuntimePath()."/tianya.log");				
				}
				break;
			}
			$html->clear();
			unset($html);
*/			
			Util::write_log("$idx ...");
			$idx++;
			if ($idx > 258) 
			{
				Util::write_log("end");			
				break;
			}
			sleep(1);			
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;
		
	}

	public function actionFetch() 
	{
		require_once('simplehtmldom/simple_html_dom.php');			
	
		echo __FUNCTION__;
		$time=microtime(true);	

		set_time_limit(0);		
		
/*
//		$i = 662;
		$i = 0;
		while (1)
		{
			$sysParams["action"] = "ajax_load_words";
			$sysParams["pagenum"] = $i+1;
//			$sysParams["perpage"] = 100;						
			$sysParams["w"] = "";				
			$sysParams["c1"] = "";		
			$sysParams["c2"] = "";	
			$requestUrl = 'http://seo.dzsofts.net/words.php' . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);			
			try
			{		
				$resp = self::my_curl($requestUrl, null);
			}
			catch (Exception $e)
			{
//				$result->code = $e->getCode();
//				$result->msg = $e->getMessage();
//				T(print_r($result,true));	
				Util::write_log("err:".$e->getCode().$e->getMessage());
				continue;
			}
			$respObject = json_decode($resp);
			T(print_r($respObject,true));				
			$list_content = $respObject->{'list_content'};
			$txt = strip_tags($list_content);			
			$total = $respObject->{'total'};
			Util::write_log("$i...");				
			Util::write_log($txt, Yii::app()->getRuntimePath().'/key.log');
			$i++;
			break;			
			if ($i >= 10000) 
			{
				Util::write_log("end");			
				break;
			}
		}
*/

		$idx = 0;
		while (1)
		{
			$sysParams["action"] = "search";
			$sysParams["pagenum"] = $idx+1;
			$requestUrl = 'http://seo.dzsofts.net/promotion.php' . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);
			try
			{		
				$resp = Util::my_curl($requestUrl, null);
			}
			catch (Exception $e)
			{
				Util::write_log("err:".$e->getCode().$e->getMessage());
				if ($e->getCode()=='302' || $e->getCode()=='500') {
					return;
				}					
				continue;
			}

			$dbh = Yii::app()->db->pdoInstance;
			$html = str_get_html($resp);
			$trs = $html->find('table.tableOutborder tbody tr');
			unset($trs[0]);			
			foreach($trs as $tr) 
			{			    	
				$tds = $tr->find('td');
				$keyword = strip_tags($tds[0]->innertext);
				$c1 = strip_tags($tds[1]->innertext);
				$c2 = strip_tags($tds[2]->innertext);
				$c3 = strip_tags($tds[3]->innertext);
				$cnt = strip_tags($tds[4]->innertext);
				$buy = strip_tags($tds[5]->innertext);			   
				$ppc = strip_tags($tds[6]->innertext);			   			   
				Util::write_log("$keyword,$c1,$c2,$c3,$cnt,$buy,$ppc", Yii::app()->getRuntimePath().'/key_promotion.log');	
				$stmt = $dbh->prepare("INSERT INTO keyword_cid_test (keyword,c1,c2,c3,cnt,buy,ppc) VALUES (:keyword,:c1,:c2,:c3,:cnt,:buy,:ppc)"); 
				$stmt->execute( array(':keyword' => $keyword, ':c1' => $c1,':c2' => $c2,':c3' => $c3,':cnt' => $cnt,':buy' => $buy,':ppc' => $ppc));
			}
			$idx++;
			if ($idx >= 2000) 
			{
				Util::write_log("$idx end");			
				break;
			}
			$html->clear();
			unset($html);
			Util::write_log("$idx ...");
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;
		
	}

	public function actionFetchDemo1() 
	{
		echo __FUNCTION__."...";	
		$time=microtime(true);	

		set_time_limit(0);		
		
		$idx = 0;
		if (1)
		{
			$sysParams["action"] = "show";
			$requestUrl = 'http://haopingshow1.kekeapp.com/DoRequest.aspx' . "?";
			foreach ($sysParams as $sysParamKey => $sysParamValue)
			{
				$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
			}
			$requestUrl = substr($requestUrl, 0, -1);
			try
			{
			L($requestUrl);
				$resp = Util::my_curl($requestUrl, array('shop_id'=>36016583, 'seller_nick'=>'hezhy2005', 'width'=>750));
			}
			catch (Exception $e)
			{
				Util::write_log("err:".$e->getCode().$e->getMessage());
			}
			L($resp);
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
		return;
		
	}
	

	// yiic hhb test --par1=123 --par2=789  <=> yiic hhb test --par2=789 --par1=123
	public function actionTest($par1, $par2=555) 
	{
		echo __FUNCTION__;
		$time=microtime(true);	
		echo "par1=$par1, par2=$par2";		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";				
	}

	public function getHelp()
	{
		return <<<EOD
		USAGE:
			yiic hhb up
			yiic hhb down  
			yiic hhb test --par1=1 --par2=5
EOD;
	}

	public function actionDispTrade() 
	{
		set_time_limit(0);
		$log_file = 'stat_trade';		
//		$log_file = 'trade';
		$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.$log_file. "_" . date("Y-m-d") . ".log";
		$fh = fopen($filename, "r");
		while (!feof($fh)) {
			$line = fgets($fh);
			$obj = json_decode($line);
//			T(print_r($obj,true));	
			Util::write_log(print_r($obj,true));	
		}
		fclose($fh);		
	}

	public function actionHandleBought() 
	{
		set_time_limit(0);
		
		$sql=<<<EOD
		
		CREATE TABLE IF NOT EXISTS data_buyer (
			receiver_name VARCHAR(64) NOT NULL,			
			receiver_mobile VARCHAR(64) NOT NULL,
			receiver_phone VARCHAR(64) NOT NULL,			
			receiver_zip VARCHAR(64) NOT NULL,
			receiver_state VARCHAR(64) NOT NULL,
			receiver_city VARCHAR(64) NOT NULL,		
			receiver_district VARCHAR(64) NOT NULL,								
			receiver_address VARCHAR(255) NOT NULL,
			buyer_nick VARCHAR(64) NOT NULL,
			seller_nick VARCHAR(64) NOT NULL,						
			created VARCHAR(32) NOT NULL			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE  IF NOT EXISTS  data_buyer_order (
			receiver_name VARCHAR(64) NOT NULL,			
			receiver_mobile VARCHAR(64) NOT NULL,
			cid int(10) unsigned NOT NULL DEFAULT '0',				
			title VARCHAR(128) NOT NULL,
			price decimal(10,2)  NOT NULL DEFAULT '0.00',
			oid VARCHAR(64) NOT NULL,
			sku_id VARCHAR(64) NOT NULL,
			sku_properties_name VARCHAR(128) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
EOD;
		Yii::app()->db->createCommand($sql)->execute();		

		$command = Yii::app()->db->createCommand();		
		$idx = 0;
		for ($idx=0;$idx<22;$idx++)
		{
			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'bought'.DIRECTORY_SEPARATOR."trades.log.{$idx}";
			$fh = fopen($filename, "r");
			$i = 0;
			Util::write_log("$filename");			
			while (!feof($fh)) {
				$line = fgets($fh);
				if (empty($line))
					break;
				// $objs is all rows of one buyer_nick			
				$objs = json_decode($line);
//				Util::write_log(print_r($objs,true));	
				if (!is_array($objs)) {
					Util::write_log(print_r($objs,true));	
					continue;
				}
				foreach ($objs as $obj) 
				{ 			
					if (empty($obj->receiver_mobile))
						continue;
 					try {
						$command->insert('data_buyer', array(
							'receiver_name'=>empty($obj->receiver_name) ? '' : $obj->receiver_name, 
							'receiver_mobile'=>empty($obj->receiver_mobile) ? '' : $obj->receiver_mobile, 
							'receiver_phone'=>empty($obj->receiver_phone) ? '' : $obj->receiver_phone, 
							'receiver_zip'=>empty($obj->receiver_zip) ? '' : $obj->receiver_zip, 
							'receiver_state'=>empty($obj->receiver_state) ? '' : $obj->receiver_state, 
							'receiver_city'=>empty($obj->receiver_city) ? '' : $obj->receiver_city, 
							'receiver_district'=>empty($obj->receiver_district) ? '' : $obj->receiver_district, 
							'receiver_address'=>empty($obj->receiver_address) ? '' : $obj->receiver_address, 
							'buyer_nick'=>$obj->buyer_nick, 
							'seller_nick'=>$obj->seller_nick, 
							'created'=>$obj->created,
						));		
					} catch (Exception $e) {
						Util::write_log($e->getCode().":".$e->getMessage());
						continue;			
					}

					$orders = $obj->orders->order;
					foreach ($orders as $order) 
					{ 
						try {
							$command->insert('data_buyer_order', array(
								'receiver_name'=>empty($obj->receiver_name) ? '' : $obj->receiver_name, 
								'receiver_mobile'=>empty($obj->receiver_mobile) ? '' : $obj->receiver_mobile, 								
								'cid'=>empty($order->cid) ? '0' : $order->cid, 
								'title'=>$order->title, 
								'price'=>empty($order->price) ? '0' : $order->price,
								'oid'=>number_format($order->oid, 0, '', ''),
								'sku_id'=>empty($order->sku_id) ? '' : $order->sku_id, 
								'sku_properties_name'=>empty($order->sku_properties_name) ? '' : $order->sku_properties_name, 
							));					
			
						} catch (Exception $e) {
							Util::write_log($e->getCode().":".$e->getMessage());
							continue;			
						}
					} 

				}
				$i++;
//				if ($i==5) break;			
			}
			fclose($fh);				
		}

		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_buyer ADD PRIMARY KEY (receiver_mobile)")->execute();		
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_buyer_order ADD PRIMARY KEY (oid)")->execute();		
		Yii::app()->db->createCommand("ALTER TABLE data_buyer_order ADD KEY idx_receiver_mobile (receiver_mobile)")->execute();
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_buyer_order  DROP PRIMARY KEY")->execute();		
				
	}

	public function actionHandleSold() 
	{
		set_time_limit(0);
		
		$sql=<<<EOD

		CREATE TABLE IF NOT EXISTS data_sold_buyer (
			buyer_nick VARCHAR(64) NOT NULL,	
			buyer_alipay_no VARCHAR(64) NOT NULL,			
			buyer_email VARCHAR(64) NOT NULL,
			buyer_area VARCHAR(64) NOT NULL,		
			alipay_id VARCHAR(64) NOT NULL,			
			receiver_mobile VARCHAR(64) NOT NULL,			
			receiver_name VARCHAR(64) NOT NULL,			
			receiver_phone VARCHAR(64) NOT NULL,			
			receiver_zip VARCHAR(64) NOT NULL,
			receiver_state VARCHAR(64) NOT NULL,
			receiver_city VARCHAR(64) NOT NULL,		
			receiver_district VARCHAR(64) NOT NULL,								
			receiver_address VARCHAR(255) NOT NULL,
			created VARCHAR(32) NOT NULL						
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE IF NOT EXISTS data_sold_receiver (
			receiver_mobile VARCHAR(64) NOT NULL,		
			receiver_name VARCHAR(64) NOT NULL,			
			receiver_phone VARCHAR(64) NOT NULL,			
			receiver_zip VARCHAR(64) NOT NULL,
			receiver_state VARCHAR(64) NOT NULL,
			receiver_city VARCHAR(64) NOT NULL,		
			receiver_district VARCHAR(64) NOT NULL,								
			receiver_address VARCHAR(255) NOT NULL,
			buyer_nick VARCHAR(64) NOT NULL,	
			buyer_alipay_no VARCHAR(64) NOT NULL,			
			buyer_email VARCHAR(64) NOT NULL,
			buyer_area VARCHAR(64) NOT NULL,					
			created VARCHAR(32) NOT NULL			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE  IF NOT EXISTS  data_sold_receiver_order (
			receiver_mobile VARCHAR(64) NOT NULL,	
			receiver_phone VARCHAR(64) NOT NULL,						
			receiver_name VARCHAR(64) NOT NULL,			
			buyer_nick VARCHAR(64) NOT NULL,	
			buyer_alipay_no VARCHAR(64) NOT NULL,			
			buyer_email VARCHAR(64) NOT NULL,
			buyer_area VARCHAR(64) NOT NULL,		
			cid int(10) unsigned NOT NULL DEFAULT '0',				
			title VARCHAR(128) NOT NULL,
			price decimal(10,2)  NOT NULL DEFAULT '0.00',
			oid VARCHAR(64) NOT NULL,
			seller_type VARCHAR(16) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		CREATE TABLE IF NOT EXISTS data_sold_seller (
			seller_nick VARCHAR(64) NOT NULL,	
			seller_name VARCHAR(64) NOT NULL,					
			seller_mobile VARCHAR(64) NOT NULL,
			seller_email VARCHAR(64) NOT NULL,			
			seller_alipay_no VARCHAR(64) NOT NULL,
			seller_phone VARCHAR(64) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;
				
EOD;
		Yii::app()->db->createCommand($sql)->execute();

		$command = Yii::app()->db->createCommand();		

		$files=CFileHelper::findFiles(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'sold',array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		Util::write_log($files);	
		
		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log('is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					break;
					
				$obj = json_decode($line, true);				
//				Util::write_log(print_r($obj,true));	
				try {
					$command->insert('data_sold_buyer', array(
						'buyer_nick'=>empty($obj['buyer_nick']) ? '' : $obj['buyer_nick'],
						'buyer_alipay_no'=>empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'],
						'buyer_email'=>empty($obj['buyer_email']) ? '' : $obj['buyer_email'],
						'buyer_area'=>empty($obj['buyer_area']) ? '' : $obj['buyer_area'],
						'alipay_id'=>empty($obj['alipay_id']) ? '' : $obj['alipay_id'],
						'receiver_mobile'=>empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'],
						'receiver_name'=>empty($obj['receiver_name']) ? '' : $obj['receiver_name'],
						'receiver_phone'=>empty($obj['receiver_phone']) ? '' : $obj['receiver_phone'],
						'receiver_zip'=>empty($obj['receiver_zip']) ? '' : $obj['receiver_zip'],
						'receiver_state'=>empty($obj['receiver_state']) ? '' : $obj['receiver_state'],
						'receiver_city'=>empty($obj['receiver_city']) ? '' : $obj['receiver_city'],
						'receiver_district'=>empty($obj['receiver_district']) ? '' : $obj['receiver_district'],
						'receiver_address'=>empty($obj['receiver_address']) ? '' : $obj['receiver_address'],
						'created'=>empty($obj['created']) ? '' : $obj['created'],
					));		
				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
				}
				
				try {
					$command->insert('data_sold_receiver', array(
						'receiver_mobile'=>empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'],
						'receiver_name'=>empty($obj['receiver_name']) ? '' : $obj['receiver_name'],
						'receiver_phone'=>empty($obj['receiver_phone']) ? '' : $obj['receiver_phone'],
						'receiver_zip'=>empty($obj['receiver_zip']) ? '' : $obj['receiver_zip'],
						'receiver_state'=>empty($obj['receiver_state']) ? '' : $obj['receiver_state'],
						'receiver_city'=>empty($obj['receiver_city']) ? '' : $obj['receiver_city'],
						'receiver_district'=>empty($obj['receiver_district']) ? '' : $obj['receiver_district'],
						'receiver_address'=>empty($obj['receiver_address']) ? '' : $obj['receiver_address'],
						'buyer_nick'=>empty($obj['buyer_nick']) ? '' : $obj['buyer_nick'],
						'buyer_alipay_no'=>empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'],
						'buyer_email'=>empty($obj['buyer_email']) ? '' : $obj['buyer_email'],
						'buyer_area'=>empty($obj['buyer_area']) ? '' : $obj['buyer_area'],
						'created'=>empty($obj['created']) ? '' : $obj['created'],
					));		
				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
				}

				$orders = $obj['orders']['order'];
				if (!isset($orders['0'])) {
					$orders = array($orders);					
				} 

				foreach ($orders as $order) 
				{ 
					try {
						$command->insert('data_sold_receiver_order', array(
							'receiver_mobile'=>empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'],
							'receiver_name'=>empty($obj['receiver_name']) ? '' : $obj['receiver_name'],
							'receiver_phone'=>empty($obj['receiver_phone']) ? '' : $obj['receiver_phone'],
							'buyer_nick'=>empty($obj['buyer_nick']) ? '' : $obj['buyer_nick'],
							'buyer_alipay_no'=>empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'],
							'buyer_email'=>empty($obj['buyer_email']) ? '' : $obj['buyer_email'],
							'buyer_area'=>empty($obj['buyer_area']) ? '' : $obj['buyer_area'],
							'cid'=>empty($order['cid']) ? '0' : $order['cid'], 
							'title'=>$order['title'], 
							'price'=>empty($order['price']) ? '0' : $order['price'],
							'oid'=>number_format($order['oid'], 0, '', ''),
							'seller_type'=>empty($order['seller_type']) ? '' : $order['seller_type'],							
						));					
		
					} catch (Exception $e) {
						Util::write_log($e->getCode().":".$e->getMessage());
						continue;			
					}
				} 

				try {
					$command->insert('data_sold_seller', array(
						'seller_nick'=>empty($obj['seller_nick']) ? '' : $obj['seller_nick'], 
						'seller_name'=>empty($obj['seller_name']) ? '' : $obj['seller_name'], 
						'seller_mobile'=>empty($obj['seller_mobile']) ? '' : $obj['seller_mobile'], 
						'seller_email'=>empty($obj['seller_email']) ? '' : $obj['seller_email'], 
						'seller_alipay_no'=>empty($obj['seller_alipay_no']) ? '' : $obj['seller_alipay_no'], 
						'seller_phone'=>empty($obj['seller_phone']) ? '' : $obj['seller_phone'], 
					));		
				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
				}

				$i++;				
				if ($i % 2000 == 1) {
					Util::write_log(memory_get_usage());				
//					break;		
				}
			}
			fclose($fh);	

			$idx++;
//			if ($idx == 1) break;
		}

/*
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_buyer ADD PRIMARY KEY (buyer_nick)")->execute();		
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_receiver ADD PRIMARY KEY (receiver_mobile)")->execute();	
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_seller ADD PRIMARY KEY (seller_nick)")->execute();						
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_receiver_order ADD PRIMARY KEY (oid)")->execute();	
		
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_buyer DROP PRIMARY KEY")->execute();		
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_receiver DROP PRIMARY KEY")->execute();				
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_seller DROP PRIMARY KEY")->execute();
		Yii::app()->db->createCommand("ALTER IGNORE TABLE data_sold_receiver_order  DROP PRIMARY KEY")->execute();	
			
//		Yii::app()->db->createCommand("ALTER TABLE data_sold_receiver_order ADD KEY idx_receiver_mobile (receiver_mobile)")->execute();		
*/				
	}

	public function actionUp() 
	{
		exit;
		
		echo "Up...";
		$time=microtime(true);
	
		$sql=<<<EOD
		
		DROP TABLE IF EXISTS yii_user;
		CREATE TABLE yii_user (
			user_id bigint(20) unsigned NOT NULL DEFAULT 0,
			uid varchar(64) NOT NULL DEFAULT '',
			nick varchar(128) NOT NULL DEFAULT '',    
			sex char(1) NOT NULL DEFAULT 'm',
			buyer_credit_level tinyint(3) unsigned NOT NULL default 0,
			seller_credit_level tinyint(3) unsigned NOT NULL default 0,
			location_zip varchar(64) NOT NULL DEFAULT '',
			location_address varchar(255) NOT NULL DEFAULT '', 
			location_city varchar(255) NOT NULL DEFAULT '', 
			location_state varchar(255) NOT NULL DEFAULT '', 
			location_country varchar(255) NOT NULL DEFAULT '', 
			location_district varchar(255) NOT NULL DEFAULT '', 
			created int(10) unsigned NOT NULL default 0,  
			birthday int(10) unsigned NOT NULL default 0,  
			type varchar(8) NOT NULL DEFAULT 'C',  
			promoted_type varchar(32) NOT NULL DEFAULT '', 
			status varchar(16) NOT NULL DEFAULT '',	
			alipay_bind varchar(64) NOT NULL DEFAULT '', 	
			consumer_protection tinyint(3) unsigned NOT NULL default 0,
			alipay_account varchar(64) NOT NULL DEFAULT '', 
			alipay_no varchar(64) NOT NULL DEFAULT '', 
			avatar varchar(128) NOT NULL DEFAULT '', 
			liangpin  tinyint(3) unsigned NOT NULL default 0,   
			sign_food_seller_promise  tinyint(3) unsigned NOT NULL default 0,	
			has_shop  tinyint(3) unsigned NOT NULL default 0,   
			vip_info varchar(32) NOT NULL DEFAULT '', 
			email varchar(64) NOT NULL DEFAULT '', 
			x_ver varchar(8192) NOT NULL DEFAULT '',
			x_session varchar(8192) NOT NULL DEFAULT '',	
			x_mob varchar(64) NOT NULL DEFAULT '', 						
			x_password varchar(16) NOT NULL DEFAULT '',
			x_register_date int(10) unsigned NOT NULL DEFAULT '0',
			x_lastview_date int(10) unsigned NOT NULL DEFAULT '0',
			x_pid int(10) unsigned NOT NULL DEFAULT '0',
			x_status int(10) unsigned NOT NULL default 0,      
			PRIMARY KEY (user_id),
			UNIQUE KEY idx_nick (nick)
		) ENGINE=MyISAM default CHARSET=utf8;

		DROP TABLE IF EXISTS yii_shop;
		CREATE TABLE yii_shop (
			sid bigint(20) unsigned NOT NULL DEFAULT '0',
			user_id bigint(20) unsigned NOT NULL DEFAULT '0',
			cid int(10) unsigned NOT NULL default 0,  
			nick varchar(255) NOT NULL DEFAULT '',    
			title varchar(255) NOT NULL DEFAULT '',  
			desc_x varchar(255) NOT NULL DEFAULT '',
			pic_path varchar(255) NOT NULL DEFAULT '',
			created int(10) unsigned NOT NULL default 0,  
			PRIMARY KEY (sid),  
			UNIQUE KEY idx_user_id(user_id)
		) ENGINE=MyISAM default CHARSET=utf8;

		DROP TABLE IF EXISTS tool_item;
		CREATE TABLE tool_item (
			num_iid bigint(20) unsigned NOT NULL DEFAULT '0',
			sid bigint(20) unsigned NOT NULL DEFAULT '0',
			title varchar(64) NOT NULL DEFAULT '',
			pic_url varchar(128) NOT NULL DEFAULT '',
			price decimal(10,2)  NOT NULL DEFAULT '0.00',
			cid int(10) NOT NULL DEFAULT '0',
			seller_cids varchar(96) NOT NULL DEFAULT '',
			x_status int(10) unsigned NOT NULL DEFAULT '0',	
			UNIQUE KEY idx_num_iid (num_iid),
			KEY idx_sid (sid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS tool_shop;
		CREATE TABLE tool_shop (
			sid bigint(20) unsigned NOT NULL DEFAULT '0',
			user_id bigint(20) unsigned NOT NULL DEFAULT 0,			
			top_session varchar(255)  NOT NULL default '',  
			shop_status smallint(6) unsigned NOT NULL DEFAULT '0',
			total_showcase tinyint(3) unsigned NOT NULL DEFAULT '0',
			nearest_delist_time int(10) unsigned NOT NULL DEFAULT '0',
			adjust_tick tinyint(3) unsigned NOT NULL default 0,
			adjust_step tinyint(3) unsigned NOT NULL default 0,
			update_time int(10) unsigned NOT NULL default 0,			
			e0 smallint(6) unsigned NOT NULL DEFAULT '0',
			e1 smallint(6) unsigned NOT NULL DEFAULT '0',
			e2 smallint(6) unsigned NOT NULL DEFAULT '0',
			e3 smallint(6) unsigned NOT NULL DEFAULT '0',
			e4 smallint(6) unsigned NOT NULL DEFAULT '0',
			e5 smallint(6) unsigned NOT NULL DEFAULT '0',
			e6 smallint(6) unsigned NOT NULL DEFAULT '0',
			e7 smallint(6) unsigned NOT NULL DEFAULT '0',
			e8 smallint(6) unsigned NOT NULL DEFAULT '0',
			e9 smallint(6) unsigned NOT NULL DEFAULT '0',
			e10 smallint(6) unsigned NOT NULL DEFAULT '0',
			e11 smallint(6) unsigned NOT NULL DEFAULT '0',
			e12 smallint(6) unsigned NOT NULL DEFAULT '0',
			e13 smallint(6) unsigned NOT NULL DEFAULT '0',
			e14 smallint(6) unsigned NOT NULL DEFAULT '0',
			e15 smallint(6) unsigned NOT NULL DEFAULT '0',
			e16 smallint(6) unsigned NOT NULL DEFAULT '0',
			e17 smallint(6) unsigned NOT NULL DEFAULT '0',
			e18 smallint(6) unsigned NOT NULL DEFAULT '0',
			e19 smallint(6) unsigned NOT NULL DEFAULT '0',
			e20 smallint(6) unsigned NOT NULL DEFAULT '0',
			e21 smallint(6) unsigned NOT NULL DEFAULT '0',
			e22 smallint(6) unsigned NOT NULL DEFAULT '0',
			e23 smallint(6) unsigned NOT NULL DEFAULT '0',
			e24 smallint(6) unsigned NOT NULL DEFAULT '0',
			e25 smallint(6) unsigned NOT NULL DEFAULT '0',
			e26 smallint(6) unsigned NOT NULL DEFAULT '0',
			e27 smallint(6) unsigned NOT NULL DEFAULT '0',
			e28 smallint(6) unsigned NOT NULL DEFAULT '0',
			e29 smallint(6) unsigned NOT NULL DEFAULT '0',
			e30 smallint(6) unsigned NOT NULL DEFAULT '0',
			e31 smallint(6) unsigned NOT NULL DEFAULT '0',
			e32 smallint(6) unsigned NOT NULL DEFAULT '0',
			e33 smallint(6) unsigned NOT NULL DEFAULT '0',
			e34 smallint(6) unsigned NOT NULL DEFAULT '0',
			e35 smallint(6) unsigned NOT NULL DEFAULT '0',
			e36 smallint(6) unsigned NOT NULL DEFAULT '0',
			e37 smallint(6) unsigned NOT NULL DEFAULT '0',
			e38 smallint(6) unsigned NOT NULL DEFAULT '0',
			e39 smallint(6) unsigned NOT NULL DEFAULT '0',
			e40 smallint(6) unsigned NOT NULL DEFAULT '0',
			e41 smallint(6) unsigned NOT NULL DEFAULT '0',
			e42 smallint(6) unsigned NOT NULL DEFAULT '0',
			e43 smallint(6) unsigned NOT NULL DEFAULT '0',
			e44 smallint(6) unsigned NOT NULL DEFAULT '0',
			e45 smallint(6) unsigned NOT NULL DEFAULT '0',
			e46 smallint(6) unsigned NOT NULL DEFAULT '0',
			e47 smallint(6) unsigned NOT NULL DEFAULT '0',
			e48 smallint(6) unsigned NOT NULL DEFAULT '0',
			e49 smallint(6) unsigned NOT NULL DEFAULT '0',
			e50 smallint(6) unsigned NOT NULL DEFAULT '0',
			e51 smallint(6) unsigned NOT NULL DEFAULT '0',
			e52 smallint(6) unsigned NOT NULL DEFAULT '0',
			e53 smallint(6) unsigned NOT NULL DEFAULT '0',
			e54 smallint(6) unsigned NOT NULL DEFAULT '0',
			e55 smallint(6) unsigned NOT NULL DEFAULT '0',
			e56 smallint(6) unsigned NOT NULL DEFAULT '0',
			e57 smallint(6) unsigned NOT NULL DEFAULT '0',
			e58 smallint(6) unsigned NOT NULL DEFAULT '0',
			e59 smallint(6) unsigned NOT NULL DEFAULT '0',
			e60 smallint(6) unsigned NOT NULL DEFAULT '0',
			e61 smallint(6) unsigned NOT NULL DEFAULT '0',
			e62 smallint(6) unsigned NOT NULL DEFAULT '0',
			e63 smallint(6) unsigned NOT NULL DEFAULT '0',
			e64 smallint(6) unsigned NOT NULL DEFAULT '0',
			e65 smallint(6) unsigned NOT NULL DEFAULT '0',
			e66 smallint(6) unsigned NOT NULL DEFAULT '0',
			e67 smallint(6) unsigned NOT NULL DEFAULT '0',
			e68 smallint(6) unsigned NOT NULL DEFAULT '0',
			e69 smallint(6) unsigned NOT NULL DEFAULT '0',
			e70 smallint(6) unsigned NOT NULL DEFAULT '0',
			e71 smallint(6) unsigned NOT NULL DEFAULT '0',
			e72 smallint(6) unsigned NOT NULL DEFAULT '0',
			e73 smallint(6) unsigned NOT NULL DEFAULT '0',
			e74 smallint(6) unsigned NOT NULL DEFAULT '0',
			e75 smallint(6) unsigned NOT NULL DEFAULT '0',
			e76 smallint(6) unsigned NOT NULL DEFAULT '0',
			e77 smallint(6) unsigned NOT NULL DEFAULT '0',
			e78 smallint(6) unsigned NOT NULL DEFAULT '0',
			e79 smallint(6) unsigned NOT NULL DEFAULT '0',
			e80 smallint(6) unsigned NOT NULL DEFAULT '0',
			e81 smallint(6) unsigned NOT NULL DEFAULT '0',
			e82 smallint(6) unsigned NOT NULL DEFAULT '0',
			e83 smallint(6) unsigned NOT NULL DEFAULT '0',
			e84 smallint(6) unsigned NOT NULL DEFAULT '0',
			e85 smallint(6) unsigned NOT NULL DEFAULT '0',
			e86 smallint(6) unsigned NOT NULL DEFAULT '0',
			e87 smallint(6) unsigned NOT NULL DEFAULT '0',
			e88 smallint(6) unsigned NOT NULL DEFAULT '0',
			e89 smallint(6) unsigned NOT NULL DEFAULT '0',
			e90 smallint(6) unsigned NOT NULL DEFAULT '0',
			e91 smallint(6) unsigned NOT NULL DEFAULT '0',
			e92 smallint(6) unsigned NOT NULL DEFAULT '0',
			e93 smallint(6) unsigned NOT NULL DEFAULT '0',
			e94 smallint(6) unsigned NOT NULL DEFAULT '0',
			e95 smallint(6) unsigned NOT NULL DEFAULT '0',
			e96 smallint(6) unsigned NOT NULL DEFAULT '0',
			e97 smallint(6) unsigned NOT NULL DEFAULT '0',
			e98 smallint(6) unsigned NOT NULL DEFAULT '0',
			e99 smallint(6) unsigned NOT NULL DEFAULT '0',
			e100 smallint(6) unsigned NOT NULL DEFAULT '0',
			e101 smallint(6) unsigned NOT NULL DEFAULT '0',
			e102 smallint(6) unsigned NOT NULL DEFAULT '0',
			e103 smallint(6) unsigned NOT NULL DEFAULT '0',
			e104 smallint(6) unsigned NOT NULL DEFAULT '0',
			e105 smallint(6) unsigned NOT NULL DEFAULT '0',
			e106 smallint(6) unsigned NOT NULL DEFAULT '0',
			e107 smallint(6) unsigned NOT NULL DEFAULT '0',
			e108 smallint(6) unsigned NOT NULL DEFAULT '0',
			e109 smallint(6) unsigned NOT NULL DEFAULT '0',
			e110 smallint(6) unsigned NOT NULL DEFAULT '0',
			e111 smallint(6) unsigned NOT NULL DEFAULT '0',
			e112 smallint(6) unsigned NOT NULL DEFAULT '0',
			e113 smallint(6) unsigned NOT NULL DEFAULT '0',
			e114 smallint(6) unsigned NOT NULL DEFAULT '0',
			e115 smallint(6) unsigned NOT NULL DEFAULT '0',
			e116 smallint(6) unsigned NOT NULL DEFAULT '0',
			e117 smallint(6) unsigned NOT NULL DEFAULT '0',
			e118 smallint(6) unsigned NOT NULL DEFAULT '0',
			e119 smallint(6) unsigned NOT NULL DEFAULT '0',
			e120 smallint(6) unsigned NOT NULL DEFAULT '0',
			e121 smallint(6) unsigned NOT NULL DEFAULT '0',
			e122 smallint(6) unsigned NOT NULL DEFAULT '0',
			e123 smallint(6) unsigned NOT NULL DEFAULT '0',
			e124 smallint(6) unsigned NOT NULL DEFAULT '0',
			e125 smallint(6) unsigned NOT NULL DEFAULT '0',
			e126 smallint(6) unsigned NOT NULL DEFAULT '0',
			e127 smallint(6) unsigned NOT NULL DEFAULT '0',
			e128 smallint(6) unsigned NOT NULL DEFAULT '0',
			e129 smallint(6) unsigned NOT NULL DEFAULT '0',
			e130 smallint(6) unsigned NOT NULL DEFAULT '0',
			e131 smallint(6) unsigned NOT NULL DEFAULT '0',
			e132 smallint(6) unsigned NOT NULL DEFAULT '0',
			e133 smallint(6) unsigned NOT NULL DEFAULT '0',
			e134 smallint(6) unsigned NOT NULL DEFAULT '0',
			e135 smallint(6) unsigned NOT NULL DEFAULT '0',
			e136 smallint(6) unsigned NOT NULL DEFAULT '0',
			e137 smallint(6) unsigned NOT NULL DEFAULT '0',
			e138 smallint(6) unsigned NOT NULL DEFAULT '0',
			e139 smallint(6) unsigned NOT NULL DEFAULT '0',
			e140 smallint(6) unsigned NOT NULL DEFAULT '0',
			e141 smallint(6) unsigned NOT NULL DEFAULT '0',
			e142 smallint(6) unsigned NOT NULL DEFAULT '0',
			e143 smallint(6) unsigned NOT NULL DEFAULT '0',
			e144 smallint(6) unsigned NOT NULL DEFAULT '0',
			e145 smallint(6) unsigned NOT NULL DEFAULT '0',
			e146 smallint(6) unsigned NOT NULL DEFAULT '0',
			e147 smallint(6) unsigned NOT NULL DEFAULT '0',
			e148 smallint(6) unsigned NOT NULL DEFAULT '0',
			e149 smallint(6) unsigned NOT NULL DEFAULT '0',
			e150 smallint(6) unsigned NOT NULL DEFAULT '0',
			e151 smallint(6) unsigned NOT NULL DEFAULT '0',
			e152 smallint(6) unsigned NOT NULL DEFAULT '0',
			e153 smallint(6) unsigned NOT NULL DEFAULT '0',
			e154 smallint(6) unsigned NOT NULL DEFAULT '0',
			e155 smallint(6) unsigned NOT NULL DEFAULT '0',
			e156 smallint(6) unsigned NOT NULL DEFAULT '0',
			e157 smallint(6) unsigned NOT NULL DEFAULT '0',
			e158 smallint(6) unsigned NOT NULL DEFAULT '0',
			e159 smallint(6) unsigned NOT NULL DEFAULT '0',
			e160 smallint(6) unsigned NOT NULL DEFAULT '0',
			e161 smallint(6) unsigned NOT NULL DEFAULT '0',
			e162 smallint(6) unsigned NOT NULL DEFAULT '0',
			e163 smallint(6) unsigned NOT NULL DEFAULT '0',
			e164 smallint(6) unsigned NOT NULL DEFAULT '0',
			e165 smallint(6) unsigned NOT NULL DEFAULT '0',
			e166 smallint(6) unsigned NOT NULL DEFAULT '0',
			e167 smallint(6) unsigned NOT NULL DEFAULT '0',
			r0 smallint(6) unsigned NOT NULL DEFAULT '0',
			r1 smallint(6) unsigned NOT NULL DEFAULT '0',
			r2 smallint(6) unsigned NOT NULL DEFAULT '0',
			r3 smallint(6) unsigned NOT NULL DEFAULT '0',
			r4 smallint(6) unsigned NOT NULL DEFAULT '0',
			r5 smallint(6) unsigned NOT NULL DEFAULT '0',
			r6 smallint(6) unsigned NOT NULL DEFAULT '0',
			r7 smallint(6) unsigned NOT NULL DEFAULT '0',
			r8 smallint(6) unsigned NOT NULL DEFAULT '0',
			r9 smallint(6) unsigned NOT NULL DEFAULT '0',
			r10 smallint(6) unsigned NOT NULL DEFAULT '0',
			r11 smallint(6) unsigned NOT NULL DEFAULT '0',
			r12 smallint(6) unsigned NOT NULL DEFAULT '0',
			r13 smallint(6) unsigned NOT NULL DEFAULT '0',
			r14 smallint(6) unsigned NOT NULL DEFAULT '0',
			r15 smallint(6) unsigned NOT NULL DEFAULT '0',
			r16 smallint(6) unsigned NOT NULL DEFAULT '0',
			r17 smallint(6) unsigned NOT NULL DEFAULT '0',
			r18 smallint(6) unsigned NOT NULL DEFAULT '0',
			r19 smallint(6) unsigned NOT NULL DEFAULT '0',
			r20 smallint(6) unsigned NOT NULL DEFAULT '0',
			r21 smallint(6) unsigned NOT NULL DEFAULT '0',
			r22 smallint(6) unsigned NOT NULL DEFAULT '0',
			r23 smallint(6) unsigned NOT NULL DEFAULT '0',
			r24 smallint(6) unsigned NOT NULL DEFAULT '0',
			r25 smallint(6) unsigned NOT NULL DEFAULT '0',
			r26 smallint(6) unsigned NOT NULL DEFAULT '0',
			r27 smallint(6) unsigned NOT NULL DEFAULT '0',
			r28 smallint(6) unsigned NOT NULL DEFAULT '0',
			r29 smallint(6) unsigned NOT NULL DEFAULT '0',
			r30 smallint(6) unsigned NOT NULL DEFAULT '0',
			r31 smallint(6) unsigned NOT NULL DEFAULT '0',
			r32 smallint(6) unsigned NOT NULL DEFAULT '0',
			r33 smallint(6) unsigned NOT NULL DEFAULT '0',
			r34 smallint(6) unsigned NOT NULL DEFAULT '0',
			r35 smallint(6) unsigned NOT NULL DEFAULT '0',
			r36 smallint(6) unsigned NOT NULL DEFAULT '0',
			r37 smallint(6) unsigned NOT NULL DEFAULT '0',
			r38 smallint(6) unsigned NOT NULL DEFAULT '0',
			r39 smallint(6) unsigned NOT NULL DEFAULT '0',
			r40 smallint(6) unsigned NOT NULL DEFAULT '0',
			r41 smallint(6) unsigned NOT NULL DEFAULT '0',
			r42 smallint(6) unsigned NOT NULL DEFAULT '0',
			r43 smallint(6) unsigned NOT NULL DEFAULT '0',
			r44 smallint(6) unsigned NOT NULL DEFAULT '0',
			r45 smallint(6) unsigned NOT NULL DEFAULT '0',
			r46 smallint(6) unsigned NOT NULL DEFAULT '0',
			r47 smallint(6) unsigned NOT NULL DEFAULT '0',
			r48 smallint(6) unsigned NOT NULL DEFAULT '0',
			r49 smallint(6) unsigned NOT NULL DEFAULT '0',
			r50 smallint(6) unsigned NOT NULL DEFAULT '0',
			r51 smallint(6) unsigned NOT NULL DEFAULT '0',
			r52 smallint(6) unsigned NOT NULL DEFAULT '0',
			r53 smallint(6) unsigned NOT NULL DEFAULT '0',
			r54 smallint(6) unsigned NOT NULL DEFAULT '0',
			r55 smallint(6) unsigned NOT NULL DEFAULT '0',
			r56 smallint(6) unsigned NOT NULL DEFAULT '0',
			r57 smallint(6) unsigned NOT NULL DEFAULT '0',
			r58 smallint(6) unsigned NOT NULL DEFAULT '0',
			r59 smallint(6) unsigned NOT NULL DEFAULT '0',
			r60 smallint(6) unsigned NOT NULL DEFAULT '0',
			r61 smallint(6) unsigned NOT NULL DEFAULT '0',
			r62 smallint(6) unsigned NOT NULL DEFAULT '0',
			r63 smallint(6) unsigned NOT NULL DEFAULT '0',
			r64 smallint(6) unsigned NOT NULL DEFAULT '0',
			r65 smallint(6) unsigned NOT NULL DEFAULT '0',
			r66 smallint(6) unsigned NOT NULL DEFAULT '0',
			r67 smallint(6) unsigned NOT NULL DEFAULT '0',
			r68 smallint(6) unsigned NOT NULL DEFAULT '0',
			r69 smallint(6) unsigned NOT NULL DEFAULT '0',
			r70 smallint(6) unsigned NOT NULL DEFAULT '0',
			r71 smallint(6) unsigned NOT NULL DEFAULT '0',
			r72 smallint(6) unsigned NOT NULL DEFAULT '0',
			r73 smallint(6) unsigned NOT NULL DEFAULT '0',
			r74 smallint(6) unsigned NOT NULL DEFAULT '0',
			r75 smallint(6) unsigned NOT NULL DEFAULT '0',
			r76 smallint(6) unsigned NOT NULL DEFAULT '0',
			r77 smallint(6) unsigned NOT NULL DEFAULT '0',
			r78 smallint(6) unsigned NOT NULL DEFAULT '0',
			r79 smallint(6) unsigned NOT NULL DEFAULT '0',
			r80 smallint(6) unsigned NOT NULL DEFAULT '0',
			r81 smallint(6) unsigned NOT NULL DEFAULT '0',
			r82 smallint(6) unsigned NOT NULL DEFAULT '0',
			r83 smallint(6) unsigned NOT NULL DEFAULT '0',
			r84 smallint(6) unsigned NOT NULL DEFAULT '0',
			r85 smallint(6) unsigned NOT NULL DEFAULT '0',
			r86 smallint(6) unsigned NOT NULL DEFAULT '0',
			r87 smallint(6) unsigned NOT NULL DEFAULT '0',
			r88 smallint(6) unsigned NOT NULL DEFAULT '0',
			r89 smallint(6) unsigned NOT NULL DEFAULT '0',
			r90 smallint(6) unsigned NOT NULL DEFAULT '0',
			r91 smallint(6) unsigned NOT NULL DEFAULT '0',
			r92 smallint(6) unsigned NOT NULL DEFAULT '0',
			r93 smallint(6) unsigned NOT NULL DEFAULT '0',
			r94 smallint(6) unsigned NOT NULL DEFAULT '0',
			r95 smallint(6) unsigned NOT NULL DEFAULT '0',
			r96 smallint(6) unsigned NOT NULL DEFAULT '0',
			r97 smallint(6) unsigned NOT NULL DEFAULT '0',
			r98 smallint(6) unsigned NOT NULL DEFAULT '0',
			r99 smallint(6) unsigned NOT NULL DEFAULT '0',
			r100 smallint(6) unsigned NOT NULL DEFAULT '0',
			r101 smallint(6) unsigned NOT NULL DEFAULT '0',
			r102 smallint(6) unsigned NOT NULL DEFAULT '0',
			r103 smallint(6) unsigned NOT NULL DEFAULT '0',
			r104 smallint(6) unsigned NOT NULL DEFAULT '0',
			r105 smallint(6) unsigned NOT NULL DEFAULT '0',
			r106 smallint(6) unsigned NOT NULL DEFAULT '0',
			r107 smallint(6) unsigned NOT NULL DEFAULT '0',
			r108 smallint(6) unsigned NOT NULL DEFAULT '0',
			r109 smallint(6) unsigned NOT NULL DEFAULT '0',
			r110 smallint(6) unsigned NOT NULL DEFAULT '0',
			r111 smallint(6) unsigned NOT NULL DEFAULT '0',
			r112 smallint(6) unsigned NOT NULL DEFAULT '0',
			r113 smallint(6) unsigned NOT NULL DEFAULT '0',
			r114 smallint(6) unsigned NOT NULL DEFAULT '0',
			r115 smallint(6) unsigned NOT NULL DEFAULT '0',
			r116 smallint(6) unsigned NOT NULL DEFAULT '0',
			r117 smallint(6) unsigned NOT NULL DEFAULT '0',
			r118 smallint(6) unsigned NOT NULL DEFAULT '0',
			r119 smallint(6) unsigned NOT NULL DEFAULT '0',
			r120 smallint(6) unsigned NOT NULL DEFAULT '0',
			r121 smallint(6) unsigned NOT NULL DEFAULT '0',
			r122 smallint(6) unsigned NOT NULL DEFAULT '0',
			r123 smallint(6) unsigned NOT NULL DEFAULT '0',
			r124 smallint(6) unsigned NOT NULL DEFAULT '0',
			r125 smallint(6) unsigned NOT NULL DEFAULT '0',
			r126 smallint(6) unsigned NOT NULL DEFAULT '0',
			r127 smallint(6) unsigned NOT NULL DEFAULT '0',
			r128 smallint(6) unsigned NOT NULL DEFAULT '0',
			r129 smallint(6) unsigned NOT NULL DEFAULT '0',
			r130 smallint(6) unsigned NOT NULL DEFAULT '0',
			r131 smallint(6) unsigned NOT NULL DEFAULT '0',
			r132 smallint(6) unsigned NOT NULL DEFAULT '0',
			r133 smallint(6) unsigned NOT NULL DEFAULT '0',
			r134 smallint(6) unsigned NOT NULL DEFAULT '0',
			r135 smallint(6) unsigned NOT NULL DEFAULT '0',
			r136 smallint(6) unsigned NOT NULL DEFAULT '0',
			r137 smallint(6) unsigned NOT NULL DEFAULT '0',
			r138 smallint(6) unsigned NOT NULL DEFAULT '0',
			r139 smallint(6) unsigned NOT NULL DEFAULT '0',
			r140 smallint(6) unsigned NOT NULL DEFAULT '0',
			r141 smallint(6) unsigned NOT NULL DEFAULT '0',
			r142 smallint(6) unsigned NOT NULL DEFAULT '0',
			r143 smallint(6) unsigned NOT NULL DEFAULT '0',
			r144 smallint(6) unsigned NOT NULL DEFAULT '0',
			r145 smallint(6) unsigned NOT NULL DEFAULT '0',
			r146 smallint(6) unsigned NOT NULL DEFAULT '0',
			r147 smallint(6) unsigned NOT NULL DEFAULT '0',
			r148 smallint(6) unsigned NOT NULL DEFAULT '0',
			r149 smallint(6) unsigned NOT NULL DEFAULT '0',
			r150 smallint(6) unsigned NOT NULL DEFAULT '0',
			r151 smallint(6) unsigned NOT NULL DEFAULT '0',
			r152 smallint(6) unsigned NOT NULL DEFAULT '0',
			r153 smallint(6) unsigned NOT NULL DEFAULT '0',
			r154 smallint(6) unsigned NOT NULL DEFAULT '0',
			r155 smallint(6) unsigned NOT NULL DEFAULT '0',
			r156 smallint(6) unsigned NOT NULL DEFAULT '0',
			r157 smallint(6) unsigned NOT NULL DEFAULT '0',
			r158 smallint(6) unsigned NOT NULL DEFAULT '0',
			r159 smallint(6) unsigned NOT NULL DEFAULT '0',
			r160 smallint(6) unsigned NOT NULL DEFAULT '0',
			r161 smallint(6) unsigned NOT NULL DEFAULT '0',
			r162 smallint(6) unsigned NOT NULL DEFAULT '0',
			r163 smallint(6) unsigned NOT NULL DEFAULT '0',
			r164 smallint(6) unsigned NOT NULL DEFAULT '0',
			r165 smallint(6) unsigned NOT NULL DEFAULT '0',
			r166 smallint(6) unsigned NOT NULL DEFAULT '0',
			r167 smallint(6) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (sid),
			UNIQUE KEY idx_user_id(user_id)			
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS yii_sellercats;
		CREATE TABLE yii_sellercats (
			sid bigint(20) unsigned NOT NULL DEFAULT '0',
			cid int(10) unsigned NOT NULL default 0,  			
			name varchar(128) NOT NULL DEFAULT '',			
			parent_cid int(10) unsigned NOT NULL default 0,  						
			KEY idx_sid_cid (sid, cid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS tool_log;
		CREATE TABLE tool_log (
			sid bigint(20) unsigned NOT NULL DEFAULT '0', 
			date int(10) unsigned NOT NULL DEFAULT '0',
			op tinyint(3) unsigned NOT NULL DEFAULT '0',
			v1 varchar(24) NOT NULL DEFAULT '',
			v2 varchar(24) NOT NULL DEFAULT '',
			code smallint(6) unsigned NOT NULL DEFAULT '0',
			msg varchar(128) NOT NULL DEFAULT '',
			KEY idx_sid_date (sid, date)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS tool_setting;
		CREATE TABLE tool_setting (
			json varchar(4096) NOT NULL DEFAULT ''
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;		

		DROP TABLE IF EXISTS tool_adjust_time;
		CREATE TABLE tool_adjust_time (
			sid bigint(20) unsigned NOT NULL DEFAULT '0', 
			num_iid bigint(20) unsigned NOT NULL DEFAULT '0',
			adjust_time int(10) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (num_iid),
			KEY idx_sid (sid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

EOD;
		Yii::app()->db->createCommand($sql)->execute();		
		echo " done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";		
	}

/*
	static public function import_all_itemcat($appkey) 
	{ 
		$sql=<<<EOD
		DROP TABLE IF EXISTS yii_itemcat;
		CREATE TABLE  IF NOT EXISTS  yii_itemcat (
			cid int(10) unsigned NOT NULL DEFAULT '0',	
			name varchar(64) NOT NULL DEFAULT '',									
			parent_cid int(10) unsigned NOT NULL DEFAULT '0',	
			is_parent tinyint(3) unsigned NOT NULL DEFAULT '0',	
			status tinyint(3) unsigned NOT NULL DEFAULT '0',
			PRIMARY KEY (cid),
			KEY idx_parent_cid (parent_cid)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

EOD;
		Yii::app()->db->createCommand($sql)->execute();		
	
		$c = new TopClient;
		$c->format = 'json';					
		$c->appkey = $appkey;
		$c->secretKey = get_app_secret($c->appkey);		
		$req = new ItemcatsGetRequest;
		$req->setFields("cid,parent_cid,name,is_parent,status");
		// $req->setParentCid(0); 
		// set datetime so we can get all itemcats at one time
		//$req->setDatetime('1970-01-01 00:00:00'); 		
		// $req->setCids("18957,19562,"); 
		$req->putOtherTextParam('datetime', '1970-01-01 00:00:00');
		$resp = $c->execute($req); 
		//Util::write_log(print_r($resp,true)); 
		if (isset($resp->{'code'}))	
		{ 
			Util::write_log(print_r($resp,true));
			return;
		}
		if (empty($resp->{'item_cats'}->{'item_cat'})) {
			Util::write_log(print_r($resp,true));
			return;
		}
		$items = $resp->{'item_cats'}->{'item_cat'};
		//Yii::app()->db->createCommand()->truncateTable('yii_itemcat');
		$dbh = Yii::app()->db->pdoInstance;
		$stmt = $dbh->prepare("REPLACE INTO yii_itemcat (cid,name,parent_cid,is_parent,status) VALUES (:cid,:name,:parent_cid,:is_parent,:status)"); 
		foreach ($items as $item) 
		{ 
			$cid = $item->{'cid'};
			$parent_cid = $item->{'parent_cid'};
			if (empty($item->{'name'})) 
				continue; 
			$name = $item->{'name'};
			$is_parent = ($item->{'is_parent'} == '1' ? 1 : 0);
			$status = ($item->{'status'} == 'normal' ? 0 : 1);
			$stmt->execute( array(':cid' => $cid, ':name' => $name,':parent_cid' => $parent_cid,':is_parent' => $is_parent,':status' => $status));
		} 
	}
*/
	static public function actionImportAreaCode() 
	{ 
		$sql=<<<EOD
		DROP TABLE IF EXISTS area_code;
		CREATE TABLE area_code (
			id int(10) unsigned NOT NULL DEFAULT '0', 		
			type int(10) unsigned NOT NULL DEFAULT '0',
			name varchar(64) NOT NULL DEFAULT '',		
			parent_id int(10) unsigned NOT NULL DEFAULT '0', 	
			zip varchar(16) NOT NULL DEFAULT '',					
			PRIMARY KEY (id)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;

EOD;
		Yii::app()->db->createCommand($sql)->execute();		

		$c = new TopClient;
		$c->format = 'json';					
		$c->appkey = APP_KEY_CART;
		$c->secretKey = get_app_secret($c->appkey);		
		$req = new AreasGetRequest;
		$req->setFields("id,type,name,parent_id,zip");
		$resp = $c->execute($req);
		if (empty($resp->{'areas'}->{'area'})) {
			Util::write_log(print_r($resp,true));
			return;
		}
		$items = $resp->{'areas'}->{'area'};
		
		Yii::app()->db->createCommand()->truncateTable('area_code');
		$dbh = Yii::app()->db->pdoInstance;
		$stmt = $dbh->prepare("REPLACE INTO area_code (id,type,name,parent_id,zip) VALUES (:id,:type,:name,:parent_id,:zip)"); 
		foreach ($items as $item) 
		{ 
			$zip = empty($item->zip) ? '' : $item->zip;
			$stmt->execute( array(':id' => $item->id, ':type' => $item->type,':name' => $item->name,':parent_id' => $item->parent_id,':zip' => $zip));
		} 
	}
	
/*
	$PHPMAILER_LANG = array(
		'provide_address' => 'You must provide at least one recipient email address.',
		'mailer_not_supported' => ' mailer is not supported.',
		'execute' => 'Could not execute: ',
		'instantiate' => 'Could not instantiate mail function.',
		'authenticate' => 'SMTP Error: Could not authenticate.',
		'from_failed' => 'The following From address failed: ',
		'recipients_failed' => 'SMTP Error: The following recipients failed: ',
		'data_not_accepted' => 'SMTP Error: Data not accepted.',
		'connect_host' => 'SMTP Error: Could not connect to SMTP host.',
		'file_access' => 'Could not access file: ',
		'file_open' => 'File Error: Could not open file: ',
		'encoding' => 'Unknown encoding: ',
		'signing' => 'Signing Error: ',
		'smtp_error' => 'SMTP server error: ',
		'empty_message' => 'Message body empty',
		'invalid_address' => 'Invalid address',
		'variable_set' => 'Cannot set or reset variable: '
	);
*/
	public $qq_frequency_limited = 0;

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb sendduoduomail
	public function actionSendDuoduoMail() 
	{
		set_time_limit(0);
		require_once(Yii::app()->getBasePath().'/extensions/mailer/phpmailer/class.phpmailer.php');

		$db = Yii::app()->db;
		Yii::app()->db->createCommand()->update(self::SMTP_ACC_TABLE, array('cnt'=>0,'code'=>0, 'msg'=>''));
		$filename_last_id =  Yii::app()->getRuntimePath()."/smtp_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;
		self::log_smtp("begin last_id=$last_id");	
		mb_internal_encoding("UTF-8");		
		$smtp_story = file_get_contents(Yii::app()->getRuntimePath()."/smtp_story.txt");
		$smtp_story_len = mb_strlen($smtp_story);
		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id > '$last_id' LIMIT 40000";	
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '16' LIMIT 1";		// taomap@sina.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '1' LIMIT 1";		// hehbhehb@sina.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '2' LIMIT 1";		// 57620133@qq.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '12' LIMIT 1";		// desk_000001@126.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '7' LIMIT 1";		// moon_000001@163.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '3' LIMIT 1";		// zengkai001@qq.com
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '13' LIMIT 1";		// hhb@whu.edu.cn
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '14' LIMIT 1";		// hehbhehb@sohu.com	
//		$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id = '15' LIMIT 1";		// hehbhehb@yeah.net
		
		$dataReader = $db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");
		
			if (strpos($user['buyer_email'], '@') !== false)
				$receiver_email = $user['buyer_email'];
			else if (strpos($user['buyer_alipay_no'], '@') !== false)
				$receiver_email = $user['buyer_alipay_no'];
			else {
				self::log_smtp("{$user['buyer_nick']} has no valid email...");						
				continue;
			}
						
			$user['receiver_email'] = $receiver_email;
			$user['smtp_story_rand'] = mb_strimwidth($smtp_story, rand(0, $smtp_story_len-256), 256);
			$user['price_save'] = sprintf("%.2f", $user['price']*rand(3, 15)/100);	
			
			$email_cat = self::get_email_cat($user['receiver_email']);
			
			try {		
				$mailer = new PHPMailer(true);		
				$mailer->IsHTML(true);
				$mailer->IsSMTP();	
				//$mailer->XMailer = 'Foxmail 7.0.1.91[cn]';									
				//$mailer->SMTPDebug = 1;		// 0: no, 1:err,  2:err+msg(verbal)
				$mailer->SMTPDebug = 2;		
				//$mailer->Debugoutput = 'error_log';
				$mailer->SMTPAuth = true;
				$mailer->CharSet = 'utf-8';
			
				$mailer->ClearAddresses();			
				$acc_row = $this->get_stmp_acc_row($email_cat);
				//$subject = Util::renderInternal(Yii::app()->basePath.'/views/email/v_title_1.php',array('user'  => $user),true);
				$subject = Util::renderInternal(Yii::app()->basePath.'/views/email/v_title_2.php',array('user'  => $user),true);												
				
				if ($email_cat == self::EMAIL_CAT_163 || $email_cat == self::EMAIL_CAT_126) {
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_118jifen_plain.html',array('user'  => $user,'acc_row'  => $acc_row,),true);								
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_just_text.html',array('user'  => $user,'acc_row'  => $acc_row,),true);								
					$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_red.html',array('user'  => $user,'acc_row'  => $acc_row,),true);													
				} else {				
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_53bs.html',array('user'  => $user,'acc_row'  => $acc_row,),true);
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_51bi.html',array('user'  => $user,'acc_row'  => $acc_row,),true);				
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_118jifen.html',array('user'  => $user,'acc_row'  => $acc_row,),true);				
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_118jifen_sina.html',array('user'  => $user,'acc_row'  => $acc_row,),true);									
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_118jifen_google.html',array('user'  => $user,'acc_row'  => $acc_row,),true);														
					//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_just_text.html',array('user'  => $user,'acc_row'  => $acc_row,),true);
					$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_red.html',array('user'  => $user,'acc_row'  => $acc_row,),true);																		
				}
				
				//$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_118jifen_sina.html',array('user'  => $user,'acc_row'  => $acc_row,),true);				
				//$body = "email body is text <a href='http://53bs.com'>53bs</a>";				
				$mailer->Host = self::get_smtp_host($acc_row['email_full']);
				$mailer->Port = '25';			
				if (strpos($acc_row['email_full'],'yahoo.cn') !== false)				
					$mailer->Username = $acc_row['email_full'];					
				else
					$mailer->Username = $acc_row['username'];
				$mailer->Password = $acc_row['password'];			

				$mailer->AddAddress($receiver_email, $user['receiver_name']);
				$mailer->SetFrom($acc_row['email_full'], $user['receiver_name']);
				$mailer->Sender = '';
				//$mailer->Sender = $acc_row['email_full'];
				//$mailer->AddReplyTo('admin@parsecode.com', 'parsecode');
				//$mailer->AddBCC("hhb@whu.edu.cn");
				$mailer->Subject = $subject;
				$mailer->Body = $body;
				$mailer->Send();
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full' , 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt'=>1, 'sum'=>1), $criteria)->execute();				
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_ok");								
				$mailer = null;				
				sleep(15);
				//sleep(10);
				$idx++;
				if ($idx % 5 == 0) {
					//self::log_smtp("$idx, wait 60 sec per 5 email");	
					//sleep(30);					
				}
			} catch (phpmailerException $e) {
				echo $e->getMessage();			
				Util::log("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage(), Yii::app()->getRuntimePath()."/smtp_err.log");	
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage());								
				$acc_new = array();
				
				if (strpos($e->getMessage(),'not authenticate') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, password is bad,".$mailer->ErrorInfo);	
					$acc_new['code'] = 99;
				}
				else if (strpos($e->getMessage(),'From address failed') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, it is rejected,".$mailer->ErrorInfo);	
					$acc_new['code'] = 98;
				}
				else if (stripos($mailer->ErrorInfo,'Connection frequency limited') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']},".$mailer->ErrorInfo);	
					$this->qq_frequency_limited = 1;
				}				
				//$acc_new['msg'] = $e->getMessage();
				$acc_new['msg'] = $mailer->ErrorInfo;
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full', 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));				
				Yii::app()->db->getCommandBuilder()->createUpdateCommand(self::SMTP_ACC_TABLE, $acc_new, $criteria)->execute();
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt_err'=>1), $criteria)->execute();
				continue;
				
			} catch (Exception $e) {
				echo $e->getMessage();
				self::log_smtp($e->getCode().":".$e->getMessage());
				self::log_smtp("Stop abnormally!");
				break;
			}
		}	
		self::log_smtp("All done today");		
		return;		
	}

	public function actionSendDuoduoTest() 
	{
		set_time_limit(0);
		require_once(Yii::app()->getBasePath().'/extensions/mailer/phpmailer/class.phpmailer.php');

		$acc_rows = array(
			array('username'=>'romeo2004', 'password'=>'hehbhehb429730', 'email_full'=>'romeo2004@sina.com',),
//			array('username'=>'moon_000001', 'password'=>'a12345678', 'email_full'=>'moon_000001@163.com',),	
//			array('username'=>'982490363', 'password'=>'hehbhehb429730', 'email_full'=>'982490363@qq.com',),											
		);
		$users = array(
			array('id'=>1, 'buyer_email'=>'taomap@sina.com', 'buyer_nick'=>'taomap', 'receiver_name'=>'taomap_name', 'price'=>100, 'title'=>''),
			array('id'=>2, 'buyer_email'=>'hehbhehb@163.com', 'buyer_nick'=>'hehbhehb163', 'receiver_name'=>'hehbhehb163_name', 'price'=>100, 'title'=>''),			
			array('id'=>3, 'buyer_email'=>'hehbhehb@126.com', 'buyer_nick'=>'hehbhehb126', 'receiver_name'=>'hehbhehb126_name', 'price'=>100, 'title'=>''),			
			array('id'=>4, 'buyer_email'=>'hehbhehb@yeah.net', 'buyer_nick'=>'hehbhehbyeah', 'receiver_name'=>'hehbhehbyeah_name', 'price'=>100, 'title'=>''),						
			array('id'=>5, 'buyer_email'=>'57620133@qq.com', 'buyer_nick'=>'q57620133', 'receiver_name'=>'57620133_name', 'price'=>100, 'title'=>''),									
			array('id'=>6, 'buyer_email'=>'hhb@whu.edu.cn', 'buyer_nick'=>'hhb', 'receiver_name'=>'hhb_name', 'price'=>100, 'title'=>''),												
			array('id'=>7, 'buyer_email'=>'hehbhehb@sohu.com', 'buyer_nick'=>'hehbhehbsohu', 'receiver_name'=>'hehbhehbsohu_name', 'price'=>100, 'title'=>''),															
		);
		
		mb_internal_encoding("UTF-8");		
		$smtp_story = file_get_contents(Yii::app()->getRuntimePath()."/smtp_story.txt");
		$smtp_story_len = mb_strlen($smtp_story);

		$idx = 0;
		foreach ($acc_rows as $acc_row)			
		{
			self::log_smtp($acc_row);				
			foreach ($users as $user) 
			{	
				$receiver_email = $user['buyer_email'];			
				$user['receiver_email'] = $receiver_email;			
				$user['smtp_story_rand'] = mb_strimwidth($smtp_story, rand(0, $smtp_story_len-256), 256);
				$user['price_save'] = sprintf("%.2f", $user['price']*rand(3, 15)/100);	
				
				try {		
					$mailer = new PHPMailer(true);		
					$mailer->IsHTML(true);
					$mailer->IsSMTP();
					$mailer->XMailer = 'Foxmail 7.0.1.91[cn]';					
					//$mailer->SMTPDebug = 1;		// 0: no, 1:err,  2:err+msg(verbal)
					$mailer->SMTPDebug = 2;		
					//$mailer->Debugoutput = 'error_log';
					$mailer->SMTPAuth = true;
					$mailer->CharSet = 'utf-8';
				
					$mailer->ClearAddresses();			
					$subject = Util::renderInternal(Yii::app()->basePath.'/views/email/v_title_2.php',array('user'  => $user),true);																	
					$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_red.html',array('user'  => $user,'acc_row'  => $acc_row,),true);																							
					$mailer->Host = self::get_smtp_host($acc_row['email_full']);
					$mailer->Port = '25';	
					$mailer->Username = $acc_row['username'];					
					$mailer->Password = $acc_row['password'];			
					$mailer->AddAddress($receiver_email, $user['receiver_name']);
					$mailer->SetFrom($acc_row['email_full'], $user['receiver_name']);
					$mailer->Sender = '';
					//$mailer->Sender = $acc_row['email_full'];
					//$mailer->AddReplyTo('admin@parsecode.com', 'parsecode');
					//$mailer->AddBCC("hhb@whu.edu.cn");
					$mailer->Subject = $subject;
					$mailer->Body = $body;
					$mailer->Send();
					$mailer = null;				
					sleep(1);
				} catch (phpmailerException $e) {
					echo $e->getMessage();			
					Util::log("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage(), Yii::app()->getRuntimePath()."/smtp_err.log");	
					self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage());								
					self::log_smtp("smtp acc {$acc_row['email_full']}, err ".$mailer->ErrorInfo);	
					continue;					
				} catch (Exception $e) {
					echo $e->getMessage();
					self::log_smtp($e->getCode().":".$e->getMessage());
					self::log_smtp("Stop abnormally!");
					break;
				}

			}
		}		
		
		self::log_smtp("All done today");		
		return;		
	}

	/*
	@126.com
	@163.com
	@sina.com
	@qq.com
	@yahoo.cn
	@yahoo.com.cn
	@sohu.com
	@live.cn
	@hotmail.com
	@msn.com
	@gmail.com
	@139.com
	@yeah.net
	@189.cn
	@tom.com
	@21cn.com
	*/
	const EMAIL_CAT_UNKNOWN = 0;
	const EMAIL_CAT_SINA = 1;
	const EMAIL_CAT_163 = 2;	
	const EMAIL_CAT_TOM = 3;	
	const EMAIL_CAT_SOHU = 4;	
	const EMAIL_CAT_126 = 5;		
	const EMAIL_CAT_QQ = 6;			
	const EMAIL_CAT_HOTMAIL = 7;				
	const EMAIL_CAT_YAHOO_CN = 8;			
	const EMAIL_CAT_GMAIL = 9;			
	const EMAIL_CAT_MSN = 10;			
	const EMAIL_CAT_139 = 11;			
	const EMAIL_CAT_YEAH = 12;				
	const EMAIL_CAT_EDU = 99;					
	static public function get_email_cat($email_full)	
	{		
		//return self::EMAIL_CAT_EDU; 	// temp, just use edu now	
		if (strpos($email_full,'sina.com') !== false)				
			return self::EMAIL_CAT_SINA;
		else if (strpos($email_full,'163.com') !== false)
			return self::EMAIL_CAT_163;
		else if (strpos($email_full,'126.com') !== false)
			return self::EMAIL_CAT_126;	
		else if (strpos($email_full,'yeah.net') !== false)
			return self::EMAIL_CAT_YEAH;		
		else if (strpos($email_full,'sohu.com') !== false)
			return self::EMAIL_CAT_SOHU;					
/*			
		else if (strpos($email_full,'tom.com') !== false)
			return self::EMAIL_CAT_TOM;
		else if (strpos($email_full,'qq.com') !== false)
			return self::EMAIL_CAT_QQ;
*/			
		else
			return self::EMAIL_CAT_UNKNOWN;
	}	

	static public function get_smtp_host($email_full)	
	{
		list($username, $host) = explode("@", $email_full);	
		if (strpos($email_full,'yahoo.cn') !== false)				
			return 'smtp.mail.yahoo.com';
		else if (strpos($email_full,'xiyou.edu.cn') !== false)				
			return 'webmail.xupt.edu.cn';			
		else
			return 'smtp.'.$host;	
	}	

	public function get_stmp_acc_row($email_cat)	
	{
		static $idx = 0;
		if ($this->qq_frequency_limited && $email_cat == self::EMAIL_CAT_QQ) {
			self::log_smtp("qq limit $idx ...............");			
			$email_cat = self::EMAIL_CAT_UNKNOWN;
			$idx++;
			if ($idx > 60) 
			{
				$idx = 0;
				$this->qq_frequency_limited = 0;
				self::log_smtp("free qq limit ...............");							
			}
		}
		
		if ($email_cat == self::EMAIL_CAT_UNKNOWN) {
			$acc_row = Yii::app()->db->createCommand("SELECT * FROM ".self::SMTP_ACC_TABLE." WHERE code='0' ORDER BY cnt ASC LIMIT 1")->queryRow();
			if ($acc_row === false || $acc_row['cnt'] >= self::EMAIL_CNT_LIMIT_PER_DAY_PER_ACC) {
				if ($acc_row === false)
					self::log_smtp("Done today, no smtp acc with code=0");	
				else
					self::log_smtp("Done today, all smtp acc cnt is full".print_r($acc_row, true));	
				throw new CException('Done today, all smtp acc cnt is full...', 500);
			}				
		} 
		else if ($email_cat == self::EMAIL_CAT_EDU) {
			$acc_row = Yii::app()->db->createCommand("SELECT * FROM ".self::SMTP_ACC_TABLE." WHERE email_cat=:email_cat AND code='0' ORDER BY cnt ASC LIMIT 1")->queryRow(true, array(':email_cat'=>$email_cat));		
			if ($acc_row === false) {
				self::log_smtp("email_cat=$email_cat, no edu smtp acc with code=0");	
				return $this->get_stmp_acc_row(self::EMAIL_CAT_UNKNOWN);
			}
		}				
		else {
			$acc_row = Yii::app()->db->createCommand("SELECT * FROM ".self::SMTP_ACC_TABLE." WHERE email_cat=:email_cat AND code='0' ORDER BY cnt ASC LIMIT 1")->queryRow(true, array(':email_cat'=>$email_cat));		
			if ($acc_row === false || $acc_row['cnt'] >= self::EMAIL_CNT_LIMIT_PER_DAY_PER_ACC) {
				if ($acc_row === false)
					self::log_smtp("email_cat=$email_cat, no smtp acc with code=0");	
				else			
					self::log_smtp("email_cat=$email_cat is full, try other email acc ");
				return $this->get_stmp_acc_row(self::EMAIL_CAT_UNKNOWN);
			}
		}		

//		$acc_row = array('username'=>'moon_000001', 'password'=>'12345678', 'email_full'=>'moon_000001@sina.com',);
//		$acc_row = array('username'=>'a14995261858_001', 'password'=>'b12345678', 'email_full'=>'a14995261858_001@163.com',);		
//		$acc_row = array('username'=>'x17150932527_001', 'password'=>'a12345678', 'email_full'=>'x17150932527_001@163.com',);		
//		$acc_row = array('username'=>'moon_000001', 'password'=>'a12345678', 'email_full'=>'moon_000001@163.com',);		
//		$acc_row = array('username'=>'moon_000002', 'password'=>'a12345678', 'email_full'=>'moon_000002@163.com',);				
//		$acc_row = array('username'=>'yngl', 'password'=>'password#1', 'email_full'=>'yngl@xiyou.edu.cn',);				
//		$acc_row = array('username'=>'nasha96779', 'password'=>'chenzhuan5238', 'email_full'=>'nasha96779@163.com',);				
//		$acc_row = array('username'=>'53bs', 'password'=>'hehbhehb429730', 'email_full'=>'53bs@sina.com',);				
//		$acc_row = array('username'=>'hehbhehb', 'password'=>'hehbhehb429730', 'email_full'=>'hehbhehb@163.com',);						
//		$acc_row = array('username'=>'982490363', 'password'=>'hehbhehb429730', 'email_full'=>'982490363@qq.com',);								
//		$acc_row = array('username'=>'romeo2004', 'password'=>'hehbhehb429730', 'email_full'=>'romeo2004@sina.com',);

		self::log_smtp($acc_row);		
		return($acc_row);	
	}
	
	static public function log_smtp($msg)
	{
		Util::log($msg, Yii::app()->getRuntimePath()."/sm_smtp.log");
	}
		
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=email-2013-7-9.txt
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=youxiangcheng.taobao.com.txt		
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ImportSmtpAcc --filename=youxiangcheng.taobao.com.1.txt				
	public function actionImportSmtpAcc($filename)	
	{
		set_time_limit(0);	
		$filename =  Yii::app()->getRuntimePath()."/{$filename}";
		$handle = @fopen($filename, "r");
		if (!$handle)
			die("fopen $filename failed");

		$rows = array();
		while (!feof($handle)) 
		{
			$data = fgets($handle);
			$data = trim($data);
			if (empty($data))
				continue;
	    		if (strlen($data) == 0)
				continue;
	    		$rows[] = $data;
		}
		shuffle($rows);		
		fclose($handle);

		foreach ($rows as $data)
		{
			//list($email_full, $password) = explode("|", $data);
			list($email_full, $password) = explode("----", $data);
			list($username, $host) = explode("@", $email_full);
			//list($username,$password,$email_full) = explode("----", $data);
			
			$email_full = trim($email_full);
			$username = trim($username);
			$password = trim($password);			
			$params = array(':email_full' => $email_full);
			$exists = Yii::app()->db->createCommand("select email_full from ".self::SMTP_ACC_TABLE." where email_full = :email_full")->queryScalar($params);                         
			if($exists) 
			{
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full', 'limit' => 1, 'params' => $params));				
				Yii::app()->db->getCommandBuilder()->createUpdateCommand(self::SMTP_ACC_TABLE, array('password'=>$password), $criteria)->execute();
				self::log_smtp("$email_full exist, just update its password");				
			} 
			else 
			{
				$row['email_full'] = $email_full;
				$row['username'] = $username;
				$row['password'] = $password;
				$row['email_cat'] = self::get_email_cat($email_full);
				//$row['seller'] = 'youxiangcheng';
				Yii::app()->db->getCommandBuilder()->createInsertCommand(self::SMTP_ACC_TABLE, $row)->execute();
			}
		}
	}

	public function actionSendCartTool() 
	{
		set_time_limit(0);
		require_once(Yii::app()->getBasePath().'/extensions/mailer/phpmailer/class.phpmailer.php');

		$db = Yii::app()->db;
		Yii::app()->db->createCommand()->update(self::SMTP_ACC_TABLE, array('cnt'=>0,'code'=>0, 'msg'=>''));
		$filename_last_id =  Yii::app()->getRuntimePath()."/smtp_cart_tool_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;
		self::log_smtp("begin last_id=$last_id");	
		mb_internal_encoding("UTF-8");		
		$smtp_story = file_get_contents(Yii::app()->getRuntimePath()."/smtp_story.txt");
		$smtp_story_len = mb_strlen($smtp_story);
		$sql = "SELECT * FROM data_sold_seller WHERE id > '$last_id' LIMIT 15000";	
//		$sql = "SELECT * FROM data_sold_seller WHERE id = '10' LIMIT 1";		// test taomap
		
		$dataReader = $db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");
		
			if (strpos($user['seller_alipay_no'], '@') !== false)
				$receiver_email = $user['seller_alipay_no'];
			else if (strpos($user['seller_email'], '@') !== false)
				$receiver_email = $user['seller_email'];
			else {
				self::log_smtp("{$user['seller_nick']} has no valid email...");						
				continue;
			}
						
			$user['receiver_email'] = $receiver_email;
			$user['smtp_story_rand'] = mb_strimwidth($smtp_story, rand(0, $smtp_story_len-512), 512);
			
			$email_cat = self::get_email_cat($user['receiver_email']);
			//$email_cat = self::EMAIL_CAT_163;
			//if ($email_cat == self::EMAIL_CAT_UNKNOWN) continue;
			
			try {		
				$mailer = new PHPMailer(true);		
				$mailer->IsHTML(true);
				$mailer->IsSMTP();
				//$mailer->SMTPDebug = 1;		// 0: no, 1:err,  2:err+msg(verbal)
				$mailer->SMTPDebug = 2;		
				//$mailer->Debugoutput = 'error_log';
				$mailer->SMTPAuth = true;
				$mailer->CharSet = 'utf-8';
			
				$mailer->ClearAddresses();			
				$acc_row = $this->get_stmp_acc_row($email_cat);
				$subject = Util::renderInternal(Yii::app()->basePath.'/views/email/v_title_cart_tool.php',array('user'  => $user),true);												
				$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_cart_tool.html',array('user'  => $user,'acc_row'  => $acc_row,),true);				
				
				$mailer->Host = self::get_smtp_host($acc_row['email_full']);
				$mailer->Port = '25';			
				if (strpos($acc_row['email_full'],'yahoo.cn') !== false)				
					$mailer->Username = $acc_row['email_full'];					
				else
					$mailer->Username = $acc_row['username'];
				$mailer->Password = $acc_row['password'];			

				$mailer->AddAddress($receiver_email, $user['seller_nick']);
				$mailer->SetFrom($acc_row['email_full'], $user['seller_nick']);
				$mailer->Sender = '';
				//$mailer->Sender = $acc_row['email_full'];
				//$mailer->AddReplyTo('admin@parsecode.com', 'parsecode');
				//$mailer->AddBCC("hhb@whu.edu.cn");
				$mailer->Subject = $subject;
				$mailer->Body = $body;
				$mailer->Send();
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full' , 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt'=>1, 'sum'=>1), $criteria)->execute();				
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, seller_name={$user['seller_name']}, seller_nick ={$user['seller_nick']}, send_ok");								
				$mailer = null;				
				sleep(15);
				//sleep(10);
				$idx++;
				if ($idx % 5 == 0) {
					self::log_smtp("$idx, wait 60 sec per 5 email");	
					//sleep(30);					
				}
			} catch (phpmailerException $e) {
				echo $e->getMessage();			
				Util::log("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, seller_name={$user['seller_name']}, seller_nick={$user['seller_nick']}, send_err, ".$e->getMessage(), Yii::app()->getRuntimePath()."/smtp_cart_tool_err.log");	
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, seller_name={$user['seller_name']}, seller_nick={$user['seller_nick']}, send_err, ".$e->getMessage());								
				$acc_new = array();
				
				if (strpos($e->getMessage(),'not authenticate') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, password is bad,".$mailer->ErrorInfo);	
					$acc_new['code'] = 99;
				}
				else if (strpos($e->getMessage(),'From address failed') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, it is rejected,".$mailer->ErrorInfo);	
					$acc_new['code'] = 98;
				}
				else if (stripos($mailer->ErrorInfo,'Connection frequency limited') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']},".$mailer->ErrorInfo);	
					$this->qq_frequency_limited = 1;
				}				
				//$acc_new['msg'] = $e->getMessage();
				$acc_new['msg'] = $mailer->ErrorInfo;
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full', 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));				
				Yii::app()->db->getCommandBuilder()->createUpdateCommand(self::SMTP_ACC_TABLE, $acc_new, $criteria)->execute();
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt_err'=>1), $criteria)->execute();
				continue;
				
			} catch (Exception $e) {
				echo $e->getMessage();
				self::log_smtp($e->getCode().":".$e->getMessage());
				self::log_smtp("Stop abnormally!");
				break;
			}
		}	
		self::log_smtp("All done today");		
		return;		
	}


	public function actionTestDomains($key)
	{
		error_reporting(E_ALL);	

		$domains = array();
		$exts = array('com','cn');
		$domains_prev = array();		
		for ($idx=0;$idx<100;$idx++)
			$domains_prev[] = "$key{$idx}";
			
		for ($idx=0;$idx<100;$idx++)
			$domains_prev[] = "{$idx}$key";
		$shengmus = array('b', 'p', 'm', 'f', 'd', 't', 'n', 'l', 'g', 'k', 'h', 'j', 'q', 'x', 'zh', 'ch', 'sh', 'r', 'z', 'c', 's', 'y', 'w');
		$yunmus = array('a', 'o', 'e', 'i', 'u', 'v', 'ai', 'ei', 'ui', 'ao', 'ou', 'iu', 'ie', 've', 'er', 'an', 'en', 'in', 'un', 'vn', 'ang', 'eng', 'ing','ong');
		foreach ($shengmus as $shengmu)			
		{
			foreach ($yunmus as $yunmu) {	
				$domains_prev[] = "{$key}{$shengmu}{$yunmu}";
			}
		}		
		
		foreach ($domains_prev as $idx => $domain_prev)			
		{
			if ($idx <=551) continue;
			error_log("$idx,$domain_prev\n", 3, Yii::app()->getRuntimePath().'/domain_idx.log');
			foreach ($exts as $ext)		
			{
				$domain = "$domain_prev.$ext";
				$respObject = $this->actionTestDomain("$domain");
				if (empty($respObject->returncode) || $respObject->returncode != 200)
				{
					L($respObject);
					return;
				}
				if (isset($respObject->original))
				{
					list($code, $msg) = explode(':', $respObject->original);
					//L("$code, $msg");
					//original=210 : Domain name is available 
					//original=211 : Domain name is not available
					//original=212 : Domain name is invalid
					if ($code == 210)
					{
						//L($respObject);
						$log_file = Yii::app()->getRuntimePath().'/domain.log';			
						$log_str = sprintf("%s\n", (string)$respObject->key);
						error_log($log_str, 3, $log_file);					
					}
				}
			}
		}
		return $respObject;	
		
	}

	public function actionTestDomain($domain)
	{
		$params = array();
		$params['area_domain'] = $domain;		

		$requestUrl = 'http://panda.www.net.cn/cgi-bin/check.cgi' . '?';
		$requestUrl .= http_build_query($params);
		$postFields = null;

		try
		{
			$resp = $this->curl($requestUrl, $postFields);
		}
		catch (Exception $e)
		{
			$result->code = $e->getCode();
			$result->msg = $e->getMessage();
			return $result;
		}
		$respWellFormed = false;
		
		$respObject = @simplexml_load_string($resp);
		if (false !== $respObject)
		{
			$respWellFormed = true;
		}

		if (false === $respWellFormed)
		{
			L($resp);
			$result->code = 0;
			$result->msg = "HTTP_RESPONSE_NOT_WELL_FORMED";
			return $result;
		}
		return $respObject;			
	}

	public function curl($url, $postFields = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if (is_array($postFields) && 0 < count($postFields))
		{
			$postBodyString = "";
			foreach ($postFields as $k => $v)
			{
				$postBodyString .= "$k=" . urlencode($v) . "&"; 
			}
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
		}
		$reponse = curl_exec($ch);		
		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch),0);
		}
		else
		{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
			{
				throw new Exception($reponse,$httpStatusCode);
			}
		}
		curl_close($ch);
		return $reponse;
	}

/*
	public function actionGetUsers()
	{
		define('MYAPP_KEY_YOUHUABAO', '12498110');	
		define('MYAPP_KEY', '12010031');
		define('MYAPP_SECRET', '96b2808ac7d797bf855fd37c891a9fc9');
		define('MYAPP_KEY_TOOLS', '12117243');	
		define('MYAPP_SECRET_TOOLS', '47f87e1cfcbd82f1255db7cfbaa98585');		
		define('MYAPP_KEY_TAOMAP', '12175882');	
		define('MYAPP_SECRET_TAOMAP', 'de940b5e9d90c43df897223403d5c87f');
		$my_app_secret = array(
			MYAPP_KEY_YOUHUABAO => 'b27cc00b17c13e9d401ae0f0abfad57c',
			MYAPP_KEY => MYAPP_SECRET,
			MYAPP_KEY_TOOLS => MYAPP_SECRET_TOOLS,
			MYAPP_KEY_TAOMAP => MYAPP_SECRET_TAOMAP,
		);	

		$filename_last_id =  Yii::app()->getRuntimePath()."/get_user_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;

		$c = new TopClient;
		$req = new UserGetRequest;
		$req->setFields("user_id,uid,nick,sex,buyer_credit,seller_credit,location,created,last_visit,birthday,type,promoted_type,status,alipay_bind,consumer_protection,avatar,liangpin,sign_food_seller_promise,has_shop,is_lightning_consignment,is_golden_seller,vip_info,email");
		//$req = new UsersGetRequest;
		//$req->setFields("user_id,uid,nick,sex,buyer_credit,seller_credit,location,created,last_visit,birthday,type,promoted_type,status,alipay_bind,consumer_protection,avatar,liangpin,has_shop,is_golden_seller,vip_info,email");		
		//$req->setNicks("hehbhehb,hezhy2005");
//		$sql = "SELECT * FROM data_sold_seller LIMIT 5";	// test 
//		$sql = "SELECT * FROM data_sold_seller WHERE id > '$last_id' LIMIT 5";			// test
		$sql = "SELECT * FROM data_sold_seller WHERE id > '$last_id'";			
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");		
			$appkey = array_rand($my_app_secret);				
			$c->appkey = $appkey;
			$c->secretKey = $my_app_secret[$c->appkey];						
			$nick = $user['seller_nick'];
			$req->setNick($nick);
			$resp = $c->execute($req);	
			//L($resp);	
			
			if (isset($resp->{'code'}))	
			{
				L($resp);	
				//if ($resp->{'msg'} == "couldn't connect to host") 
				if (stripos($resp->{'msg'}, "couldn't connect to host") !== false)
				{
					sleep(5);
					continue;
				}				
				//if ($resp->{'sub_code'} == 'isv.user-not-exist:invalid-nick') 
				if (stripos($resp->{'sub_code'}, "isv.user-not-exist:invalid-nick") !== false)
				{		
					Util::save_obj_to_file('tmal', $nick);				
					continue;
				}
				break;
			}			
			Util::save_obj_to_file('user', $resp->{'user'});				
		}			
	}	
*/

	public function actionGetUsers()
	{
		$filename_last_id =  Yii::app()->getRuntimePath()."/get_users_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;
//		$sql = "SELECT * FROM data_sold_seller LIMIT 5";	// test 
//		$sql = "SELECT * FROM data_sold_seller WHERE id > '$last_id' LIMIT 5";			// test
		$sql = "SELECT * FROM data_sold_seller WHERE id > '$last_id'";			
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");		
			$resp = Top::getUserFromTop($user['seller_nick']);
			if (isset($resp->{'code'}))	
			{
				L($resp);	
				//if ($resp->{'msg'} == "couldn't connect to host") 
				if (stripos($resp->{'msg'}, "couldn't connect to host") !== false)
				{
					sleep(5);
					continue;
				}				
				//if ($resp->{'sub_code'} == 'isv.user-not-exist:invalid-nick') 
				if (stripos($resp->{'sub_code'}, "isv.user-not-exist:invalid-nick") !== false)
				{		
					Util::save_obj_to_file('tmal', $nick);				
					continue;
				}
				break;
			}			
			Util::save_obj_to_file('user', $resp->{'user'});				
		}			
	}	

	public function actionPutUsers()
	{
		Util::handle_obj_from_file('user', array('HhbCommand', 'updateUser'));
	}

	public static function updateUser($obj) 
	{
		//L($obj);
		$seller_credit_level = empty($obj->seller_credit->level) ? 0 : $obj->seller_credit->level;
		$city = empty($obj->location->city) ? '' : $obj->location->city;
		$state = empty($obj->location->state) ? '' : $obj->location->state;
		$seller_nick = $obj->nick;
		Yii::app()->db->createCommand()->update('data_sold_seller', array('seller_credit_level'=>$seller_credit_level,'city'=>$city,'state'=>$state), 'seller_nick=:seller_nick', array(':seller_nick'=>$seller_nick));		
		return;
	}

	public static function updateUser1($obj) 
	{
		$seller_credit_level = 100;
		$seller_nick = $obj;
		Yii::app()->db->createCommand()->update('data_sold_seller', array('seller_credit_level'=>$seller_credit_level), 'seller_nick=:seller_nick', array(':seller_nick'=>$seller_nick));		
		return;
	}

	public function actionGetMobileTxt()
	{
		$sql = "SELECT * FROM data_sold_seller WHERE seller_mobile != '' ORDER BY seller_credit_level DESC";			
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		$idx = 0;
		$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'mob'.".log";		
		while(($user=$dataReader->read())!==false) 
		{ 		
			error_log("{$user['seller_mobile']},", 3, $log_file_path);
			$idx++;
			if ($idx % 1000 == 0)
			error_log("\n", 3, $log_file_path);
		}			
	}	

	/*
	ll stat_trade_2013-06-0* stat_trade_2013-06-10.log stat_trade_2013-06-11.log stat_trade_2013-06-12.log stat_trade_2013-06-13.log stat_trade_2013-06-14.log stat_trade_2013-06-15.log
	ln -s /wwwroot/htdocs/stat/logs/arc/stat_trade_2013-04-1330.log /wwwroot/htdocs/parsecode/yii/demos/map/protected/runtime/arc/stat_trade_2013-04-1330.log
	/usr/bin/php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb GetUsersByLog --log_file=stat_trade_2013-04-1330.log

	/usr/bin/php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb GetUsersByLog --log_file=trade_2013-05-20.log
	cat trade_2013-05-22.log trade_2013-05-23.log trade_2013-05-24.log trade_2013-05-25.log trade_2013-05-26.log trade_2013-05-27.log trade_2013-05-28.log trade_2013-05-29.log trade_2013-05-30.log trade_2013-05-31.log > trade_2013-05-2231.log
	cat trade_2013-05-1*.log > trade_2013-05-1019.log
	cat trade_2013-06* > trade_2013-06-0130.log
	cat trade_2013-05-07.log trade_2013-05-08.log trade_2013-05-09.log > trade_2013-05-070809.log
	/usr/bin/php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb GetUsersByLog --log_file=trade_2013-05-070809.log
	*/
	public function actionGetUsersByLog($log_file) 
	{
		set_time_limit(0);
		$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.$log_file;
		$buyer_log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer_'.$log_file;
		
		$fh = fopen($log_file_path, "r");
		$i = 0;
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;
			$trade = json_decode($line);
			$buyer_nick = $trade->{'buyer_nick'};
			$resp = Top::getUserFromTop($buyer_nick);
			if (isset($resp->{'code'}))	
			{
				Util::write_log(print_r($resp,true));				
				if (stripos($resp->{'msg'}, "connect to host") !== false)
				{
					Util::write_log("getUserFromTop(),couldn't connect to host, wait 5 sec.");				
					sleep(3);
				}				
				if (stripos($resp->{'msg'}, "connection-timeout") !== false)
				{
					Util::write_log("getUserFromTop(),isp.top-remote-connection-timeout, wait 5 sec.");				
					sleep(3);
				}								
				if (stripos($resp->{'sub_code'}, "isv.user-not-exist:invalid-nick") !== false)
				{		
					Util::save_obj_to_file('invalid_buyer_nick', $buyer_nick);				
				}
				sleep(1);
			}					
			else 
			{
				$resp = json_decode(json_encode($resp));	
				$buyer = $resp->{'user'};
				$msg = json_encode($buyer)."\n";
				error_log($msg, 3, $buyer_log_file_path);				
			}			
			$i++;				
			if ($i % 1000 == 0)
			{
				Util::write_log("$i");
			}
			
		}
		fclose($fh);						
	}

	// /usr/bin/php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb GetUsersByDir
	public function actionGetUsersByDir() 
	{
		Top::getUsersByDir();		
	}

	public function actionImportSmBlack($filename)	
	{
		set_time_limit(0);	
		$filename =  Yii::app()->getRuntimePath()."/{$filename}";
		$handle = @fopen($filename, "r");
		if (!$handle)
			die("fopen $filename failed");

		$cnt = 0;
		$n = 0;
		while (!feof($handle)) 
		{
			$data = fgets($handle);
	    		if (strlen($data) == 0) {
				continue;
	    		}
//			$n += Yii::app()->db->createCommand("INSERT IGNORE INTO crm_sm_word_blacklist (word) VALUES (:word)")->execute(array(':word'=>$data)); 	    		
			$n += Yii::app()->db->createCommand("REPLACE INTO crm_sm_word_blacklist (word) VALUES (:word)")->execute(array(':word'=>$data)); 	    		
		}
		U::W("n=$n");
		fclose($handle);
	}

	public function actionSaveTradeToMongo() 
	{
		set_time_limit(0);		
		$files=CFileHelper::findFiles(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'sold',array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		Util::write_log($files);	

		//$mongo = new MongoClient();
		$mongo=new Mongo();
		$collection = $mongo->diy->trade;

		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log('is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					continue;
					
				$obj = json_decode($line, true);				
				Util::write_log(print_r($obj,true));	
				
				try 
				{				
					$collection->insert($obj);
				}
				catch (Exception $e) 
				{
					Util::write_log($e->getCode().":".$e->getMessage());
				}				
				
				$i++;				
				if ($i % 2000 == 50) {
					Util::write_log(memory_get_usage());				
					break;		
				}
			}
			fclose($fh);	

			$idx++;
			if ($idx == 1) break;
		}

	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSm
	public function actionHandleTradeSm() 
	{
		set_time_limit(0);
		
		$command = Yii::app()->db->createCommand();		

		$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc';
//		$file_path = 'G:\buyer';				
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		Util::write_log($files);	
		
		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					continue;
					
				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	

				if (empty($obj['buyer_nick']))
					continue;
				
				$orders = $obj['orders']['order'];
				if (!isset($orders['0'])) {
					$orders = array($orders);					
				} 

				foreach ($orders as $order) 
				{ 
					try {
						$command->insert('sm_order_all', array(
							'tid'=>number_format($obj['tid'], 0, '', ''),							
						
							'buyer_nick'=>$obj['buyer_nick'],
							'buyer_alipay_no'=>empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'],
							'buyer_email'=>empty($obj['buyer_email']) ? '' : $obj['buyer_email'],
							'buyer_area'=>empty($obj['buyer_area']) ? '' : $obj['buyer_area'],

							'receiver_mobile'=>empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'],
							'receiver_name'=>empty($obj['receiver_name']) ? '' : $obj['receiver_name'],
							'receiver_phone'=>empty($obj['receiver_phone']) ? '' : $obj['receiver_phone'],
							'receiver_zip'=>empty($obj['receiver_zip']) ? '' : $obj['receiver_zip'],
							'receiver_state'=>empty($obj['receiver_state']) ? '' : $obj['receiver_state'],
							'receiver_city'=>empty($obj['receiver_city']) ? '' : $obj['receiver_city'],
							'receiver_district'=>empty($obj['receiver_district']) ? '' : $obj['receiver_district'],
							'receiver_address'=>empty($obj['receiver_address']) ? '' : $obj['receiver_address'],
							//'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
							'created'=>empty($obj['created']) ? '' : $obj['created'],

							'oid'=>number_format($order['oid'], 0, '', ''),						
							'cid'=>empty($order['cid']) ? '0' : $order['cid'], 
							'title'=>$order['title'], 
							'price'=>empty($order['price']) ? '0' : $order['price'],
							'sku_properties_name'=>empty($order['sku_properties_name']) ? '0' : $order['sku_properties_name'],							
							'seller_type'=>empty($order['seller_type']) ? '' : $order['seller_type'],								
							
							'seller_nick'=>empty($obj['seller_nick']) ? '' : $obj['seller_nick'], 
							'seller_name'=>empty($obj['seller_name']) ? '' : $obj['seller_name'], 
							'seller_mobile'=>empty($obj['seller_mobile']) ? '' : $obj['seller_mobile'], 
							'seller_email'=>empty($obj['seller_email']) ? '' : $obj['seller_email'], 
							'seller_alipay_no'=>empty($obj['seller_alipay_no']) ? '' : $obj['seller_alipay_no'], 
							'seller_phone'=>empty($obj['seller_phone']) ? '' : $obj['seller_phone'], 
							
							'x_sm_mob_cat'=> empty($obj['receiver_mobile']) ? 0 : Util::getMobCat($obj['receiver_mobile']),
							
						));					
		
					} catch (Exception $e) {
						Util::write_log($e->getCode().":".$e->getMessage());
						continue;			
					}
				} 


				$i++;				
				if ($i % 2000 == 1) {
					Util::write_log("i=$i, ".memory_get_usage());				
//					break;		
				}
			}
			fclose($fh);	

			$idx++;
			if ($idx >= 1) 
				break;
		}

		Util::write_log('actionHandleTradeSm done');	
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmAddBuyerInfo
	public function actionHandleTradeSmAddBuyerInfo() 
	{
		set_time_limit(0);
		
		$command = Yii::app()->db->createCommand();		
		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer';
		//$file_path = 'E:\buyer_tmp\buyer';
		$file_path = 'G:\buyer';		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);
		$table = 'sm_buyer_all';		
		
		Util::write_log($files);	
		$idx = 0;
		$i = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{		
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
			
			if (stripos(PHP_OS, 'win') !== false)
			{
				$filename = str_replace('\\', '/', $filename);
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
			}
			else
			{
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
			}
			
			$fh = fopen($file, "r");
			while (!feof($fh)) 
			{
				$line = fgets($fh);									
				if (empty($line))
					continue;

				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	
				// for the old json format buyer_2013-08-16.old.log begin
				//if (isset($obj['user']))
				//	$obj = $obj['user'];
				//end						
				if (empty($obj['nick']))
					continue;
				$val_arr = array(
					$obj['nick'],
					empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
					empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
					empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
					empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
					empty($obj['vip_info']) ? '' : $obj['vip_info'],	
					empty($obj['sex']) ? '' : $obj['sex'],
					empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
					empty($obj['created']) ? '' : substr($obj['created'],0,10),
					empty($obj['last_visit']) ? '' : $obj['last_visit'],	
					empty($obj['location']['state']) ? '' : $obj['location']['state'],
					empty($obj['location']['city']) ? '' : $obj['location']['city'],
					empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
					empty($obj['type']) ? '' : $obj['type'],
					empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
					empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'],
					empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
					empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
					empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
					empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
				);
				$str = implode('","', $val_arr);
				if (stripos(PHP_OS, 'win') !== false)				
					error_log("\"{$str}\"\r\n", 3, $filename);	
				else
					error_log("\"{$str}\"\n", 3, $filename);						

				$i++;				
				if ($i % 10000 == 1) {
					Util::write_log("i=$i");				
//					break;		
				}
			}
			fclose($fh);	

			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			unlink($filename);

			//rename ($file, "E:\\buyer_tmp\\buyer_bak\\".basename($file)); 
			rename ($file, "G:\\buyer_bak\\".basename($file)); 

			$idx++;
			if ($idx >= 2000)
				break;
		}

		Util::write_log('actionHandleTradeSmAddBuyerInfo done');	
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmUpdateBuyerInfo
	public function actionHandleTradeSmUpdateBuyerInfo() 
	{
		set_time_limit(0);

		$command = Yii::app()->db->createCommand();		
		$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer_need_update';
		//$file_path = 'E:\buyer_tmp\buyer';
		//$file_path = 'G:\buyer';		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);
		Util::write_log($files);	
		$table = 'sm_buyer_all';		
		$idx = 0;
		$i = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$fh = fopen($file, "r");
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					continue;
				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	
				if (empty($obj['nick']))
					continue;
				try 
				{
					$item = array(
						'nick'=>$obj['nick'],
						'buyer_credit_good_num'=>empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
						'buyer_credit_level'=>empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
						'buyer_credit_score'=>empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
						'buyer_credit_total_num'=>empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
						'vip_info'=>empty($obj['vip_info']) ? '' : $obj['vip_info'],						
						'sex'=>empty($obj['sex']) ? '' : $obj['sex'],
						'avatar'=>empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
						'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
						'last_visit'=>empty($obj['last_visit']) ? '' : $obj['last_visit'],						
						'location_state'=>empty($obj['location']['state']) ? '' : $obj['location']['state'],
						'location_city'=>empty($obj['location']['city']) ? '' : $obj['location']['city'],
						'has_shop'=>empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
						'type'=>empty($obj['type']) ? '' : $obj['type'],
						'is_golden_seller'=>empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
						'is_lightning_consignment'=>empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'], 
						'seller_credit_good_num'=>empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
						'seller_credit_level'=>empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
						'seller_credit_score'=>empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
						'seller_credit_total_num'=>empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
					);	
				
					$row = Yii::app()->db->createCommand("SELECT nick,last_visit FROM {$table} WHERE nick=:nick")->queryRow(true, array(':nick'=>$obj['nick']));		
					if ($row === false || empty($item['last_visit']))
					{
						$command->insert($table, $item);
					}
					else if ( $item['last_visit'] > $row['last_visit'])
					{
						unset($item['nick']);
						$command->update($table, $item, 'nick=:nick', array(':nick'=>$obj['nick']));
					}
					
					$i++;				
					if ($i % 10000 == 1) {
						Util::write_log("i=$i");				
//						break;		
					}

				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
					continue;			
				}

			}
			fclose($fh);	

			//rename ($file, "E:\\buyer_tmp\\buyer_bak\\".basename($file)); 
			//rename ($file, "G:\\buyer_bak\\".basename($file)); 

			$idx++;
			if ($idx >= 200)
				break;			
		}

		Util::write_log('actionHandleTradeSmUpdateBuyerInfo done');	
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb GetInvalidBuyerAgain
	public function actionGetInvalidBuyerAgain()
	{
		$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'invalid_buyer_nick.log';
		$buyer_log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'invalid_buyer_nick_result.log';		
		
		$fh = fopen($log_file_path, "r");
		$i = 0;
		static $sum = 0;
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;
				
			$buyer_nick = json_decode($line,true);

			$resp = Top::getUserFromTop($buyer_nick);
			if (isset($resp->{'code'}))	
			{
				Util::write_log(print_r($resp,true));				
				if (stripos($resp->{'msg'}, "connect to host") !== false)
				{
					Util::write_log("getUserFromTop(),couldn't connect to host, wait 5 sec.");				
					sleep(3);
				}				
				if (stripos($resp->{'msg'}, "connection-timeout") !== false)
				{
					Util::write_log("getUserFromTop(),isp.top-remote-connection-timeout, wait 5 sec.");				
					sleep(3);
				}								
				if (stripos($resp->{'sub_code'}, "isv.user-not-exist:invalid-nick") !== false)
				{		
					Util::save_obj_to_file('invalid_buyer_nick_again', $buyer_nick);				
				}
				sleep(1);
			}					
			else 
			{
				$resp = json_decode(json_encode($resp));	
				$buyer = $resp->{'user'};
				$msg = json_encode($buyer)."\n";
				error_log($msg, 3, $buyer_log_file_path);				
			}	
			
			$i++;	
			if ($i % 1000 == 1)
			{
				Util::write_log("$i");
			}
			$sum++;			
			if ($sum % 10000 == 0)
			{
				Util::write_log("sum=$sum");
			}			
		}
		fclose($fh);
		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmToJson
	public function actionHandleTradeSmToJson() 
	{
		set_time_limit(0);		
		$os_is_window = stripos(PHP_OS, 'win');
		
		$command = Yii::app()->db->createCommand();		

		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'trade_txt';
		$disk = 'G';
		$file_path = $disk.':\backup\sold_and_buyer\trade_txt';		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));		
		Util::write_log($files);	
		
		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					continue;
					
				$obj = json_decode($line);				
				//Util::write_log(print_r($obj,true));	

				if (empty($obj->buyer_nick))
					continue;
				
				$row = Yii::app()->db->createCommand("SELECT * FROM sm_buyer_all_p WHERE nick=:nick")->queryRow(true, array(':nick'=>$obj->buyer_nick));		
				if ($row !== false) 
				{
					$obj->buyer_info = $row;
				}
				else
				{
					Util::write_log("buyer_nick_not_found_in_db, {$obj->buyer_nick}");					
					error_log(json_encode($obj->buyer_nick)."\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'buyer_nick_not_found_in_db.log');									
				}

				//$file_with_buyer_info = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'trade_txt_with_buyer_info'.DIRECTORY_SEPARATOR.pathinfo($file,PATHINFO_FILENAME).'_with_buyer_info.log';
				$file_with_buyer_info = $disk.':\\backup\\sold_and_buyer\\trade_txt_with_buyer_info'.DIRECTORY_SEPARATOR.pathinfo($file,PATHINFO_FILENAME).'_with_buyer_info.log';
				$str = json_encode($obj);				
				if ($os_is_window !== false)				
					error_log("{$str}\r\n", 3, $file_with_buyer_info);	
				else
					error_log("{$str}\n", 3, $file_with_buyer_info);						

				$i++;				
				if ($i % 10000 == 1) 
				{
					Util::write_log("i=$i");
					//break;		
				}
			}
			fclose($fh);	
			rename ($file, $disk.":\\backup\\sold_and_buyer\\trade_txt_moved\\".basename($file)); 

			$idx++;
			if ($idx >= 1000) 
				break;
		}
		Util::write_log('actionHandleTradeSmToJson done');	
	}

	public function actionHandleTradeSaveToDbOld() 
	{
		exit;
		set_time_limit(0);
		$os_is_window = stripos(PHP_OS, 'win');
		$db = Yii::app()->db;		
		$disk = 'G';

		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'sold';
		$file_path = $disk.':\backup\sold_and_buyer\trade_txt_with_buyer_info';				
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		//rsort($files);
		$table = 'sm_order_all';		
		//$table = 'sm_order_all_test';				
		//$table = 'sm_order_all_test_x';				
		//Yii::app()->db->createCommand("TRUNCATE TABLE $table")->execute();			
		$my_trunk_cids = $db->createCommand('SELECT cid from sm_itemcat WHERE is_parent=1')->queryColumn();
		$my_leaf_cids = $db->createCommand('SELECT cid from sm_itemcat WHERE is_parent=0||x_parent_as_leaf=1')->queryColumn();
		$my_districts = MAreaCode::getDistricts();
		$promotion_words = Util::getPromotionWord();
		$sm_valid_cids = $sm_invalid_cids = array();		
		Util::write_log($files);	
		$idx = 0;
		$sum = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{		
			$sm_valid_words = array();
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
			
			if (stripos(PHP_OS, 'win') !== false)
			{
				$filename = str_replace('\\', '/', $filename);
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
			}
			else
			{
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
			}
			
			$fh = fopen($file, "r");
			$flag_end = false;
			while (1) 
			{
				if (feof($fh))
				{
					if (empty($last_trade))
						break;
					$obj = null;
				}
				else
				{
					$line = fgets($fh);									
					if (empty($line))
						continue;

					$obj = json_decode($line, true);				
					//Util::write_log(print_r($obj,true));	
					if (!isset($obj['orders']['order']['0']))
						$obj['orders']['order'] = array($obj['orders']['order']);
				}
				
				//merge the trades with the same buyer_nick and mobile begin
				if (empty($last_trade))
				{
					$last_trade = $obj;
					continue;
				}
				$mobile = empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'];
				$last_mobile = empty($last_trade['receiver_mobile']) ? '' : $last_trade['receiver_mobile'];					
				if (!empty($obj) && $obj['buyer_nick'] === $last_trade['buyer_nick'] && $mobile === $last_mobile)
				{
					$last_trade['orders']['order'] = array_merge($last_trade['orders']['order'], $obj['orders']['order']);
					continue;
				}
				else
				{
					$tmp = $last_trade;
					$last_trade = $obj;
					$obj = $tmp;	
				}
				//end

				$orders = $obj['orders']['order'];	

				//remove the orders with same cid begin
				if (count($orders) > 1)
				{				
					//U::W($orders);
					$tmp = array();
					foreach ($orders as $order) 
					{
						$cid = empty($order['cid']) ? 0 : $order['cid'];
						if (!isset($tmp[$cid]))	
							$tmp[$cid] = $order;
						else {
							$tmp[$cid]['title'] = $tmp[$cid]['title'].' '.$order['title'];
							$tmp[$cid]['x_merge'] = true;
						}
					}	
					$orders = array_values($tmp);
					//U::W($orders);
				}
				//end

				foreach ($orders as $order) 
				{ 			
					if (!isset($order['cid']))
					{
						U::W("no cid");
						U::W($order);
						continue;
					}
				
					$tid = number_format($obj['tid'], 0, '', '');
					$oid = number_format($order['oid'], 0, '', '');
					$x_cid_ori = $cid = $order['cid'];
					if (empty($order['order_from']))
						$order_from = '';
					else
						list($order_from) = explode(',', $order['order_from']);

					$title = Util::stripSpecialChar($order['title']);
					//$title = Util::stripSpecialChar($order['title'], $obj['seller_nick'],  $oid);
					$txt = addslashes(strip_tags(trim($title)));	
					if (empty($txt))
					{			
						$title_short = '';						
					}
					else
					{
						try
						{		
							if (0)
								$match = Util::get_cws_words($txt);		// for linux
							else
								$match = Util::get_cws_words_snoopy($txt);		// for windows

						}
						catch (Exception $e)
						{
							Util::write_log("get_cws_words_snoopy_err,".$e->getCode().$e->getMessage());
							echo "get_cws_words_snoopy,".$e->getCode().$e->getMessage();
							//if ($e->getCode()=='302' || $e->getCode()=='500')
							//	return;
							//sleep(1);								
							//continue;
							R();
						}
							
						$match = Util::EscapeSphinxQL_x($match);	
						//U::W($match);		

						$pieces = explode(' ', $match);
						$pieces = array_unique($pieces);						
						if (!empty($order['x_merge']))	
							$title = implode('', $pieces);
						$pieces = array_values($pieces);
						foreach($pieces as $i => $piece)
						{
							if (mb_strlen($piece, 'UTF-8') <= 1 || in_array($piece, $promotion_words))
								unset($pieces[$i]);
							else
							{
								$pattern = '/[A-Za-z0-9]/';
								if(!preg_match($pattern,$piece))	
									$sm_valid_words[$piece] = !isset($sm_valid_words[$piece]) ? 1 : $sm_valid_words[$piece] + 1;							
							}
						}
						$title_short = implode(' ', $pieces);	
					}
					
					$state = empty($obj['receiver_state']) ? '' : MAreaCode::stripState($obj['receiver_state']);
					$city = empty($obj['receiver_city']) ? '' : $obj['receiver_city'];
					$district = empty($obj['receiver_district']) ? '' : $obj['receiver_district'];
					if (!empty($obj['receiver_state']))
					{
						if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
						{
							$state = MAreaCode::stripStateX($state);
							if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
								error_log("$tid,$state,$city,$district \n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_area.log');															
						}
					}

					//merge email, and move the title,receiver_address,receiver_name to the last begin
					// extract the mobile from the title if the cid = chongzhi cat 
					//所属地区:手机/小灵通号码:13709002708备注:
					//end
					$val_arr = array(
						'tid'=>$tid,												
						'buyer_nick'=>$obj['buyer_nick'],
						'buyer_alipay_no'=>empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'],
						'buyer_email'=>empty($obj['buyer_email']) ? '' : $obj['buyer_email'],
						'buyer_area'=>empty($obj['buyer_area']) ? '' : $obj['buyer_area'],
						'receiver_mobile'=>empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'],
						'receiver_name'=>empty($obj['receiver_name']) ? '' : Util::stripSpecialChar($obj['receiver_name']),
						'receiver_phone'=>empty($obj['receiver_phone']) ? '' : $obj['receiver_phone'],
						'receiver_zip'=>empty($obj['receiver_zip']) ? '' : $obj['receiver_zip'],
						'receiver_state'=>$state,
						'receiver_city'=>$city,
						'receiver_district'=>$district,
						'receiver_address'=>empty($obj['receiver_address']) ? '' : Util::stripSpecialChar($obj['receiver_address']),
						'createdx'=>empty($obj['created']) ? '' : $obj['created'],

						'oid'=>$oid,						
						'cid'=>$cid, 
						'title'=>$title, 
						'title_short'=>$title_short, 						
						'sku_properties_name'=>empty($order['sku_properties_name']) ? '' : Util::stripSpecialChar($order['sku_properties_name']),													
						'price'=>empty($order['price']) ? '0' : $order['price'],
						'seller_type'=>empty($order['seller_type']) ? '' : $order['seller_type'],								
						'order_from'=>$order_from,
						
						'seller_nick'=>empty($obj['seller_nick']) ? '' : $obj['seller_nick'], 
						'seller_name'=>empty($obj['seller_name']) ? '' : $obj['seller_name'], 
						'seller_mobile'=>empty($obj['seller_mobile']) ? '' : $obj['seller_mobile'], 
						'seller_email'=>empty($obj['seller_email']) ? '' : $obj['seller_email'], 
						'seller_alipay_no'=>empty($obj['seller_alipay_no']) ? '' : $obj['seller_alipay_no'], 
						'seller_phone'=>empty($obj['seller_phone']) ? '' : $obj['seller_phone'], 
						
//						'x_cid_ori'=>$x_cid_ori, 						
						'x_sm_mob_cat'=> empty($obj['receiver_mobile']) ? -1 : Util::getMobCat($obj['receiver_mobile']),							
//						'x_sm_tot_cnt'=>0,
//						'x_sm_send_time'=>'1980-01-01',						
					);					

					if (!in_array($cid, $my_leaf_cids))
					{
						if (!in_array($cid, $my_trunk_cids))						
						{
							$sm_invalid_cids[$cid] = !isset($sm_invalid_cids[$cid]) ? 1 : $sm_invalid_cids[$cid] + 1;
							error_log("$cid,$title\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_cids_title.log');																							
						}
						else
						{
							$my_leaf_cids[] = $cid;
							$n = $db->createCommand('REPLACE INTO sm_cid_parent_as_leaf (cid) VALUES (:cid)')->execute(array(':cid'=>$cid));							
							error_log("$cid\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_cid_parent_as_leaf.log');																														
						}
					}
					else
						$sm_valid_cids[$cid] = !isset($sm_valid_cids[$cid]) ? 1 : $sm_valid_cids[$cid] + 1;					
					
					if (isset($obj['buyer_info']))
					{
						$val_arr = array_merge($val_arr, $obj['buyer_info']);
						$val_arr['x_vip_info'] = MSmOrderAll::getVipInfoNumber($obj['buyer_info']['vip_info']);						
					}
					else
					{
						Util::write_log("{$obj['buyer_nick']} has no buyer_info");		
					}

					//Util::write_log($val_arr);	
					
					$val_arr = array_values($val_arr);	
					
					$str = implode('","', $val_arr);
					if ($os_is_window !== false)				
						error_log("\"{$str}\"\r\n", 3, $filename);	
					else
						error_log("\"{$str}\"\n", 3, $filename);						

					$sum++;				
					if ($sum % 10000 == 1) 
					{
						Util::write_log("sum=$sum");				
						//break;		
					}
				}
			}
			fclose($fh);	

			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			unlink($filename);

			rename ($file, $disk.":\\backup\\sold_and_buyer\\trade_txt_with_buyer_info_moved\\".basename($file)); 

			error_log(json_encode($sm_valid_words)."\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_valid_words.log');																	
			$sm_valid_words = null;
			
			$idx++;
			if ($idx >= 1)
				break;				
		}
		
		arsort($sm_invalid_cids);
		//U::W($sm_invalid_cids);
		arsort($sm_valid_cids);
		//U::W($sm_valid_cids);
		
		error_log(json_encode($sm_invalid_cids)."\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_cids.log');																	
		error_log(json_encode($sm_valid_cids)."\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_valid_cids.log');																	
		
		Util::write_log('actionHandleTradeSaveToDb done');	
	}

	//C:\mysoft\httpcws\src>httpcws
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSaveToDb
	public function actionHandleTradeSaveToDb() 
	{	
		set_time_limit(0);
		global $err_seller_nick,$err_tid,$err_oid,$err_num_iid;

		$os_is_window = stripos(PHP_OS, 'win');
		$db = Yii::app()->db;		
		$disk = 'G';
		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'sold';
		//$file_path = $disk.':\backup\sold_and_buyer\trade_txt_with_buyer_info';	
		$file_path = $disk.':\backup\sold_and_buyer\trade_txt_with_buyer_info_obj';				
		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));

		//rsort($files);
		//$table = 'sm_order_allx';		
		//$table = 'sm_order_allx_test';		
		$table = 'sm_order_all_short_sm';		

		$my_districts = MAreaCode::getDistricts();
		$promotion_words = Util::getPromotionWord();
		$chongzhi_sub_cids = MSmItemCat::model()->getAllSubCids(MSmItemCat::CID_MOB_CHONGZHI);
		
		Util::write_log($files);	
		$idx = 0;
		$sum = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{		
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
			
			if (stripos(PHP_OS, 'win') !== false)
			{
				$filename = str_replace('\\', '/', $filename);
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
			}
			else
			{
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
			}
			
			$fh = fopen($file, "r");
			$flag_end = false;
			while (1) 
			{
				if (feof($fh))
				{
					if (empty($last_trade))
						break;
					$obj = null;
				}
				else
				{
					$line = fgets($fh);									
					if (empty($line))
						continue;

					$obj = json_decode($line, true);				
					//Util::write_log(print_r($obj,true));	
					if (!isset($obj['orders']['order']['0']))
						$obj['orders']['order'] = array($obj['orders']['order']);
				}

				//U::W($obj);
				//R();

				//merge the trades with the same buyer_nick and mobile begin
				if (empty($last_trade))
				{
					$last_trade = $obj;
					continue;
				}
				$mobile = empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'];
				$last_mobile = empty($last_trade['receiver_mobile']) ? '' : $last_trade['receiver_mobile'];					
				if (!empty($obj) && $obj['buyer_nick'] === $last_trade['buyer_nick'] && $mobile === $last_mobile)
				{
					$last_trade['orders']['order'] = array_merge($last_trade['orders']['order'], $obj['orders']['order']);
					continue;
				}
				else
				{
					$tmp = $last_trade;
					$last_trade = $obj;
					$obj = $tmp;	
				}
				//end

				// trade level varaibles begin
				$tid = number_format($obj['tid'], 0, '', '');
				$receiver_mobile = empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'];
				$x_sm_mob_cat = empty($receiver_mobile) ? -1 : Util::getMobCat($receiver_mobile);
				if (empty($obj['buyer_email']))
				{
					if ((!empty($obj['buyer_alipay_no'])) && stripos($obj['buyer_alipay_no'], '@') !== false)
						$buyer_email = $obj['buyer_alipay_no'];
					else
						$buyer_email = '';
				}
				else
					$buyer_email = $obj['buyer_email'];
					
				if (empty($obj['seller_email']))
				{
					if (!empty($obj['seller_alipay_no']) && stripos($obj['seller_alipay_no'], '@') !== false)
						$seller_email = $obj['seller_alipay_no'];
					else
						$seller_email = '';
				}
				else
					$seller_email = $obj['seller_email'];
					
				$seller_mobile = empty($obj['seller_mobile']) ? '' : $obj['seller_mobile'];				
				$state = empty($obj['receiver_state']) ? '' : MAreaCode::stripState($obj['receiver_state']);
				$city = empty($obj['receiver_city']) ? '' : $obj['receiver_city'];
				$district = empty($obj['receiver_district']) ? '' : $obj['receiver_district'];
				if (!empty($obj['receiver_state']))
				{
					if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
					{
						$state = MAreaCode::stripStateX($state);
						if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
							error_log("$tid,$state,$city,$district \n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_area.log');															
					}
				}
				//end

				$orders = $obj['orders']['order'];	
				//remove the orders with same cid begin
				if (count($orders) > 1)
				{				
					//U::W($orders);
					$tmp = array();
					foreach ($orders as $order) 
					{
						$cid = empty($order['cid']) ? 0 : $order['cid'];
						if (!isset($tmp[$cid]))	
							$tmp[$cid] = $order;
						else {
							$tmp[$cid]['title'] = $tmp[$cid]['title'].' '.$order['title'];
							$tmp[$cid]['x_merge'] = true;
						}
					}	
					$orders = array_values($tmp);
					//U::W($orders);
				}
				//end

				foreach ($orders as $order) 
				{ 			
					if (!isset($order['cid']))
					{
						//U::W(array('no cid!!!', $order));
						continue;
					}
					$cid = $order['cid'];

					//order level varaibles begin
					$oid = number_format($order['oid'], 0, '', '');
					if (empty($oid)) {
						U::W(array('no oid!!!', $order));
						R();
					}
					
					if (empty($receiver_mobile) && in_array($cid, $chongzhi_sub_cids) && !empty($obj['receiver_address']))
					{
						$pattern = '/1\d{10}/';
						if(preg_match($pattern, $obj['receiver_address'], $pieces))
						{
							$receiver_mobile = $pieces[0];
							$x_sm_mob_cat = empty($receiver_mobile) ? -1 : Util::getMobCat($receiver_mobile);							
						}
					}
					
					if (empty($order['order_from']))
						$order_from = '';
					else
						list($order_from) = explode(',', $order['order_from']);

					//$title = Util::stripSpecialChar($order['title']);
					$title = Util::stripSpecialCharForTitle($order['title'], $obj['seller_nick'],  $oid);
					$txt = addslashes(strip_tags(trim($title)));	
					if (empty($txt))
					{			
						$title_short = '';						
					}
					else
					{
						try
						{		
							$err_seller_nick = empty($obj['seller_nick']) ? '' : $obj['seller_nick'];
							$err_tid = $tid;
							$err_oid = $oid;
							$err_num_iid = $order['num_iid'];
							$match = Util::get_cws_words_snoopy($txt);		// for windows
						}
						catch (Exception $e)
						{
							Util::write_log("get_cws_words_snoopy_err,".$e->getCode().$e->getMessage());
							echo "get_cws_words_snoopy,".$e->getCode().$e->getMessage();
							//U::W(iconv("GBK","UTF-8//IGNORE", urldecode("%B2%CA%C9%AB%BB%B7%B1%A3%D6%BD%B4%FC+%BC%E2%B5%D7%CD%A8%D3%C3%B4%FC+%C0%F1%C6%B7%B4%FC+%CA%D7%CA%CE%B4%FC+12.5%2A8++100%B8%F67%D4%AA")));
							R();
						}

						$match = Util::EscapeSphinxQL_x($match);	
						//U::W($match);		

						$pieces = explode(' ', $match);
						$pieces = array_unique($pieces);						
						if (!empty($order['x_merge']))	
							$title = implode('', $pieces);
						$pieces = array_values($pieces);
						foreach($pieces as $i => $piece)
						{
							if (mb_strlen($piece, 'UTF-8') <= 1 || in_array($piece, $promotion_words))
								unset($pieces[$i]);
						}
						$title_short = implode(' ', $pieces);	
					}
					//end

					if (empty($obj['buyer_nick']))
					{
						U::W("oid=$oid,buyer_nick is empty!!!");
					}

					$val_arr = array();
					$val_arr['tid'] = $tid;
					$val_arr['oid'] = $oid;
					$val_arr['cid'] = $cid;
					$val_arr['receiver_mobile'] = $receiver_mobile;
					$val_arr['buyer_email'] = $buyer_email;
					$val_arr['buyer_alipay_no'] = empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'];
					$val_arr['buyer_nick'] = empty($obj['buyer_nick']) ? '' : $obj['buyer_nick'];
					$val_arr['createdx'] = empty($obj['created']) ? '' : $obj['created'];
					$val_arr['price'] = empty($order['price']) ? '0' : $order['price'];
					$val_arr['seller_type'] = empty($order['seller_type']) ? '' : $order['seller_type'];
					$val_arr['order_from'] = $order_from;

					$val_arr['seller_nick'] = empty($obj['seller_nick']) ? '' : $obj['seller_nick'];
					$val_arr['seller_mobile'] = $seller_mobile;
					$val_arr['seller_email'] = $seller_email;
					$val_arr['seller_alipay_no'] = empty($obj['seller_alipay_no']) ? '' : $obj['seller_alipay_no'];
					$val_arr['seller_phone'] = empty($obj['seller_phone']) ? '' : $obj['seller_phone'];
					$val_arr['seller_name'] = empty($obj['seller_name']) ? '' : $obj['seller_name'];

					if (isset($obj['buyer_info']))
					{
						$buyer_info = $obj['buyer_info'];
						$val_arr['nick'] = $buyer_info['nick'];

						if (isset($buyer_info['buyer_credit']['score']))
						{
							$val_arr['buyer_credit_good_num'] = $buyer_info['buyer_credit']['good_num'];
							$val_arr['buyer_credit_level'] = $buyer_info['buyer_credit']['level'];
							$val_arr['buyer_credit_score'] = $buyer_info['buyer_credit']['score'];
							$val_arr['buyer_credit_total_num'] = $buyer_info['buyer_credit']['total_num'];
							$val_arr['seller_credit_good_num'] = $buyer_info['seller_credit']['good_num'];
							$val_arr['seller_credit_level'] = $buyer_info['seller_credit']['level'];
							$val_arr['seller_credit_score'] = $buyer_info['seller_credit']['score'];						
							$val_arr['seller_credit_total_num'] = $buyer_info['seller_credit']['total_num'];								
						}
						else
						{
							$val_arr['buyer_credit_good_num'] = $buyer_info['buyer_credit_good_num'];
							$val_arr['buyer_credit_level'] = $buyer_info['buyer_credit_level'];
							$val_arr['buyer_credit_score'] = $buyer_info['buyer_credit_score'];
							$val_arr['buyer_credit_total_num'] = $buyer_info['buyer_credit_total_num'];
							$val_arr['seller_credit_good_num'] = $buyer_info['seller_credit_good_num'];
							$val_arr['seller_credit_level'] = $buyer_info['seller_credit_level'];
							$val_arr['seller_credit_score'] = $buyer_info['seller_credit_score'];
							$val_arr['seller_credit_total_num'] = $buyer_info['seller_credit_total_num'];
						}
						$val_arr['has_shop'] = empty($buyer_info['has_shop']) ? 0 : $buyer_info['has_shop'];
						$val_arr['type'] = empty($buyer_info['type']) ? '' : $buyer_info['type'];
						$val_arr['vip_info'] = empty($buyer_info['vip_info']) ? '' : $buyer_info['vip_info'];				
						$val_arr['sex'] = empty($buyer_info['sex']) ? '' : $buyer_info['sex'];
						$val_arr['avatar'] = (empty($buyer_info['avatar']) || stripos($buyer_info['avatar'], 'avatar-120.png') !== false) ? '' : $buyer_info['avatar'];						
						$val_arr['created'] = empty($buyer_info['created']) ? '' : $buyer_info['created'];
						$val_arr['last_visit'] = empty($buyer_info['last_visit']) ? '' : $buyer_info['last_visit'];		
						$val_arr['location_state'] = empty($buyer_info['location']['state']) ? '' : $buyer_info['location']['state'];
						$val_arr['location_city'] = empty($buyer_info['location']['city']) ? '' : $buyer_info['location']['city'];						
						$val_arr['is_golden_seller'] = empty($buyer_info['is_golden_seller']) ? '' : $buyer_info['is_golden_seller'];
						$val_arr['is_lightning_consignment'] = empty($buyer_info['is_lightning_consignment']) ? '' : $buyer_info['is_lightning_consignment'];
						$val_arr['x_vip_info'] = MSmOrderAll::getVipInfoNumber(empty($buyer_info['vip_info']) ? '' : $buyer_info['vip_info']);	
					}
					else
					{
						Util::write_log("{$obj['buyer_nick']} has no buyer_info");
						$val_arr['nick'] = '';
						$val_arr['buyer_credit_good_num'] = 0;
						$val_arr['buyer_credit_level'] = 0;
						$val_arr['buyer_credit_score'] = 0;
						$val_arr['buyer_credit_total_num'] = 0;
						$val_arr['seller_credit_good_num'] = 0;
						$val_arr['seller_credit_level'] = 0;
						$val_arr['seller_credit_score'] = 0;
						$val_arr['seller_credit_total_num'] = 0;
						$val_arr['has_shop'] = 0;
						$val_arr['type'] = '';
						$val_arr['vip_info'] = '';					
						$val_arr['sex'] = '';
						$val_arr['avatar'] = '';					
						$val_arr['created'] = '';
						$val_arr['last_visit'] = '';					
						$val_arr['location_state'] = '';
						$val_arr['location_city'] = '';					
						$val_arr['is_golden_seller'] = 0;
						$val_arr['is_lightning_consignment'] = 0;	
						$val_arr['x_vip_info'] = 0;						
					}
					
					if ($x_sm_mob_cat == 9)
					{
						error_log("$receiver_mobile, oid=$oid, cid=$cid\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'mob_cat_9.log');																																
					}

					$val_arr['x_sm_mob_cat'] = $x_sm_mob_cat;					
					$val_arr['receiver_zip'] = empty($obj['receiver_zip']) ? '' : Util::stripSpecialChar($obj['receiver_zip']);
					$val_arr['receiver_phone'] = empty($obj['receiver_phone']) ? '' : Util::stripSpecialChar($obj['receiver_phone']);					
					$val_arr['receiver_state'] = Util::stripSpecialChar($state);
					$val_arr['receiver_city'] = Util::stripSpecialChar($city);					
					$val_arr['receiver_district'] = Util::stripSpecialChar($district);
					$val_arr['receiver_name'] = empty($obj['receiver_name']) ? '' : Util::stripSpecialChar($obj['receiver_name']);					
					$val_arr['receiver_address'] = empty($obj['receiver_address']) ? '' : Util::stripSpecialChar($obj['receiver_address']);
					$val_arr['buyer_area'] = empty($obj['buyer_area']) ? '' : $obj['buyer_area'];			
					
					$val_arr['sku_properties_name'] = empty($order['sku_properties_name']) ? '' : Util::stripSpecialChar($order['sku_properties_name']);
					$val_arr['title_short'] = $title_short;					
					$val_arr['title'] = $title;
					
					//Util::write_log($val_arr);	
					
					$val_arr = array_values($val_arr);	
					
					$str = implode('","', $val_arr);
					if ($os_is_window !== false)				
						error_log("\"{$str}\"\r\n", 3, $filename);	
					else
						error_log("\"{$str}\"\n", 3, $filename);						

					$sum++;				
					if ($sum % 10000 === 1) 
					{
						Util::write_log("sum=$sum");				
						//break;
					}
				}
			}
			fclose($fh);	

			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			unlink($filename);

//			rename ($file, $disk.":\\backup\\sold_and_buyer\\trade_txt_with_buyer_info_moved\\".basename($file)); 
			rename ($file, $disk.":\\backup\\sold_and_buyer\\trade_txt_with_buyer_info_obj_moved\\".basename($file)); 

			$idx++;
			if ($idx >= 300)
				break;				
		}
		Util::write_log(__FUNCTION__.' done');			
	}

/*
	//C:\mysoft\httpcws\src>httpcws
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSaveToDbNew
	public function actionHandleTradeSaveToDbNew() 
	{	
		set_time_limit(0);
		global $err_seller_nick,$err_tid,$err_oid,$err_num_iid;

		$os_is_window = stripos(PHP_OS, 'win');
		$db = Yii::app()->db;		
		$disk = 'G';
		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'sold';
		$file_path = $disk.':\backup\sold_and_buyer\trade_txt_with_buyer_info_obj';				
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));

		//rsort($files);
		$table = 'sm_order_allx_test';		

		$my_districts = MAreaCode::getDistricts();
		$promotion_words = Util::getPromotionWord();
		$chongzhi_sub_cids = MSmItemCat::model()->getAllSubCids(MSmItemCat::CID_MOB_CHONGZHI);
		
		Util::write_log($files);	
		$idx = 0;
		$sum = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{		
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
			
			if (stripos(PHP_OS, 'win') !== false)
			{
				$filename = str_replace('\\', '/', $filename);
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
			}
			else
			{
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
			}
			
			$fh = fopen($file, "r");
			$flag_end = false;
			while (1) 
			{
				if (feof($fh))
				{
					if (empty($last_trade))
						break;
					$obj = null;
				}
				else
				{
					$line = fgets($fh);									
					if (empty($line))
						continue;

					$obj = json_decode($line, true);				
					//Util::write_log(print_r($obj,true));	
					if (!isset($obj['orders']['order']['0']))
						$obj['orders']['order'] = array($obj['orders']['order']);
				}

				//U::W($obj);
				//R();

				//merge the trades with the same buyer_nick and mobile begin
				if (empty($last_trade))
				{
					$last_trade = $obj;
					continue;
				}
				$mobile = empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'];
				$last_mobile = empty($last_trade['receiver_mobile']) ? '' : $last_trade['receiver_mobile'];					
				if (!empty($obj) && $obj['buyer_nick'] === $last_trade['buyer_nick'] && $mobile === $last_mobile)
				{
					$last_trade['orders']['order'] = array_merge($last_trade['orders']['order'], $obj['orders']['order']);
					continue;
				}
				else
				{
					$tmp = $last_trade;
					$last_trade = $obj;
					$obj = $tmp;	
				}
				//end

				// trade level varaibles begin
				$tid = number_format($obj['tid'], 0, '', '');
				$receiver_mobile = empty($obj['receiver_mobile']) ? '' : $obj['receiver_mobile'];
				$x_sm_mob_cat = empty($receiver_mobile) ? -1 : Util::getMobCat($receiver_mobile);
				if (empty($obj['buyer_email']))
				{
					if ((!empty($obj['buyer_alipay_no'])) && stripos($obj['buyer_alipay_no'], '@') !== false)
						$buyer_email = $obj['buyer_alipay_no'];
					else
						$buyer_email = '';
				}
				else
					$buyer_email = $obj['buyer_email'];
					
				if (empty($obj['seller_email']))
				{
					if (!empty($obj['seller_alipay_no']) && stripos($obj['seller_alipay_no'], '@') !== false)
						$seller_email = $obj['seller_alipay_no'];
					else
						$seller_email = '';
				}
				else
					$seller_email = $obj['seller_email'];
					
				$seller_mobile = empty($obj['seller_mobile']) ? '' : $obj['seller_mobile'];				
				$state = empty($obj['receiver_state']) ? '' : MAreaCode::stripState($obj['receiver_state']);
				$city = empty($obj['receiver_city']) ? '' : $obj['receiver_city'];
				$district = empty($obj['receiver_district']) ? '' : $obj['receiver_district'];
				if (!empty($obj['receiver_state']))
				{
					if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
					{
						$state = MAreaCode::stripStateX($state);
						if (empty($my_districts[$state][$city]) && empty($my_districts[$state][$city][$district]))
							error_log("$tid,$state,$city,$district \n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_area.log');															
					}
				}
				//end

				$orders = $obj['orders']['order'];	
				//remove the orders with same cid begin
				if (count($orders) > 1)
				{				
					//U::W($orders);
					$tmp = array();
					foreach ($orders as $order) 
					{
						$cid = empty($order['cid']) ? 0 : $order['cid'];
						if (!isset($tmp[$cid]))	
							$tmp[$cid] = $order;
						else {
							$tmp[$cid]['title'] = $tmp[$cid]['title'].' '.$order['title'];
							$tmp[$cid]['x_merge'] = true;
						}
					}	
					$orders = array_values($tmp);
					//U::W($orders);
				}
				//end

				foreach ($orders as $order) 
				{ 			
					if (!isset($order['cid']))
					{
						//U::W(array('no cid!!!', $order));
						continue;
					}
					$cid = $order['cid'];

					//order level varaibles begin
					$oid = number_format($order['oid'], 0, '', '');
					if (empty($oid)) {
						U::W(array('no oid!!!', $order));
						R();
					}
					
					if (empty($receiver_mobile) && in_array($cid, $chongzhi_sub_cids) && !empty($obj['receiver_address']))
					{
						$pattern = '/1\d{10}/';
						if(preg_match($pattern, $obj['receiver_address'], $pieces))
						{
							$receiver_mobile = $pieces[0];
							$x_sm_mob_cat = empty($receiver_mobile) ? -1 : Util::getMobCat($receiver_mobile);							
						}
					}
					
					if (empty($order['order_from']))
						$order_from = '';
					else
						list($order_from) = explode(',', $order['order_from']);

					//$title = Util::stripSpecialChar($order['title']);
					$title = Util::stripSpecialCharForTitle($order['title'], $obj['seller_nick'],  $oid);
					$txt = addslashes(strip_tags(trim($title)));	
					if (empty($txt))
					{			
						$title_short = '';						
					}
					else
					{
						try
						{		
							$err_seller_nick = empty($obj['seller_nick']) ? '' : $obj['seller_nick'];
							$err_tid = $tid;
							$err_oid = $oid;
							$err_num_iid = $order['num_iid'];
							$match = Util::get_cws_words_snoopy($txt);		// for windows
						}
						catch (Exception $e)
						{
							Util::write_log("get_cws_words_snoopy_err,".$e->getCode().$e->getMessage());
							echo "get_cws_words_snoopy,".$e->getCode().$e->getMessage();
							//U::W(iconv("GBK","UTF-8//IGNORE", urldecode("%B2%CA%C9%AB%BB%B7%B1%A3%D6%BD%B4%FC+%BC%E2%B5%D7%CD%A8%D3%C3%B4%FC+%C0%F1%C6%B7%B4%FC+%CA%D7%CA%CE%B4%FC+12.5%2A8++100%B8%F67%D4%AA")));
							R();
						}

						$match = Util::EscapeSphinxQL_x($match);	
						//U::W($match);		

						$pieces = explode(' ', $match);
						$pieces = array_unique($pieces);						
						if (!empty($order['x_merge']))	
							$title = implode('', $pieces);
						$pieces = array_values($pieces);
						foreach($pieces as $i => $piece)
						{
							if (mb_strlen($piece, 'UTF-8') <= 1 || in_array($piece, $promotion_words))
								unset($pieces[$i]);
						}
						$title_short = implode(' ', $pieces);	
					}
					//end

					if (empty($obj['buyer_nick']))
					{
						U::W("oid=$oid,buyer_nick is empty!!!");
					}

					$val_arr = array();
					$val_arr['tid'] = $tid;
					$val_arr['oid'] = $oid;
					$val_arr['cid'] = $cid;
					$val_arr['receiver_mobile'] = $receiver_mobile;
					$val_arr['buyer_email'] = $buyer_email;
					$val_arr['buyer_alipay_no'] = empty($obj['buyer_alipay_no']) ? '' : $obj['buyer_alipay_no'];
					$val_arr['buyer_nick'] = empty($obj['buyer_nick']) ? '' : $obj['buyer_nick'];
					$val_arr['createdx'] = empty($obj['created']) ? '' : $obj['created'];
					$val_arr['price'] = empty($order['price']) ? '0' : $order['price'];
					$val_arr['seller_type'] = empty($order['seller_type']) ? '' : $order['seller_type'];
					$val_arr['order_from'] = $order_from;

					$val_arr['seller_nick'] = empty($obj['seller_nick']) ? '' : $obj['seller_nick'];
					$val_arr['seller_mobile'] = $seller_mobile;
					$val_arr['seller_email'] = $seller_email;
					$val_arr['seller_alipay_no'] = empty($obj['seller_alipay_no']) ? '' : $obj['seller_alipay_no'];
					$val_arr['seller_phone'] = empty($obj['seller_phone']) ? '' : $obj['seller_phone'];
					$val_arr['seller_name'] = empty($obj['seller_name']) ? '' : $obj['seller_name'];

					if (isset($obj['buyer_info']))
					{
						$buyer_info = $obj['buyer_info'];
						$val_arr['nick'] = $buyer_info['nick'];
						
						$val_arr['buyer_credit_good_num'] = $buyer_info['buyer_credit']['good_num'];
						$val_arr['buyer_credit_level'] = $buyer_info['buyer_credit']['level'];
						$val_arr['buyer_credit_score'] = $buyer_info['buyer_credit']['score'];
						$val_arr['buyer_credit_total_num'] = $buyer_info['buyer_credit']['total_num'];
						$val_arr['seller_credit_good_num'] = $seller_info['seller_credit']['good_num'];
						$val_arr['seller_credit_level'] = $seller_info['seller_credit']['level'];
						$val_arr['seller_credit_score'] = $seller_info['seller_credit']['score'];
						$val_arr['seller_credit_total_num'] = $seller_info['seller_credit']['total_num'];		
						
						$val_arr['has_shop'] = empty($buyer_info['has_shop']) ? 0 : $buyer_info['has_shop'];
						$val_arr['type'] = empty($buyer_info['type']) ? '' : $buyer_info['type'];
						$val_arr['vip_info'] = empty($buyer_info['vip_info']) ? '' : $buyer_info['vip_info'];				
						$val_arr['sex'] = empty($buyer_info['sex']) ? '' : $buyer_info['sex'];
						$val_arr['avatar'] = (empty($buyer_info['avatar']) || stripos($buyer_info['avatar'], 'avatar-120.png') !== false) ? '' : $buyer_info['avatar'];										
						$val_arr['created'] = empty($buyer_info['created']) ? '' : $buyer_info['created'];
						$val_arr['last_visit'] = empty($buyer_info['last_visit']) ? '' : $buyer_info['last_visit'];	
						
						$val_arr['location_state'] = empty($buyer_info['location']['state']) ? '' : $buyer_info['location']['state'];
						$val_arr['location_city'] = empty($buyer_info['location']['city']) ? '' : $buyer_info['location']['city'];						
						
						$val_arr['is_golden_seller'] = empty($buyer_info['is_golden_seller']) ? '' : $buyer_info['is_golden_seller'];
						$val_arr['is_lightning_consignment'] = empty($buyer_info['is_lightning_consignment']) ? '' : $buyer_info['is_lightning_consignment'];
						$val_arr['x_vip_info'] = MSmOrderAll::getVipInfoNumber($buyer_info['vip_info']);	
					}
					else
					{
						Util::write_log("{$obj['buyer_nick']} has no buyer_info");
						$val_arr['nick'] = '';
						$val_arr['buyer_credit_good_num'] = 0;
						$val_arr['buyer_credit_level'] = 0;
						$val_arr['buyer_credit_score'] = 0;
						$val_arr['buyer_credit_total_num'] = 0;
						$val_arr['seller_credit_good_num'] = 0;
						$val_arr['seller_credit_level'] = 0;
						$val_arr['seller_credit_score'] = 0;
						$val_arr['seller_credit_total_num'] = 0;
						$val_arr['has_shop'] = 0;
						$val_arr['type'] = '';
						$val_arr['vip_info'] = '';					
						$val_arr['sex'] = '';
						$val_arr['avatar'] = '';					
						$val_arr['created'] = '';
						$val_arr['last_visit'] = '';					
						$val_arr['location_state'] = '';
						$val_arr['location_city'] = '';					
						$val_arr['is_golden_seller'] = 0;
						$val_arr['is_lightning_consignment'] = 0;	
						$val_arr['x_vip_info'] = 0;						
					}
					
					if ($x_sm_mob_cat == 9)
					{
						error_log("$receiver_mobile, oid=$oid, cid=$cid\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'mob_cat_9.log');																																
					}

					$val_arr['x_sm_mob_cat'] = $x_sm_mob_cat;					
					$val_arr['receiver_zip'] = empty($obj['receiver_zip']) ? '' : Util::stripSpecialChar($obj['receiver_zip']);
					$val_arr['receiver_phone'] = empty($obj['receiver_phone']) ? '' : Util::stripSpecialChar($obj['receiver_phone']);					
					$val_arr['receiver_state'] = Util::stripSpecialChar($state);
					$val_arr['receiver_city'] = Util::stripSpecialChar($city);					
					$val_arr['receiver_district'] = Util::stripSpecialChar($district);
					$val_arr['receiver_name'] = empty($obj['receiver_name']) ? '' : Util::stripSpecialChar($obj['receiver_name']);					
					$val_arr['receiver_address'] = empty($obj['receiver_address']) ? '' : Util::stripSpecialChar($obj['receiver_address']);
					$val_arr['buyer_area'] = empty($obj['buyer_area']) ? '' : $obj['buyer_area'];			
					
					$val_arr['sku_properties_name'] = empty($order['sku_properties_name']) ? '' : Util::stripSpecialChar($order['sku_properties_name']);
					$val_arr['title_short'] = $title_short;					
					$val_arr['title'] = $title;
					
					//Util::write_log($val_arr);	
					
					$val_arr = array_values($val_arr);	
					
					$str = implode('","', $val_arr);
					if ($os_is_window !== false)				
						error_log("\"{$str}\"\r\n", 3, $filename);	
					else
						error_log("\"{$str}\"\n", 3, $filename);						

					$sum++;				
					if ($sum % 10000 === 1) 
					{
						Util::write_log("sum=$sum");				
						//break;
					}
				}
			}
			fclose($fh);	

			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			unlink($filename);

			rename ($file, $disk.":\\backup\\sold_and_buyer\\trade_txt_with_buyer_info_obj_moved\\".basename($file)); 

			$idx++;
			if ($idx >= 1)
				break;				
		}
		Util::write_log(__FUNCTION__.' done');	
	}
*/

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb DispSmValidCidNames
	public function actionDispSmValidCidNames() 
	{
		$file = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_valid_cids.log';
		$fh = fopen($file, "r");
		$i = 0;
		$sm_valid_cids = array();
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;
				
			$arr = json_decode($line, true);	
			foreach($arr as $cid => $cnt)
				$sm_valid_cids[$cid] = !isset($sm_valid_cids[$cid]) ? $cnt : $sm_valid_cids[$cid] + $cnt;								
		}
		fclose($fh);	
		arsort($sm_valid_cids);
		$sm_valid_cids_name = array();
		foreach($sm_valid_cids as $cid => $cnt)
		{
			$model = MSmItemCat::model()->findByPk($cid);		
			$sm_valid_cids_name[$cid] = "{$cnt}, {$model->name}";
		}
		U::W($sm_valid_cids_name);		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb DispSmInvalidCids
	public function actionDispSmInvalidCids() 
	{
		$file = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_invalid_cids.log';
		$fh = fopen($file, "r");
		$i = 0;
		$sm_valid_cids = array();
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;
				
			$arr = json_decode($line, true);	
			foreach($arr as $cid => $cnt)
				$sm_valid_cids[$cid] = !isset($sm_valid_cids[$cid]) ? $cnt : $sm_valid_cids[$cid] + $cnt;								
		}
		fclose($fh);	
		arsort($sm_valid_cids);
		U::W($sm_valid_cids);		
		foreach($sm_valid_cids as $cid => $cnt)		
		{
			//$n = Yii::app()->db->createCommand()->insert('sm_itemcat', array('cid'=>$cid, 'parent_cid'=>MSmItemCat::CID_REST, 'name'=>$cid, 'is_parent'=>0));  			
		}
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb DispSmValidWords
	public function actionDispSmValidWords() 
	{
		$file = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_valid_words.log';
		$fh = fopen($file, "r");
		$i = 0;
		$sm_valid_words = array();
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;				
			$arr = json_decode($line, true);	
			foreach($arr as $word => $cnt)
				$sm_valid_words[$word] = !isset($sm_valid_words[$word]) ? $cnt : $sm_valid_words[$word] + $cnt;										
		}
		fclose($fh);	
		arsort($sm_valid_words);
		U::W($sm_valid_words);		
	}

	// 将大表按一级子目录(即parent_cid=0)分成多个子表,分不完的最后大表改名为sm_888888888
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SplitDbByCid
	public function actionSplitDbByCid() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;	
		//$prefix = 'sm';
		$prefix = 'e';
		$table = 'sm_order_all_shorter_'.$prefix;
		
		$root_cids = Yii::app()->db->createCommand("SELECT cid from {$prefix}_itemcat WHERE parent_cid=0 ORDER BY x_order_cnt DESC")->queryColumn();
 		U::W($root_cids);
		foreach($root_cids as $cid)
		{
			$sub_table_name = "{$prefix}_{$cid}";
		
			U::W($cid);		
			$sub_cids = MSmItemCat::model()->getAllSubCids($cid);
			//U::W($sub_cids);						
			if (empty($sub_cids))
				continue;
			$sub_cids_str = implode(',', $sub_cids);	
			
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS $sub_table_name")->execute();			
			
			$sql = "CREATE TABLE $sub_table_name ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM $table WHERE cid IN ($sub_cids_str)";
			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																	
			
			$sql = "DELETE FROM $table WHERE cid IN ($sub_cids_str);";
			$n = Yii::app()->db->createCommand($sql)->execute();			
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');				
		}

		Yii::app()->db->createCommand("OPTIMIZE TABLE $table")->execute();		
		U::W("OPTIMIZE TABLE $table");			

		$restTableName = "{$prefix}_".MSmItemCat::CID_REST;
		Yii::app()->db->createCommand("DROP TABLE IF EXISTS $restTableName")->execute();					
		Yii::app()->db->createCommand("ALTER TABLE $table RENAME TO $restTableName")->execute();		
		U::W("ALTER TABLE $table RENAME TO $restTableName");			

		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	/*
	将一级目录对应的表拆成n个二级类目表, 经过拆分后的一级目录做标志x_split
	像女装类目，它对应的表有1000多万条记录(充值类目有600多万)，必须再按其子类目进一步分成n个表，如连衣裙表、...
	但是像男装这样的类目，只有400多万，如果再按子目录(即2级目录，有20多个)拆，表就折得太小了，
	这时有2种拆法，一是先按20多个子目录全拆成20多个表，再组合成4个merge表,每表100多万
	另一种拆法是：不采用merge，硬拆到4个子表中,缺点是以后不好再组合
	*/
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SplitDbByTwoLevelCid
	//php /mnt/wwwroot/apps/sms/protected/yiic.php hhb SplitDbByTwoLevelCid
	public function actionSplitDbByTwoLevelCid() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;
		$prefix = 'sm';
		//$parent_cid = 50230002;		//test		
		$parent_cid = MSmItemCat::CID_NU_ZHUANG;
		//$parent_cid = MSmItemCat::CID_MOB_CHONGZHI;		
		$table = "{$prefix}_{$parent_cid}";		
		$root_cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid=$parent_cid")->queryColumn();
 		U::W($root_cids);
		foreach($root_cids as $cid)
		{
			U::W($cid);				
			$sub_table_name = "{$prefix}_{$cid}";	
			
			$sub_cids = MSmItemCat::model()->getAllSubCids($cid);
			if (empty($sub_cids))
				continue;

			$sub_cids_str = implode(',', $sub_cids);	
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS $sub_table_name")->execute();		

			$sql = "CREATE TABLE $sub_table_name ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM $table WHERE cid IN ($sub_cids_str)";
			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																	
		}
		Yii::app()->db->createCommand()->update('sm_itemcat', array('x_split'=>1), 'cid=:cid', array(':cid'=>$parent_cid));
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	// 回收二级类目表
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb UnsplitDbByTwoLevelCid --parent_cid=50230002
	public function actionUnsplitDbByTwoLevelCid($parent_cid) 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;
		$prefix = 'sm';
		//$parent_cid = 50230002;				
		$table = "{$prefix}_{$parent_cid}";		
		$root_cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid=$parent_cid")->queryColumn();
 		U::W($root_cids);
		foreach($root_cids as $cid)
		{
			U::W($cid);				
			$sub_table_name = "{$prefix}_{$cid}";	
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS $sub_table_name")->execute();		
		}
		Yii::app()->db->createCommand()->update('sm_itemcat', array('x_split'=>0), 'cid=:cid', array(':cid'=>$parent_cid));
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//像男装有460万记录，要把它分成3个新表
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SplitDbByNumber
	//php /mnt/wwwroot/apps/sms/protected/yiic.php hhb SplitDbByNumber
	public function actionSplitDbByNumber() 
	{
		exit;
		
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;
		$prefix = 'sm';
		
		//$parent_cid = MSmItemCat::CID_TEST;		//test		
		//$max_rows_number_per_table = 3;

		//$parent_cid = MSmItemCat::CID_NAN_ZHUANG;		
		//$max_rows_number_per_table = 1600000;

		//$parent_cid = MSmItemCat::CID_TONG_ZHUANG;		
		//$max_rows_number_per_table = 1400000;

		//$parent_cid = MSmItemCat::CID_3C_SHUMA;		
		//$max_rows_number_per_table = 1610000;

		//$parent_cid = MSmItemCat::CID_NU_XIE;		
		//$max_rows_number_per_table = 1600000;

		//$parent_cid = MSmItemCat::CID_NEI_YI;		
		//$max_rows_number_per_table = 1500000;

		//$parent_cid = MSmItemCat::CID_MEIRONG_HUFU_MEITI_YINGYOU;		
		//$max_rows_number_per_table = 1500000;

		$parent_cid = MSmItemCat::CID_NINGSHI_JIANGUO_TECHAN;		
		$max_rows_number_per_table = 1500000;
		
		$table = "{$prefix}_{$parent_cid}";		
		$all_count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM $table")->queryScalar();		
		$root_cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid=$parent_cid")->queryColumn();
 		U::W($root_cids);

		foreach($root_cids as $cid)
		{
			//U::W($cid);				
			$sub_cids = MSmItemCat::model()->getAllSubCids($cid);
			if (empty($sub_cids))
				continue;
			$sub_cids_str = implode(',', $sub_cids);				
			$counts[$cid] = Yii::app()->db->cache(24*3600)->createCommand("SELECT COUNT(*) FROM $table WHERE cid IN ($sub_cids_str)")->queryScalar();			
		}
		arsort($counts);
		U::W($counts);

		$sum = 0;
		$rows = array();
		$rows_tmp = array();
		foreach($counts as $cid=>$count)
		{
			$sum += $count;
			$rows_tmp[] = $cid;
			if ($sum > $max_rows_number_per_table)
			{
				$rows[] = $rows_tmp;
				$rows_tmp = array();
				$sum = 0;				
			}
		}
		if (!empty($rows_tmp))
			$rows[] = $rows_tmp;
		U::W($rows);

		$model = MSmItemCat::model()->findByPk($parent_cid);
		$model->parent_cid = 1;
		$model->is_parent = 0;		
		$model->update();
		$i=0;
		foreach($rows as $cids)
		{
			$my_parent_cid = (8*10 + $i) * 100000000 + $parent_cid;
			U::W("my_parent_cid=$my_parent_cid");					
			$ar = MSmItemCat::model()->findByPk($my_parent_cid);
			if ($ar === null)
			{
				$ar = new MSmItemCat;				
				$ar->cid = $my_parent_cid;			
			}
			$ar->parent_cid = 0;		
			$idx = $i + 1;
			$ar->name = $model->name. "-{$idx}";
			$ar->is_parent = 1;			
			$ar->save(false);
			$i++;
			MSmItemCat::model()->updateByPk($cids, array('parent_cid'=>$my_parent_cid));

			$sub_table_name = "{$prefix}_{$my_parent_cid}";		
			$sub_cids = MSmItemCat::model()->getAllSubCids($my_parent_cid);
			U::W($sub_cids);						
			if (empty($sub_cids))
				continue;
			$sub_cids_str = implode(',', $sub_cids);	
			
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS $sub_table_name")->execute();						
			$sql = "CREATE TABLE $sub_table_name ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM $table WHERE cid IN ($sub_cids_str)";
			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																	

			$count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM $sub_table_name")->queryScalar();
			if ($count != 0)
			{
				MSmItemCat::model()->updateByPk($my_parent_cid, array('x_order_cnt'=>$all_count));
				$all_count -= 1;
			}
		}

		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb UnsplitDbByNumber
	//php /mnt/wwwroot/apps/sms/protected/yiic.php hhb UnsplitDbByNumber
	public function actionUnsplitDbByNumber() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;
		$prefix = 'sm';
		$parent_cid = MSmItemCat::CID_TEST;		//test	
		//$parent_cid = MSmItemCat::CID_NAN_ZHUANG;				
		//$parent_cid = MSmItemCat::CID_TONG_ZHUANG;				
		//$parent_cid = MSmItemCat::CID_3C_SHUMA;				
		//$parent_cid = MSmItemCat::CID_NU_XIE;				
		//$parent_cid = MSmItemCat::CID_NEI_YI;				
		//$parent_cid = MSmItemCat::CID_MEIRONG_HUFU_MEITI_YINGYOU;						
		//$parent_cid = MSmItemCat::CID_NINGSHI_JIANGUO_TECHAN;						
		$table = "{$prefix}_{$parent_cid}";		

		$model = MSmItemCat::model()->findByPk($parent_cid);
		$model->parent_cid = 0;
		$model->is_parent = 1;		
		$model->update();
		for ($i=0;$i<10;$i++)		
		{
			$cid = (8*10 + $i) * 100000000 + $parent_cid;
			$ar = MSmItemCat::model()->findByPk($cid);
			if ($ar === null)
				break;
			$ar->delete();
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_{$cid}")->execute();
			$child_cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid=$cid")->queryColumn();					
			MSmItemCat::model()->updateByPk($child_cids, array('parent_cid'=>$parent_cid));			
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb MakeSmSeller
	public function actionMakeSmSeller() 
	{
		exit;
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$db = Yii::app()->db;		
		//$table = 'sm_order_all_test';	
		//$table = 'sm_order_all_unqiue_oid';	
		$table = 'sm_order_all_new';	

		Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_seller1")->execute();			
		$sql = "CREATE TABLE sm_seller1 ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT oid,seller_nick,seller_name,seller_mobile,seller_email,seller_alipay_no,seller_phone,seller_type FROM $table";
		$n = Yii::app()->db->createCommand($sql)->execute();				
		$sql = "ALTER IGNORE TABLE sm_seller1 ADD PRIMARY KEY (seller_mobile),ADD x_crm_send_sm_once_per_day tinyint(1) unsigned NOT NULL DEFAULT '0',  ";
		$n = Yii::app()->db->createCommand($sql)->execute();
		//$sql = "ALTER IGNORE TABLE sm_seller1 DROP PRIMARY KEY";
		//$n = Yii::app()->db->createCommand($sql)->execute();

		Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_seller2")->execute();			
		$sql = "CREATE TABLE sm_seller2 ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT buyer_nick,buyer_alipay_no,buyer_email,receiver_mobile,receiver_name,receiver_phone,receiver_state,receiver_city,receiver_district,receiver_address,has_shop,type,seller_credit_good_num,seller_credit_level,seller_credit_score,seller_credit_total_num,x_sm_mob_cat FROM $table WHERE has_shop=1 AND seller_credit_level>0";
		$n = Yii::app()->db->createCommand($sql)->execute();
		// 这里以receiver_mobile为主键，有些充值的卖家信息就损失掉了！
		$sql = "ALTER IGNORE TABLE sm_seller2 ADD PRIMARY KEY (receiver_mobile) ";
		$n = Yii::app()->db->createCommand($sql)->execute();
		//$sql = "ALTER IGNORE TABLE sm_seller2 DROP PRIMARY KEY";
		//$n = Yii::app()->db->createCommand($sql)->execute();
		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	public function actionMakeSmSellerBuyerInfo() 
	{
		exit;
		set_time_limit(0);
		$time=microtime(true);						
		$sql=<<<EOD
		ALTER IGNORE TABLE sm_seller1 
			ADD x_sm_mob_cat tinyint(1) NOT NULL DEFAULT '-1',
			ADD nick VARCHAR(32) NOT NULL DEFAULT '',
			ADD buyer_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			ADD buyer_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			ADD buyer_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			ADD buyer_credit_total_num int(10) unsigned NOT NULL DEFAULT '0',
			ADD vip_info VARCHAR(12) NOT NULL DEFAULT '',
			ADD sex CHAR(1) NOT NULL DEFAULT '',						
			ADD created date NOT NULL,
			ADD location_state VARCHAR(32) NOT NULL,
			ADD location_city VARCHAR(32) NOT NULL,		
			ADD has_shop tinyint(1) unsigned NOT NULL DEFAULT '0',		
			ADD type CHAR(1) NOT NULL DEFAULT '',			
			ADD seller_credit_good_num int(10) unsigned NOT NULL DEFAULT '0',
			ADD seller_credit_level tinyint(1) unsigned NOT NULL DEFAULT '0',
			ADD seller_credit_score int(10) unsigned NOT NULL DEFAULT '0',
			ADD seller_credit_total_num int(10) unsigned NOT NULL DEFAULT '0';
EOD;
		$n = Yii::app()->db->createCommand($sql)->execute();

		$sql = "SELECT * FROM sm_seller1";		
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		while(($row=$dataReader->read())!==false) 		
		{		
			$seller_mobile = $row['seller_mobile'];
			$seller_nick = $row['seller_nick'];			
 			$resp = Top::getUserFromTop($seller_nick);
			if (isset($resp->{'code'}))	
			{
				Util::write_log(print_r($resp,true));				
				if (stripos($resp->{'msg'}, "connect to host") !== false)
				{
					Util::write_log("getUserFromTop(),couldn't connect to host, wait 5 sec.");				
					sleep(5);
				}				
				if (stripos($resp->{'msg'}, "Failed connect") !== false)
				{
					Util::write_log("getUserFromTop(),isp.top-remote-connection-timeout, wait 5 sec.");				
					sleep(5);
				}								
				if (stripos($resp->{'sub_code'}, "isv.user-not-exist:invalid-nick") !== false)
				{		
					U::W("no buyer info, $seller_nick");
					continue;
				}
			}		
			$resp = json_decode(json_encode($resp), true);			
			$buyer_info = $resp['user'];
			$buyer_info['buyer_credit_good_num'] = $buyer_info['buyer_credit']['good_num'];
			$buyer_info['buyer_credit_level'] = $buyer_info['buyer_credit']['level'];
			$buyer_info['buyer_credit_score'] = $buyer_info['buyer_credit']['score'];
			$buyer_info['buyer_credit_total_num'] = $buyer_info['buyer_credit']['total_num'];			
			$buyer_info['seller_credit_good_num'] = $buyer_info['seller_credit']['good_num'];
			$buyer_info['seller_credit_level'] = $buyer_info['seller_credit']['level'];
			$buyer_info['seller_credit_score'] = $buyer_info['seller_credit']['score'];
			$buyer_info['seller_credit_total_num'] = $buyer_info['seller_credit']['total_num'];			
			$buyer_info['location_state'] = empty($buyer_info['location']['state']) ? '' : $buyer_info['location']['state'];			
			$buyer_info['location_city'] = empty($buyer_info['location']['city']) ? '' : $buyer_info['location']['city'];						
			$buyer_info['x_sm_mob_cat'] = empty($seller_mobile) ? -1 : Util::getMobCat($seller_mobile);							

	               $criteria = new CDbCriteria(array('condition' => 'seller_mobile = :seller_mobile', 'params' => array(':seller_mobile' => $seller_mobile)));
       	        yii::app()->db->getCommandBuilder()->createUpdateCommand('sm_seller1', $buyer_info, $criteria)->execute();			
		}	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb MakeSmSellerBuyerInfoSidCid
	// usr/bin/php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb MakeSmSellerBuyerInfoSidCid
	// nohup php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb MakeSmSellerBuyerInfoSidCid &
	public function actionMakeSmSellerBuyerInfoSidCid() 
	{

		// just following keys have right to call taobao.user.get 
		$MYAPP_KEY = '12010031';
		$MYAPP_SECRET = '96b2808ac7d797bf855fd37c891a9fc9';
		$MYAPP_KEY_TOOLS = '12117243';	
		$MYAPP_SECRET_TOOLS = '47f87e1cfcbd82f1255db7cfbaa98585';		
		$MYAPP_KEY_TAOMAP = '12175882';	
		$MYAPP_SECRET_TAOMAP = 'de940b5e9d90c43df897223403d5c87f';
		$MYAPP_KEY_SHOWCASE = '12149560';	
		$MYAPP_SECRET_SHOWCASE = 'b7750fbeb27530ee840c675a52f2759c';

		$MYAPP_KEY_YOUHUABAO = '12498110';			
		$MYAPP_SECRET_YOUHUABAO = 'b27cc00b17c13e9d401ae0f0abfad57c';		
		$MYAPP_KEY_BMAP_MARKER = '12430435';
		$MYAPP_SECRET_BMAP_MARKER = '1a017caab65c0b401bd73ebe941eb362';
		$MYAPP_KEY_GUIDE = '12333687';			
		$MYAPP_SECRET_GUIDE = '6906a30d93cbad05367bcd031e0ff3c4';		

		$my_app_secret = array(
			$MYAPP_KEY => $MYAPP_SECRET,		
			$MYAPP_KEY_GUIDE => $MYAPP_SECRET_GUIDE,		
			$MYAPP_KEY_YOUHUABAO => $MYAPP_SECRET_YOUHUABAO,
			$MYAPP_KEY_SHOWCASE => $MYAPP_SECRET_SHOWCASE,
			$MYAPP_KEY_TOOLS => $MYAPP_SECRET_TOOLS,
			$MYAPP_KEY_TAOMAP => $MYAPP_SECRET_TAOMAP,
			$MYAPP_KEY_BMAP_MARKER => $MYAPP_SECRET_BMAP_MARKER,			// dont use it for rent
		);	
	
		set_time_limit(0);
		$time=microtime(true);						

		$c = new TopClient;
		$req = new ShopGetRequest;
		$req->setFields("sid,cid,nick,created");
		
		//$sql = "SELECT seller_nick FROM sm_seller1";		
		$sql = "SELECT buyer_nick FROM sm_seller2";				
		$dbh = Yii::app()->db->pdoInstance;
		$sth = $dbh->query($sql);
		while ($row = $sth->fetch(PDO::FETCH_ASSOC))		
		{		
			//$seller_nick = $row['seller_nick'];			// 		sm_seller1
			$seller_nick = $row['buyer_nick'];			// 		sm_seller2			
			$appkey = array_rand($my_app_secret);				
			$c->appkey = $appkey;
			$c->secretKey = $my_app_secret[$c->appkey];						
			$req->setNick($seller_nick);
			$resp = $c->execute($req);

			if (isset($resp->{'code'}))	
			{
				Util::write_log(print_r($resp,true));		
				continue;
			}		

			if (!isset($resp->{'shop'}))	
			{
				Util::write_log(print_r($resp,true));	
				continue;
			}		
			
			$shop = $resp->{'shop'};
			$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."sm_seller2_sid_and_cid.log";
			$msg = json_encode($shop)."\n";
			error_log($msg, 3, $log_file_path);
		}	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	// php /wwwroot/htdocs/parsecode/yii/demos/map/protected/yiic.php hhb ReadSmSellerBuyerInfoSidCid
	public function actionReadSmSellerBuyerInfoSidCid() 
	{
		set_time_limit(0);
		$time=microtime(true);								
		$file = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."sid_and_cid.log";		
		$fh = fopen($file, "r");
		$i = 0;
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;				
			$obj = json_decode($line, true);				
			Util::write_log(print_r($obj,true));	
			//$nick = $obj['nick'];
			//$cid = $obj['cid'];
			//$sid = $obj['sid'];
			//$created = $obj['created'];			
		}
		fclose($fh);	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ScanInvalidMobileOld
	public function actionScanInvalidMobileOld() 
	{
		exit;
		set_time_limit(0);
		$time=microtime(true);				
		//$table = 'sm_order_all_test';
		$table = 'sm_order_all_ori';
		Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_scan_invalid_mobile")->execute();			
		$sql = "CREATE TABLE sm_scan_invalid_mobile LIKE $table ";
		$n = Yii::app()->db->createCommand($sql)->execute();
		$sql = "SELECT * FROM $table limit 1000000";					
		$i = 0;
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		while(($row=$dataReader->read())!==false) 		
		{		
			$receiver_mobile = $row['receiver_mobile'];
			$sku_properties_name = $row['sku_properties_name'];
			$mob_cat = Util::getMobCat($receiver_mobile);
			//if (!Util::mobileIsValid($receiver_mobile) || stripos($sku_properties_name, '.00') !== false)
			if (($receiver_mobile != '' AND $mob_cat == 9 ) || stripos($sku_properties_name, '.00') !== false)
			{
				echo "$receiver_mobile,$sku_properties_name\n";
				flush();
	       	       $n = yii::app()->db->getCommandBuilder()->createInsertCommand('sm_scan_invalid_mobile', $row)->execute();							
	       	       $i++;
	       	       if ($i > 3) break;
			}
		}	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}


	//INSTR(sku_properties_name, '.00') != 0
	//SELECT * FROM sm_order_all_ori WHERE SUBSTRING(sku_properties_name, -3) = '.00';
	//CREATE TABLE sm_scan_invalid_mobile ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM sm_order_all_ori WHERE LENGTH(receiver_mobile) != '11';
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb ScanInvalidMobile
	public function actionScanInvalidMobile() 
	{
		set_time_limit(0);
		$time=microtime(true);				
		//$table = 'sm_order_all_test';
		$table = 'sm_order_all_new';
		Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_scan_invalid_mobile")->execute();			
		$sql = "CREATE TABLE sm_scan_invalid_mobile LIKE $table ";
		$n = Yii::app()->db->createCommand($sql)->execute();
		$sql = "SELECT * FROM $table limit 100000";					
		$i = 0;
		$dbh = Yii::app()->db->pdoInstance;
		$sth = $dbh->query($sql);
		while ($row = $sth->fetch(PDO::FETCH_ASSOC))
		{			
			$receiver_mobile = $row['receiver_mobile'];
			$sku_properties_name = $row['sku_properties_name'];
			$mob_cat = Util::getMobCat($receiver_mobile);
			//if (!Util::mobileIsValid($receiver_mobile) || stripos($sku_properties_name, '.00') !== false)
			if (($receiver_mobile != '' AND $mob_cat == 9 ) || stripos($sku_properties_name, '.00') !== false)
			{
				echo "$receiver_mobile,$sku_properties_name\n";
				flush();
	       	       $n = yii::app()->db->getCommandBuilder()->createInsertCommand('sm_scan_invalid_mobile', $row)->execute();							
	       	       $i++;
	       	       //if ($i > 3) break;
			}
		}	
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb MakeSmAndEmail
	public function actionMakeSmAndEmail() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);		

		//先复制 sm_order_all_short 到另两个文件 sm_order_all_short_sm, sm_order_all_short_e 准备加工
		// 删除receiver_mobile和buyer_alipay_no都不是mobile号的记录
		//sm_order_all_short_sm, sm_order_all_short_e
		//sm_order_all_test_sm, sm_order_all_test_em

		$sql=<<<EOD

		DELETE FROM sm_order_all_short_sm WHERE (LEFT(receiver_mobile, 1) != '1' OR x_sm_mob_cat = '9' OR LENGTH(receiver_mobile) != 11) AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0 OR LENGTH(buyer_alipay_no) != 11);
		UPDATE sm_order_all_short_sm SET receiver_mobile=buyer_alipay_no, x_sm_mob_cat = '8' WHERE (LEFT(receiver_mobile, 1) != '1' OR x_sm_mob_cat = '9' OR LENGTH(receiver_mobile) != '11') AND (LEFT(buyer_alipay_no, 1) = '1' AND INSTR(buyer_alipay_no, '@') = 0 AND LENGTH(buyer_alipay_no) = '11');
		ALTER IGNORE TABLE sm_order_all_short_sm ADD PRIMARY KEY (cid,receiver_mobile);
		ALTER IGNORE TABLE sm_order_all_short_sm DROP PRIMARY KEY;		

		UPDATE sm_order_all_short_e SET buyer_alipay_no='' WHERE INSTR(buyer_alipay_no, '@') = 0 OR INSTR(buyer_alipay_no, '@yahoo') != 0;
		UPDATE sm_order_all_short_e SET buyer_email='' WHERE buyer_email!='' AND (INSTR(buyer_email, '@') = 0 OR INSTR(buyer_email, '@yahoo') != 0);
		DELETE FROM sm_order_all_short_e WHERE buyer_alipay_no = '' AND buyer_email = '';
		UPDATE sm_order_all_short_e SET buyer_alipay_no = '' WHERE buyer_alipay_no=buyer_email;
		UPDATE sm_order_all_short_e SET buyer_email=buyer_alipay_no, buyer_alipay_no='', x_sm_mob_cat='8' WHERE buyer_alipay_no != buyer_email AND buyer_email = '';

		ALTER IGNORE TABLE sm_order_all_short_e ADD PRIMARY KEY (cid,buyer_email);
		ALTER IGNORE TABLE sm_order_all_short_e DROP PRIMARY KEY;



		DROP TABLE IF EXISTS sm_order_all_shorter_sm;
		CREATE TABLE sm_order_all_shorter_sm (x_pct int(10) unsigned NOT NULL DEFAULT '0', x_mob_from int(10) unsigned NOT NULL DEFAULT '0') ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT oid,cid,receiver_mobile,buyer_nick,price,order_from,buyer_credit_level,buyer_credit_score,sex,x_vip_info,x_sm_mob_cat,receiver_state,receiver_city,receiver_district,title_short, FLOOR((CASE x_vip_info WHEN 0 THEN 1 WHEN 1 THEN 1 WHEN 2 THEN 500 WHEN 3 THEN 3000 WHEN 4 THEN 12500 WHEN 5 THEN 35000 WHEN 6 THEN 100000 WHEN 7 THEN 475000 ELSE 1200000 END)/IF(buyer_credit_score=0, 1, buyer_credit_score)) AS x_pct, 0 AS x_mob_from FROM sm_order_all_short_sm;
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 0 WHERE x_sm_mob_cat=-1 AND SUBSTRING(receiver_mobile,1,3) IN ('134','135','136','137','138','139','141','143','147','150','151','152','154','157','158','159','182','183','184','187','188');		
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 1 WHERE x_sm_mob_cat=-1 AND SUBSTRING(receiver_mobile,1,3) IN ('133','153','180','181','189','177');
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 2 WHERE x_sm_mob_cat=-1 AND SUBSTRING(receiver_mobile,1,3) IN ('130','131','132','145','155','156','185','186');
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 0,x_mob_from=8 WHERE x_sm_mob_cat=8 AND SUBSTRING(receiver_mobile,1,3) IN ('134','135','136','137','138','139','141','143','147','150','151','152','154','157','158','159','182','183','184','187','188');
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 1,x_mob_from=8 WHERE x_sm_mob_cat=8 AND SUBSTRING(receiver_mobile,1,3) IN ('133','153','180','181','189','177');
		UPDATE sm_order_all_shorter_sm SET x_sm_mob_cat = 2,x_mob_from=8 WHERE x_sm_mob_cat=8 AND SUBSTRING(receiver_mobile,1,3) IN ('130','131','132','145','155','156','185','186');

		DROP TABLE IF EXISTS sm_order_all_shorter_em;
		CREATE TABLE sm_order_all_shorter_em (x_pct int(10) unsigned NOT NULL DEFAULT '0') ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT oid,cid,buyer_email,buyer_alipay_no,buyer_nick,price,order_from, buyer_credit_level,buyer_credit_score,sex,x_vip_info,receiver_state,receiver_city,receiver_district,title_short, FLOOR((CASE x_vip_info WHEN 0 THEN 1 WHEN 1 THEN 1 WHEN 2 THEN 500 WHEN 3 THEN 3000 WHEN 4 THEN 12500 WHEN 5 THEN 35000 WHEN 6 THEN 100000 WHEN 7 THEN 475000 ELSE 1200000 END)/IF(buyer_credit_score=0, 1, buyer_credit_score)) AS x_pct FROM sm_order_all_short_e;

EOD;




/*
		SELECT buyer_email,buyer_alipay_no INTO OUTFILE 'a32.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_e  WHERE WHERE buyer_alipay_no = '' and buyer_email = '' LIMIT 1000;
		SELECT receiver_mobile,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a21.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE (LEFT(receiver_mobile, 1) != '1' OR x_sm_mob_cat = '9' OR LENGTH(receiver_mobile) != 11) AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0 OR LENGTH(buyer_alipay_no) != 11) LIMIT 100000;
		SELECT receiver_mobile,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a22.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE (LEFT(receiver_mobile, 1) != '1' OR x_sm_mob_cat = '9' OR LENGTH(receiver_mobile) != '11') AND (LEFT(buyer_alipay_no, 1) = '1' AND INSTR(buyer_alipay_no, '@') = 0 AND LENGTH(buyer_alipay_no) = '11') LIMIT 100000;
		SELECT receiver_mobile,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a23.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm  WHERE (LEFT(receiver_mobile, 1) != '1' OR x_sm_mob_cat = '9' OR LENGTH(receiver_mobile) != '11') AND (LEFT(buyer_alipay_no, 1) = '1' AND INSTR(buyer_alipay_no, '@') = 0 AND LENGTH(buyer_alipay_no) = '11') LIMIT 100000;
		SELECT receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a1.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE x_sm_mob_cat = '-1' LIMIT 10000;
		SELECT receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a2.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE x_sm_mob_cat = '9';

		SELECT receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a3.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE (x_sm_mob_cat = '-1' OR LEFT(receiver_mobile, 1) != '1') AND (LEFT(buyer_alipay_no, 1) = '1' AND INSTR(buyer_alipay_no, '@') = 0) LIMIT 10000;		
		SELECT * INTO OUTFILE 'a5.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_e WHERE (x_sm_mob_cat = '-1' OR LEFT(receiver_mobile, 1) != '1') AND (LEFT(buyer_alipay_no, 1) = '1' AND INSTR(buyer_alipay_no, '@') = 0) LIMIT 10000;		

		UPDATE sm_order_all_short_sm SET receiver_mobile=buyer_alipay_no, x_sm_mob_cat = '8' WHERE x_sm_mob_cat = '-1' AND ;

		ALTER IGNORE TABLE sm_order_all_short_sm DROP buyer_email, DROP buyer_alipay_no, DROP createdx, DROP vip_info, DROP created, DROP receiver_name, DROP x_send_cnt, DROP x_send_time

		DELETE FROM sm_order_all_short_sm WHERE LEFT(receiver_mobile, 1) != '1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);
		ALTER IGNORE TABLE sm_order_all_short_sm ADD PRIMARY KEY (cid,receiver_mobile,buyer_alipay_no);
		ALTER IGNORE TABLE sm_order_all_short_sm DROP PRIMARY KEY,DROP buyer_email,DROP vip_info;

		DELETE FROM sm_order_all_short_e WHERE INSTR(buyer_email, '@') = 0 AND INSTR(buyer_alipay_no, '@') = 0;
		ALTER IGNORE TABLE sm_order_all_short_e ADD PRIMARY KEY (cid,buyer_email,buyer_alipay_no);
		ALTER IGNORE TABLE sm_order_all_short_e DROP PRIMARY KEY, DROP receiver_mobile, DROP x_sm_mob_cat, DROP receiver_phone, DROP vip_info;

		SELECT receiver_mobile,buyer_alipay_no,x_sm_mob_cat,oid INTO OUTFILE 'a1.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_order_all_short_sm WHERE x_sm_mob_cat = '9' LIMIT 10000;
		DELETE FROM sm_order_all_short_sm WHERE LEFT(receiver_mobile, 1) != '1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);

		SELECT oid,receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat FROM sm_order_all_test WHERE x_sm_mob_cat = '9';
		SELECT receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a3.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_999999999_rest WHERE (x_sm_mob_cat = '-1' OR x_sm_mob_cat = '9');
		SELECT receiver_mobile,receiver_phone,buyer_alipay_no,x_sm_mob_cat INTO OUTFILE 'a4.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_999999999_rest WHERE (x_sm_mob_cat = '-1' OR x_sm_mob_cat = '9') AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);

		// 将无效mobile号清为空,有必要?
		UPDATE sm_order_all_test SET receiver_mobile='', x_sm_mob_cat = '-1' WHERE x_sm_mob_cat = '9';
		
		DELETE FROM sm_order_all_test WHERE x_sm_mob_cat = '-1' AND (LEFT(buyer_alipay_no, 1) != '1' OR INSTR(buyer_alipay_no, '@') != 0);		
*/		
		$n = Yii::app()->db->createCommand($sql)->execute();
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}


	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb UpdateSmItemCatOrderCnt
	public function actionUpdateSmItemCatOrderCnt() 
	{
		//exit;		
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			

		//$parent_cid = 0;
		//$parent_cid = MSmItemCat::CID_NU_ZHUANG;
		//$parent_cid = MSmItemCat::CID_MOB_CHONGZHI;		
		$parent_cid = MSmItemCat::CID_NAN_ZHUANG;
		$cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid={$parent_cid}")->queryColumn();
		$stat = array();
		foreach($cids as $cid)
		{
			$root_table = "sm_{$cid}";
			$count = Yii::app()->db->createCommand("SELECT COUNT(*) FROM $root_table")->queryScalar();
			Yii::app()->db->createCommand()->update('sm_itemcat', array('x_order_cnt'=>$count), 'cid=:cid', array(':cid'=>$cid));
			$stat[$cid] = $count;			
		}
		arsort($stat);
		U::W($stat);
	}

	//C:\xampp\php\php.exe C:\htdocs\apps\sms\protected\yiic.php hhb MakeNickShopCatDb
	public function actionMakeNickShopCatDb() 
	{	
		set_time_limit(0);			
		$table = 'sm_nick_shop_cat';
		//DROP TABLE IF EXISTS {$table};		
		//ALTER IGNORE TABLE sm_nick_shop_cat ADD PRIMARY KEY (nick);
		$sql=<<<EOD

		CREATE TABLE IF NOT EXISTS {$table} (
			sid bigint(20) unsigned NOT NULL DEFAULT '0',
			nick varchar(64) NOT NULL DEFAULT '',    			
			cid int(10) unsigned NOT NULL default 0,  						
			shop_created DATETIME NOT NULL		  
		) ENGINE=MyISAM default CHARSET=utf8;

EOD;

		Yii::app()->db->createCommand($sql)->execute();		
		$os_is_window = stripos(PHP_OS, 'win') !== false ? true : false;

		//$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_seller1_sid_and_cid.log';
		$log_file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sm_seller2_sid_and_cid.log';
		$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
		if ($os_is_window)
		{
			$filename = str_replace('\\', '/', $filename);
			$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
		}
		else
		{
			$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
		}

		$sum = 0;
		$fh = fopen($log_file_path, "r");		
		while (!feof($fh)) 
		{
			$line = fgets($fh);
			if (empty($line))
				continue;
			$row = json_decode($line,true);

			$var_arr = array();
			$val_arr['sid'] = $row['sid'];					
			$val_arr['nick'] = $row['nick'];								
			$val_arr['cid'] = $row['cid'];								
			$val_arr['shop_created'] = $row['created'];			

			$val_arr1 = array_values($val_arr);				
			$str = implode('","', $val_arr1);

			if ($os_is_window)				
				error_log("\"{$str}\"\r\n", 3, $filename);	
			else
				error_log("\"{$str}\"\n", 3, $filename);						

			$sum++;				
			if ($sum % 10000 === 1) 
			{
				U::W("sum=$sum");				
				//break;
			}

		}		
		fclose($fh);	

		$n = Yii::app()->db->createCommand($sql)->execute();
		
		U::W("$sql OK...,n=n");		
		unlink($filename);

		U::W(__FUNCTION__.' done');			
	}

	//C:\xampp\php\php.exe C:\htdocs\apps\sms\protected\yiic.php hhb MergeSmSeller
	public function actionMergeSmSeller() 
	{	
		set_time_limit(0);			
		$sql=<<<EOD

		DROP TABLE IF EXISTS sm_seller1_x;
		CREATE TABLE IF NOT EXISTS sm_seller1_x ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT 
			t1.*,
			t2.sid as sid,
			t2.nick as nick_s,
			t2.cid as cid,	
			t2.shop_created as shop_created
			FROM sm_seller1 t1 
			LEFT JOIN sm_nick_shop_cat t2 ON t1.seller_nick = t2.nick;

		DROP TABLE IF EXISTS sm_seller2_x;
		CREATE TABLE IF NOT EXISTS sm_seller2_x ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT 
			t1.*,
			t2.sid as sid,
			t2.nick as nick_s,
			t2.cid as cid,	
			t2.shop_created as shop_created
			FROM sm_seller2 t1 
			LEFT JOIN sm_nick_shop_cat t2 ON t1.buyer_nick = t2.nick;

		UPDATE sm_seller1_x SET seller_alipay_no=''  WHERE seller_alipay_no = seller_email;
		UPDATE sm_seller1_x SET seller_email=''  WHERE seller_email != '' AND (INSTR(seller_email, '@') = 0 OR INSTR(seller_email, '@yahoo') != 0);
		UPDATE sm_seller1_x SET seller_alipay_no=''  WHERE seller_alipay_no != '' AND INSTR(seller_alipay_no, '@yahoo') != 0;
		UPDATE sm_seller1_x SET seller_alipay_no=''  WHERE seller_alipay_no != '' AND seller_alipay_no = seller_email;
		UPDATE sm_seller1_x SET seller_email=seller_alipay_no,  seller_alipay_no='' WHERE seller_email='' AND INSTR(seller_alipay_no, '@') != 0;
		UPDATE sm_seller1_x SET seller_alipay_no=''  WHERE seller_alipay_no != '' AND seller_alipay_no = seller_mobile;
		ALTER TABLE sm_seller1_x DROP buyer_credit_good_num, DROP buyer_credit_level, DROP buyer_credit_score, DROP buyer_credit_total_num; 

		UPDATE sm_seller2_x SET buyer_email=''  WHERE buyer_email != '' AND (INSTR(buyer_email, '@') = 0 OR INSTR(buyer_email, '@yahoo') != 0);
		UPDATE sm_seller2_x SET buyer_alipay_no=''  WHERE buyer_alipay_no != '' AND INSTR(buyer_alipay_no, '@yahoo') != 0;
		UPDATE sm_seller2_x SET buyer_alipay_no=''  WHERE buyer_alipay_no != '' AND buyer_alipay_no = buyer_email;
		UPDATE sm_seller2_x SET buyer_email=buyer_alipay_no,  buyer_alipay_no='' WHERE buyer_email='' AND INSTR(buyer_alipay_no, '@') != 0;
		UPDATE sm_seller2_x SET buyer_alipay_no=''  WHERE buyer_alipay_no != '' AND buyer_alipay_no = receiver_mobile;

		ALTER TABLE sm_seller1_x ADD KEY idx_score (seller_credit_score);
		ALTER TABLE sm_seller2_x ADD KEY idx_cid_score (cid, seller_credit_score);

EOD;
		$n = Yii::app()->db->createCommand($sql)->execute();
		
		U::W("$sql OK...,n=n");		
		unlink($filename);

		U::W(__FUNCTION__.' done');			
	}

	//C:\xampp\php\php.exe C:\htdocs\apps\sms\protected\yiic.php hhb TmpError
	public function actionTmpError() 
	{
		echo __FUNCTION__;
		$time=microtime(true);

		for ($i=0;$i<5;$i++)
		{
			unset($var_arr);
			$var_arr = array();
			$val_arr['sid'] = $i;					
			$val_arr['cid'] = $i;
			U::W($val_arr);
			$val_arr = array_values($val_arr);
		}
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SendEmailToSeller
	//D:\xampp\php\php.exe D:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SendEmailToSeller	
	//C:\xampp\php\php.exe C:\htdocs\apps\sms\protected\yiic.php hhb SendEmailToSeller
	//ALTER IGNORE TABLE sm_seller2_em ADD PRIMARY KEY (buyer_email);
	//ALTER TABLE  sm_seller2_em ADD id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY;
	public function actionSendEmailToSeller() 
	{
		set_time_limit(0);
		require_once(Yii::app()->getBasePath().'/extensions/mailer/phpmailer/class.phpmailer.php');
		$table = 'sm_seller2_em';
		
		$db = Yii::app()->db;
		Yii::app()->db->createCommand()->update(self::SMTP_ACC_TABLE, array('cnt'=>0,'code'=>0, 'msg'=>''));
		$filename_last_id =  Yii::app()->getRuntimePath()."/sm_smtp_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;
		self::log_smtp("begin last_id=$last_id");	
		mb_internal_encoding("UTF-8");		
		$smtp_story = file_get_contents(Yii::app()->getRuntimePath()."/sm_smtp_story.txt");
		$smtp_story_len = mb_strlen($smtp_story);
		$sql = "SELECT * FROM $table WHERE (NOT ISNULL(sid)) AND id > '$last_id' LIMIT 20000";	
//		$sql = "SELECT * FROM $table WHERE id = '1' LIMIT 1";		// hehbhehb@sina.com
//		$sql = "SELECT * FROM $table WHERE id = '9' LIMIT 1";		// desk_000001@126.com
//		$sql = "SELECT * FROM $table WHERE id = '11' LIMIT 1";		// moon_000001@163.com
//		$sql = "SELECT * FROM $table WHERE id = '49' LIMIT 1";		// hehbhehb@yeah.net
//		$sql = "SELECT * FROM $table WHERE id = '30' LIMIT 1";		// hehbhehb@sohu.com	
//		$sql = "SELECT * FROM $table WHERE id = '28' LIMIT 1";		// hhb@whu.edu.cn
//		$sql = "SELECT * FROM $table WHERE id = '5' LIMIT 1";		// 57620133@qq.com
//		$sql = "SELECT * FROM $table WHERE id = '24' LIMIT 1";		// zengkai001@qq.com
		
		$dataReader = $db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");

			if ($table == 'sm_seller1_em')
			{			
				if (strpos($user['seller_email'], '@') !== false)
					$receiver_email = $user['seller_email'];
				else {
					self::log_smtp("{$user['seller_nick']} has no valid email...");						
					continue;
				}			
				$user['buyer_nick'] = $user['seller_nick'];
				$user['receiver_name'] = $user['seller_name'];
				$user['receiver_email'] = $user['seller_email'];	
			}
			else if ($table == 'sm_seller2_em')
			{
				if (strpos($user['buyer_email'], '@') !== false)
					$receiver_email = $user['buyer_email'];
				else {
					self::log_smtp("{$user['buyer_nick']} has no valid email...");						
					continue;
				}
			}
			else
				die('invalid table');
						
			$user['receiver_email'] = $receiver_email;
			$user['smtp_story_rand'] = mb_strimwidth($smtp_story, rand(0, $smtp_story_len-256), 256);
			
			$email_cat = self::get_email_cat($user['receiver_email']);
			
			try {		
				$mailer = new PHPMailer(true);		
				$mailer->IsHTML(true);
				$mailer->IsSMTP();	
				$mailer->XMailer = 'Foxmail 7.0.1.91[cn]';									
				//$mailer->SMTPDebug = 1;		// 0: no, 1:err,  2:err+msg(verbal)
				$mailer->SMTPDebug = 2;		
				//$mailer->Debugoutput = 'error_log';
				$mailer->SMTPAuth = true;
				$mailer->CharSet = 'utf-8';
			
				$mailer->ClearAddresses();			
				$acc_row = $this->get_stmp_acc_row($email_cat);
				$subject = Util::renderInternal(Yii::app()->basePath.'/views/email/v_title_sm.php',array('user'  => $user),true);			
				//U::W("subject=$subject");				
				$body = Util::renderInternal(Yii::app()->basePath.'/views/email/v_red_sm.html',array('user'  => $user,'acc_row'  => $acc_row,),true);													
				//U::W("body=$body");
				$mailer->Host = self::get_smtp_host($acc_row['email_full']);
				$mailer->Port = '25';			
				if (strpos($acc_row['email_full'],'yahoo.cn') !== false)				
					$mailer->Username = $acc_row['email_full'];					
				else
					$mailer->Username = $acc_row['username'];
				$mailer->Password = $acc_row['password'];			

				$mailer->AddAddress($receiver_email, $user['receiver_name']);
				$mailer->SetFrom($acc_row['email_full'], $user['receiver_name']);
				$mailer->Sender = '';
				//$mailer->Sender = $acc_row['email_full'];
				//$mailer->AddReplyTo('admin@parsecode.com', 'parsecode');
				//$mailer->AddBCC("hhb@whu.edu.cn");
				$mailer->Subject = $subject;
				$mailer->Body = $body;
				$mailer->Send();
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full' , 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt'=>1, 'sum'=>1), $criteria)->execute();				
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_ok");								
				$mailer = null;				
				sleep(15);
				$idx++;
				if ($idx % 5 == 0) {
					//self::log_smtp("$idx, wait 60 sec per 5 email");	
					//sleep(30);					
				}
			} catch (phpmailerException $e) {
				echo $e->getMessage();			
				Util::log("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage(), Yii::app()->getRuntimePath()."/smtp_err.log");	
				self::log_smtp("idx=$idx, id={$user['id']}, receiver_email=$receiver_email, receiver_name={$user['receiver_name']}, buyer_nick={$user['buyer_nick']}, send_err, ".$e->getMessage());								
				$acc_new = array();
				
				if (strpos($e->getMessage(),'not authenticate') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, password is bad,".$mailer->ErrorInfo);	
					$acc_new['code'] = 99;
				}
				else if (strpos($e->getMessage(),'From address failed') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']}, it is rejected,".$mailer->ErrorInfo);	
					$acc_new['code'] = 98;
				}
				else if (stripos($mailer->ErrorInfo,'Connection frequency limited') !== false)
				{
					self::log_smtp("smtp acc {$acc_row['email_full']},".$mailer->ErrorInfo);	
					$this->qq_frequency_limited = 1;
				}				
				//$acc_new['msg'] = $e->getMessage();
				$acc_new['msg'] = $mailer->ErrorInfo;
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full', 'params' => array(':email_full' => $acc_row['email_full']), 'limit'=>1));				
				Yii::app()->db->getCommandBuilder()->createUpdateCommand(self::SMTP_ACC_TABLE, $acc_new, $criteria)->execute();
				Yii::app()->db->getCommandBuilder()->createUpdateCounterCommand(self::SMTP_ACC_TABLE, array('cnt_err'=>1), $criteria)->execute();
				continue;
				
			} catch (Exception $e) {
				echo $e->getMessage();
				self::log_smtp($e->getCode().":".$e->getMessage());
				self::log_smtp("Stop abnormally!");
				break;
			}
		}	
		self::log_smtp("All done today");		
		return;		
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SendSmToSeller
	//SELECT * FROM sm_seller2_sm WHERE seller_credit_level >= 10 AND (cid IN (1062,30,1020))
	//sm_seller2_sm中有些卖家是做代发货，填写的receiver_mobile并不是卖家自己的mobile，而且真正买家的mobile,所以这种记录没什么用
	/*
	//SELECT *,count(sid) as c FROM sm_seller2_sm WHERE seller_credit_level >= 10 AND cid IN (30,1020,1062) GROUP BY sid HAVING c>1 ORDER BY c ASC
	//SELECT *,count(sid) as c FROM sm_seller2_sm WHERE cid IN (30,1020,1062) GROUP BY sid HAVING c>1 ORDER BY c ASC	
	ALTER IGNORE TABLE sm_seller2_sm ADD PRIMARY KEY (receiver_mobile);
	ALTER TABLE  sm_seller2_sm ADD id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY;
	DELETE FROM sm_seller2_sm WHERE isnull( sid ) 
	DROP TABLE tmp_x1;
	CREATE TABLE tmp_x1 SELECT sid,count(sid) as c FROM sm_seller2_sm GROUP BY sid HAVING c>3;
	ALTER TABLE tmp_x1 add primary key (sid);	
	DELETE FROM sm_seller2_sm WHERE sid IN (SELECT sid FROM tmp_x1);
	*/
	public function actionSendSmToSeller() 
	{
		set_time_limit(0);
		$table = 'sm_seller2_sm';		
		$db = Yii::app()->db;
		$filename_last_id =  Yii::app()->getRuntimePath()."/sm_sm_last_id.txt";
		if (file_exists($filename_last_id)) {
			$last_id_str = file_get_contents($filename_last_id);
			$last_id = intval($last_id_str);		
		}
		else 
			$last_id = 0;
		self::log_smtp("begin last_id=$last_id");	
		Util::log("begin last_id=$last_id", Yii::app()->getRuntimePath()."/sm_sm.log");
		
		$sql = "SELECT * FROM $table WHERE seller_credit_level >= 8 AND cid IN (1062,30,1020) AND id > '$last_id' LIMIT 20000";	
		$dataReader = $db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			file_put_contents($filename_last_id, "{$user['id']}");
			$mobile = $table == 'sm_seller2_sm' ? $user['receiver_mobile'] : $user['seller_mobile'];
			if (!Util::mobileIsValid($mobile))
				continue;
			U::W($mobile);	
		}	
		Util::log("All done today", Yii::app()->getRuntimePath()."/sm_sm.log");
		return;		
	}
	
}




/*
	cnt_int:
	0:0-100
	1:100-500
	2:500-1000
	3:1000-5000
	4:5000-10000
	5:>10000

	buy_int:
	0:0-10
	1:10-30
	2:30-50
	3:50-80
	4:80-100
	5:>100

	ppc_int:				
	0:0-0.3
	1:0.3-0.5
	2:0.5-0.8
	3:0.8-1.1
	4:>1.1

	UPDATE keyword_cid SET cnt_int='0' where cnt='100以下'
	UPDATE keyword_cid SET cnt_int='1' where cnt='101-500'
	UPDATE keyword_cid SET cnt_int='2' where cnt='501-1000'
	UPDATE keyword_cid SET cnt_int='3' where cnt='1001-5000'
	UPDATE keyword_cid SET cnt_int='4' where cnt='5001-10000'
	UPDATE keyword_cid SET cnt_int='5' where cnt='10001以上'


	ALTER TABLE keyword_cid ADD c1_int int(10) unsigned NOT NULL default 0 after c1;		
	ALTER TABLE keyword_cid ADD c2_int int(10) unsigned NOT NULL default 0 after c2;		
	ALTER TABLE keyword_cid ADD c3_int int(10) unsigned NOT NULL default 0 after c3;				
	ALTER TABLE keyword_cid ADD cnt_int tinyint(3) unsigned NOT NULL default 0 after cnt;		
	ALTER TABLE keyword_cid ADD buy_int tinyint(3) unsigned NOT NULL default 0 after buy;		
	ALTER TABLE keyword_cid ADD ppc_int tinyint(3) unsigned NOT NULL default 0 after ppc;			

	CREATE TABLE data_sold_receiver_order_1 ENGINE=MYISAM SELECT * FROM `data_sold_receiver_order` LIMIT 10	
	
	// cd mysql/data/yii, copy data_sold_receiver_order_simple files from data_sold_receiver_order
	ALTER IGNORE TABLE data_sold_receiver_order_simple ADD PRIMARY KEY(buyer_nick)	
	ALTER IGNORE TABLE data_sold_receiver_order_simple  DROP PRIMARY KEY		
	ALTER TABLE data_sold_receiver_order_simple ADD id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
	DELETE FROM `data_sold_receiver_order_simple` WHERE INSTR(buyer_email, '@') = 0 AND INSTR(buyer_alipay_no, '@') = 0

//nick_crc bigint(20) unsigned NOT NULL DEFAULT '0', 
//'nick_crc'=>new CDbExpression("CRC32(:nick)", array(':nick'=>$obj['nick'])),
//'nick_crc'=>new CDbExpression("CONV(RIGHT(MD5(:nick), 16), 16, 10)", array(':nick'=>$obj['nick'])),
//'buyer_nick_crc'=>new CDbExpression("CRC32(:buyer_nick)", array(':buyer_nick'=>$obj['buyer_nick'])),							


	$mailer->Host = Yii::app()->params['serviceEmail']['host'];				
	$mailer->Username = Yii::app()->params['serviceEmail']['username'];
	$mailer->Password = Yii::app()->params['serviceEmail']['password'];
	$mailer->From = Yii::app()->params['serviceEmail']['address'];
	$mailer->FromName = Yii::app()->params['serviceEmail']['name'];


	$mail = $mailer;
	$mail->IsSMTP();
	try {
		$mail->SMTPDebug  = 2;  // enables SMTP debug information (for testing),  1 = errors and messages, 2 = messages only			
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.sina.com.cn"; // sets the SMTP server
		$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "hehbhehb@sina.com"; // SMTP account username
		$mail->Password   = "hehbhehb429730";        // SMTP account password
//		$mail->AddReplyTo('name@yourdomain.com', 'First Last');
		$mail->AddAddress('53bs@sina.com', 'John Doe');
		$mail->SetFrom('hehbhehb@sina.com', 'First Last');
//		$mail->AddReplyTo('name@yourdomain.com', 'First Last');
		$mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		$mail->MsgHTML(file_get_contents('examples/contents.html'));
		$mail->AddAttachment('examples/images/phpmailer.gif');      // attachment
		$mail->AddAttachment('examples/images/phpmailer_mini.gif'); // attachment
		$mail->Send();
		echo "Message Sent OK</p>\n";
	} catch (phpmailerException $e) {
		echo $e->errorMessage();
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	return;


	array('host'=>'smtp.sina.com', 'username'=>'shongtbcuyn', 'password'=>'3h5z5mxs', 'from'=>'shongtbcuyn@sina.com',),
	array('host'=>'smtp.sina.com', 'username'=>'jinrgntlc', 'password'=>'387t6ffs', 'from'=>'jinrgntlc@sina.com',),			

	array('host'=>'smtp.163.com', 'username'=>'shenqidesh', 'password'=>'mcf551', 'from'=>'shenqidesh@163.com',),
	array('host'=>'smtp.163.com', 'username'=>'h27552918309902', 'password'=>'1989929damoxin', 'from'=>'h27552918309902@163.com',),
	array('host'=>'smtp.126.com', 'username'=>'that7492', 'password'=>'2274282', 'from'=>'that7492@126.com',),
	array('host'=>'smtp.126.com', 'username'=>'fajard7472', 'password'=>'535272', 'from'=>'fajard7472@126.com',),
	array('host'=>'smtp.sohu.com', 'username'=>'zhulunyuzk', 'password'=>'623642', 'from'=>'zhulunyuzk@sohu.com',),
	array('host'=>'smtp.tom.com', 'username'=>'will98891', 'password'=>'2315822', 'from'=>'will98891@tom.com',),						
	
	UPDATE smtp_acc_1 SET cnt='0';
	UPDATE smtp_acc_1 SET code='0';		
	UPDATE smtp_acc_1 SET msg='';	

	static public function get_stmp_acc_row_old($user)	
	{
		$acc_sina = array (		
			array('host'=>'smtp.sina.com', 'username'=>'moon_000001', 'password'=>'12345678', 'email_full'=>'moon_000001@sina.com',),
			array('host'=>'smtp.sina.com', 'username'=>'shongtbcuyn', 'password'=>'3h5z5mxs', 'email_full'=>'shongtbcuyn@sina.com',),
			array('host'=>'smtp.sina.com', 'username'=>'jinrgntlc', 'password'=>'387t6ffs', 'email_full'=>'jinrgntlc@sina.com',),			
		);

		$acc_163 = array (		
			array('host'=>'smtp.163.com', 'username'=>'shenqidesh', 'password'=>'mcf551', 'email_full'=>'shenqidesh@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'h27552918309902', 'password'=>'1989929damoxin', 'email_full'=>'h27552918309902@163.com',),
			array('host'=>'smtp.126.com', 'username'=>'that7492', 'password'=>'2274282', 'email_full'=>'that7492@126.com',),
			array('host'=>'smtp.126.com', 'username'=>'fajard7472', 'password'=>'535272', 'email_full'=>'fajard7472@126.com',),
			array('host'=>'smtp.sohu.com', 'username'=>'zhulunyuzk', 'password'=>'623642', 'email_full'=>'zhulunyuzk@sohu.com',),
			array('host'=>'smtp.tom.com', 'username'=>'will98891', 'password'=>'2315822', 'email_full'=>'will98891@tom.com',),						
		
			array('host'=>'smtp.163.com', 'username'=>'moon_000001', 'password'=>'a12345678', 'email_full'=>'moon_000001@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000002', 'password'=>'a12345678', 'email_full'=>'moon_000002@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000003', 'password'=>'a12345678', 'email_full'=>'moon_000003@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000004', 'password'=>'a12345678', 'email_full'=>'moon_000004@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000006', 'password'=>'a12345678', 'email_full'=>'moon_000006@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000007', 'password'=>'a12345678', 'email_full'=>'moon_000007@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000008', 'password'=>'a12345678', 'email_full'=>'moon_000008@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000009', 'password'=>'a12345678', 'email_full'=>'moon_000009@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000010', 'password'=>'a12345678', 'email_full'=>'moon_000010@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000011', 'password'=>'a12345678', 'email_full'=>'moon_000011@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000012', 'password'=>'a12345678', 'email_full'=>'moon_000012@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000013', 'password'=>'a12345678', 'email_full'=>'moon_000013@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000014', 'password'=>'a12345678', 'email_full'=>'moon_000014@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000015', 'password'=>'a12345678', 'email_full'=>'moon_000015@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000016', 'password'=>'a12345678', 'email_full'=>'moon_000016@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000017', 'password'=>'a12345678', 'email_full'=>'moon_000017@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000018', 'password'=>'a12345678', 'email_full'=>'moon_000018@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000019', 'password'=>'a12345678', 'email_full'=>'moon_000019@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'moon_000020', 'password'=>'a12345678', 'email_full'=>'moon_000020@163.com',),
			
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_001', 'password'=>'a12345678', 'email_full'=>'x17150932527_001@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_002', 'password'=>'a12345678', 'email_full'=>'x17150932527_002@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_003', 'password'=>'a12345678', 'email_full'=>'x17150932527_003@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_004', 'password'=>'a12345678', 'email_full'=>'x17150932527_004@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_005', 'password'=>'a12345678', 'email_full'=>'x17150932527_005@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_006', 'password'=>'a12345678', 'email_full'=>'x17150932527_006@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_007', 'password'=>'a12345678', 'email_full'=>'x17150932527_007@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_008', 'password'=>'a12345678', 'email_full'=>'x17150932527_008@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_009', 'password'=>'a12345678', 'email_full'=>'x17150932527_009@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_010', 'password'=>'a12345678', 'email_full'=>'x17150932527_010@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_011', 'password'=>'a12345678', 'email_full'=>'x17150932527_011@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'x17150932527_012', 'password'=>'a12345678', 'email_full'=>'x17150932527_012@163.com',),

			array('host'=>'smtp.163.com', 'username'=>'a14995261858_001', 'password'=>'b12345678', 'email_full'=>'a14995261858_001@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_002', 'password'=>'b12345678', 'email_full'=>'a14995261858_002@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_003', 'password'=>'b12345678', 'email_full'=>'a14995261858_003@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_004', 'password'=>'b12345678', 'email_full'=>'a14995261858_004@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_005', 'password'=>'b12345678', 'email_full'=>'a14995261858_005@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_006', 'password'=>'b12345678', 'email_full'=>'a14995261858_006@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_007', 'password'=>'b12345678', 'email_full'=>'a14995261858_007@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_008', 'password'=>'b12345678', 'email_full'=>'a14995261858_008@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_009', 'password'=>'b12345678', 'email_full'=>'a14995261858_009@163.com',),
			array('host'=>'smtp.163.com', 'username'=>'a14995261858_010', 'password'=>'b12345678', 'email_full'=>'a14995261858_010@163.com',),						
		);

		$acc_yahoo_cn = array (
			array('host'=>'smtp.mail.yahoo.com', 'username'=>'a14995261858_001@yahoo.cn', 'password'=>'a12345678', 'email_full'=>'a14995261858_001@yahoo.cn',),
			array('host'=>'smtp.mail.yahoo.com', 'username'=>'a14995261858_002@yahoo.cn', 'password'=>'a12345678', 'email_full'=>'a14995261858_002@yahoo.cn',),
			array('host'=>'smtp.mail.yahoo.com', 'username'=>'a14995261858_003@yahoo.cn', 'password'=>'a12345678', 'email_full'=>'a14995261858_003@yahoo.cn',),
			array('host'=>'smtp.mail.yahoo.com', 'username'=>'a14995261858_004@yahoo.cn', 'password'=>'a12345678', 'email_full'=>'a14995261858_004@yahoo.cn',),
			array('host'=>'smtp.mail.yahoo.com', 'username'=>'a14995261858_005@yahoo.cn', 'password'=>'a12345678', 'email_full'=>'a14995261858_005@yahoo.cn',),			
			
		);

		$acc_126 = array (
			array('host'=>'smtp.126.com', 'username'=>'desk_000001', 'password'=>'a12345678', 'email_full'=>'desk_000001@163.com',),
			
		);

		$acc_qq = array (
//			array('host'=>'smtp.qq.com', 'username'=>'1097014142', 'password'=>'password#1', 'email_full'=>'moon_000002@163.com',),					
			array('host'=>'smtp.qq.com', 'username'=>'1449523770', 'password'=>'password#1', 'email_full'=>'1449523770@qq.com',),
			array('host'=>'smtp.qq.com', 'username'=>'1640499357', 'password'=>'password#1', 'email_full'=>'1640499357@qq.com',),
			array('host'=>'smtp.qq.com', 'username'=>'1595449440', 'password'=>'hehbhehb', 'email_full'=>'1595449440@qq.com',),
			array('host'=>'smtp.qq.com', 'username'=>'1711151658', 'password'=>'hehbhehb', 'email_full'=>'1711151658@qq.com',),
			array('host'=>'smtp.qq.com', 'username'=>'2368055911', 'password'=>'hehbhehb', 'email_full'=>'2368055911@qq.com',),
			
		);

		$acc_sohu = array (
//			array('host'=>'smtp.126.com', 'username'=>'desk_000001', 'password'=>'a12345678', 'email_full'=>'desk_000001@163.com',),			
		);

		$acc_whu = array (
			array('host'=>'whu.edu.cn', 'username'=>'hhb', 'password'=>'hehbhehb429730', 'email_full'=>'hhb@whu.edu.cn',),			
		);
		
		$acc_all = array_merge($acc_sina, $acc_163, $acc_yahoo_cn, $acc_126);
		// Util::write_log($acc_all);			

		$acc_row = $acc_all[array_rand($acc_all)];
		$acc_row = $acc_all[0];				
//		$acc_row = $acc_all[1];
//		$acc_row = $acc_whu[0];
//		$acc_row = $acc_126[0];
		$acc_row = $acc_163[0];
//		$acc_row = $acc_sina[1];
//		$acc_row = $acc_sina[2];

		Util::write_log($acc_row);
		return($acc_row);
	}

		decimal(10,2)
			send_done_time DATETIME NOT NULL,		

		ALTER TABLE crm_member 
			ADD sm_tot_cnt int(10) unsigned NOT NULL default 0,
			ADD sm_send_time DATETIME NULL,	
			ADD coupon_tot_cnt int(10) unsigned NOT NULL default 0,
			ADD coupon_send_time DATETIME NULL,	
			ADD coupon_min_endtime DATETIME NULL,	

		ALTER TABLE crm_member 
			ADD sm_tot_cnt int(10) unsigned NOT NULL default '0',
			ADD sm_send_time int(10) unsigned NOT NULL DEFAULT '0',
			ADD coupon_tot_cnt int(10) unsigned NOT NULL default '0',
			ADD coupon_send_time int(10) unsigned NOT NULL DEFAULT '0',
			ADD coupon_min_endtime int(10) unsigned NOT NULL DEFAULT '0';		

		
		//$sql = "SELECT * FROM data_sold_receiver_order_simple WHERE id > '$last_id' LIMIT 15000";	
		$sql = "SELECT * FROM data_sold_receiver_order_simple LIMIT 50";				
		$dataReader = Yii::app()->db->createCommand($sql)->query();
		$idx = 0;
		while(($user=$dataReader->read())!==false) 
		{ 			
			//file_put_contents($filename_last_id, "{$user['id']}");		
			$appkey = array_rand($my_app_secret);				
			$c->appkey = $appkey;
			$c->secretKey = $my_app_secret[$c->appkey];						
			$nick = $user['nick'];
			$req->setNick($nick);
			$resp = $c->execute($req);	
			//L($resp);	
			
			if (isset($resp->{'code'}))	
			{
				L($resp);	
				break;
			}
			
			Util::save_to_file_date('user', $resp->{'user'});	
			
		}	

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmAddBuyerInfoOld
	public function actionHandleTradeSmAddBuyerInfoOld() 
	{
		set_time_limit(0);
		
		$command = Yii::app()->db->createCommand();		
		$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer';
//		$file_path = 'E:\buyer_tmp\log';
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);
		Util::write_log($files);	
		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log('is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					break;
				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	
				if (empty($obj['nick']))
					continue;
				try {
					$command->insert('sm_buyer_all', array(
						'nick'=>$obj['nick'],
						'buyer_credit_good_num'=>empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
						'buyer_credit_level'=>empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
						'buyer_credit_score'=>empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
						'buyer_credit_total_num'=>empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
						'vip_info'=>empty($obj['vip_info']) ? '' : $obj['vip_info'],						
						//'vip_info'=>empty($obj['vip_info']) ? 0 : MSmOrderAll::getVipInfoNumber($obj['vip_info']),						
						'sex'=>empty($obj['sex']) ? '' : $obj['sex'],
						//http://a.tbcdn.cn/app/sns/img/default/avatar-120.png
						'avatar'=>empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
						'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
						'last_visit'=>empty($obj['last_visit']) ? '' : $obj['last_visit'],						
						'location_state'=>empty($obj['location']['state']) ? '' : $obj['location']['state'],
						'location_city'=>empty($obj['location']['city']) ? '' : $obj['location']['city'],
						'has_shop'=>empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
						'type'=>empty($obj['type']) ? '' : $obj['type'],
						'is_golden_seller'=>empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
						'is_lightning_consignment'=>empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'], 
						'seller_credit_good_num'=>empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
						'seller_credit_level'=>empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
						'seller_credit_score'=>empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
						'seller_credit_total_num'=>empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
					));					

				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
					continue;			
				}

				$i++;				
				if ($i % 10000 == 10) {
					Util::write_log("i=$i, ".memory_get_usage());				
					break;		
				}
			}
			Util::write_log("i=$i, ".memory_get_usage());	
			fclose($fh);	

			$idx++;
			if ($idx == 1) break;
		}

		Util::write_log('actionHandleTradeSmAddBuyerInfoOld done');	
	}


	public function actionHandleTradeSmUpdateBuyerInfo() 
	{
		set_time_limit(0);
		
		$command = Yii::app()->db->createCommand();		

		$files=CFileHelper::findFiles(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer',array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);		
		Util::write_log($files);	
		
		$idx = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log('is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");					
			$fh = fopen($file, "r");
			$i = 0;
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					break;
				$obj = json_decode($line, true);				
				Util::write_log(print_r($obj,true));	
				if (empty($obj['nick']))
					continue;
				try {

					$row = Yii::app()->db->createCommand("SELECT nick,last_visit FROM sm_buyer_all WHERE nick=:nick")->queryRow(true, array(':nick'=>$obj['nick']));		
					if ($row === false || empty($obj['last_visit']))
					{
						$command->insert('sm_buyer_all', array(
							'nick'=>$obj['nick'],
							'buyer_credit_good_num'=>empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
							'buyer_credit_level'=>empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
							'buyer_credit_score'=>empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
							'buyer_credit_total_num'=>empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
							'vip_info'=>empty($obj['vip_info']) ? '' : $obj['vip_info'],						
							//'vip_info'=>empty($obj['vip_info']) ? 0 : MSmOrderAll::getVipInfoNumber($obj['vip_info']),						
							'sex'=>empty($obj['sex']) ? '' : $obj['sex'],
							//http://a.tbcdn.cn/app/sns/img/default/avatar-120.png
							'avatar'=>empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
							'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
							'last_visit'=>empty($obj['last_visit']) ? '' : $obj['last_visit'],						
							'location_state'=>empty($obj['location']['state']) ? '' : $obj['location']['state'],
							'location_city'=>empty($obj['location']['city']) ? '' : $obj['location']['city'],
							'has_shop'=>empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
							'type'=>empty($obj['type']) ? '' : $obj['type'],
							'is_golden_seller'=>empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
							'is_lightning_consignment'=>empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'], 
							'seller_credit_good_num'=>empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
							'seller_credit_level'=>empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
							'seller_credit_score'=>empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
							'seller_credit_total_num'=>empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
						));	
					}
					else if ( $obj['last_visit'] > $row['last_visit'])
					{
						$command->update('sm_buyer_all', array(
							'buyer_credit_good_num'=>empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
							'buyer_credit_level'=>empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
							'buyer_credit_score'=>empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
							'buyer_credit_total_num'=>empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
							'vip_info'=>empty($obj['vip_info']) ? '' : $obj['vip_info'],						
							//'vip_info'=>empty($obj['vip_info']) ? 0 : MSmOrderAll::getVipInfoNumber($obj['vip_info']),						
							'sex'=>empty($obj['sex']) ? '' : $obj['sex'],
							//http://a.tbcdn.cn/app/sns/img/default/avatar-120.png
							'avatar'=>empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
							'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
							'last_visit'=>empty($obj['last_visit']) ? '' : $obj['last_visit'],						
							'location_state'=>empty($obj['location']['state']) ? '' : $obj['location']['state'],
							'location_city'=>empty($obj['location']['city']) ? '' : $obj['location']['city'],
							'has_shop'=>empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
							'type'=>empty($obj['type']) ? '' : $obj['type'],
							'is_golden_seller'=>empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
							'is_lightning_consignment'=>empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'], 
							'seller_credit_good_num'=>empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
							'seller_credit_level'=>empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
							'seller_credit_score'=>empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
							'seller_credit_total_num'=>empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
							),
							'nick=:nick', array(':nick'=>$obj['nick'])
						);	
					
					}
				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
					continue;			
				}

				$i++;				
				if ($i % 2000 == 10) {
					Util::write_log("i=$i, ".memory_get_usage());				
					break;		
				}
			}
			Util::write_log("i=$i, ".memory_get_usage());	
			fclose($fh);	

			$idx++;
			if ($idx == 1) break;
		}

		Util::write_log('actionHandleTradeSmUpdateBuyerInfo done');	
	}
	
	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmAddBuyerInfoX
	public function actionHandleTradeSmAddBuyerInfoX() 
	{
		set_time_limit(0);
		
		$command = Yii::app()->db->createCommand();		
		$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer';
		//$file_path = 'E:\buyer_tmp\buyer';
		//$file_path = 'G:\buyer';		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);
		$table = 'sm_buyer_all';		

		
		$dbh = dba_open(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'buyer2.dba', "c", 'gdbm') ;		// db4 for linux
		
		Util::write_log($files);	
		$idx = 0;
		$i = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{		
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$filename = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR."{$table}_".uniqid().".log";
			
			if (stripos(PHP_OS, 'win') !== false)
			{
				$filename = str_replace('\\', '/', $filename);
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' ",$filename, $table);			
			}
			else
			{
				$sql = sprintf("LOAD DATA INFILE '%s' INTO TABLE %s CHARACTER SET utf8 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n' ",$filename, $table);					
			}
			
			$fh = fopen($file, "r");
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					break;
				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	
				if (empty($obj['nick']))
					continue;

									
				$key = $obj['nick'];
				$val = dba_fetch($key, $dbh);
				$cur_last_visit = empty($obj['last_visit']) ? 0 : strtotime($obj['last_visit']);
				if ($val !== false)
				{
					if (strtotime($val) >= $cur_last_visit)
					{
						U::W("$key,{$obj['last_visit']},need not update");
						continue;
					}
					else
					{
						$ret = dba_replace($key, empty($obj['last_visit']) ? '' : $obj['last_visit'], $dbh);	
						U::W("$key,{$obj['last_visit']}, replace");						
					}
				}
				else
				{
					$ret = dba_insert($key, empty($obj['last_visit']) ? '' : $obj['last_visit'], $dbh);
				}
				if ($ret === false)
				{
					U::W("dba_insert/replace  err, $key,{$obj['last_visit']}");
					R();
				}
									
				$item = array(
					$obj['nick'],
					empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
					empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
					empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
					empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
					empty($obj['vip_info']) ? '' : $obj['vip_info'],	
					empty($obj['sex']) ? '' : $obj['sex'],
					empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
					empty($obj['created']) ? '' : substr($obj['created'],0,10),
					empty($obj['last_visit']) ? '' : $obj['last_visit'],	
					empty($obj['location']['state']) ? '' : $obj['location']['state'],
					empty($obj['location']['city']) ? '' : $obj['location']['city'],
					empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
					empty($obj['type']) ? '' : $obj['type'],
					empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
					empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'],
					empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
					empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
					empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
					empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
				);
				$str = implode('","', $item);
				if (stripos(PHP_OS, 'win') !== false)				
					error_log("\"{$str}\"\r\n", 3, $filename);	
				else
					error_log("\"{$str}\"\n", 3, $filename);						

				$i++;				
				if ($i % 10000 == 10) {
					Util::write_log("i=$i");				
					break;		
				}
			}
			fclose($fh);	

			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			unlink($filename);

			//rename ($file, "E:\\buyer_tmp\\buyer_bak\\".basename($file)); 
			//rename ($file, "G:\\buyer_bak\\".basename($file)); 

			$idx++;
			if ($idx >= 1)
				break;
		}
		dba_close($dbh);
		Util::write_log('actionHandleTradeSmAddBuyerInfo done');	
	}


	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb HandleTradeSmUpdateBuyerInfoX
	public function actionHandleTradeSmUpdateBuyerInfoX() 
	{
		set_time_limit(0);
		$dbh = dba_open(Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'buyer.dba', "c", 'gdbm') ;

		$command = Yii::app()->db->createCommand();		
		//$file_path = Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'arc'.DIRECTORY_SEPARATOR.'buyer';
		$file_path = 'G:\buyer';		
		$files=CFileHelper::findFiles($file_path, array(
			'fileTypes'=>array('log'),	
			'level'=>0,				
		));
		rsort($files);
		Util::write_log($files);	
		$table = 'sm_buyer_all';		
		$idx = 0;
		$i = 0;	
		$cnt_file = 0;
		foreach($files as $file)		
		{
			if(CFileHelper::getExtension($file)!=='log') {
				Util::write_log($file.' is not .log');
				continue;
			}
			Util::write_log(date("Y-m-d H:i:s")." $file");	

			$fh = fopen($file, "r");
			while (!feof($fh)) 
			{
				$line = fgets($fh);
				if (empty($line))
					break;
				$obj = json_decode($line, true);				
				//Util::write_log(print_r($obj,true));	
				if (empty($obj['nick']))
					continue;
				try 
				{
					$item = array(
						'nick'=>$obj['nick'],
						'buyer_credit_good_num'=>empty($obj['buyer_credit']['good_num']) ? 0 : $obj['buyer_credit']['good_num'],
						'buyer_credit_level'=>empty($obj['buyer_credit']['level']) ? 0 : $obj['buyer_credit']['level'],
						'buyer_credit_score'=>empty($obj['buyer_credit']['score']) ? 0 : $obj['buyer_credit']['score'],
						'buyer_credit_total_num'=>empty($obj['buyer_credit']['total_num']) ? 0 : $obj['buyer_credit']['total_num'],
						'vip_info'=>empty($obj['vip_info']) ? '' : $obj['vip_info'],						
						'sex'=>empty($obj['sex']) ? '' : $obj['sex'],
						'avatar'=>empty($obj['avatar']) || stripos($obj['avatar'], 'avatar-120.png') !== false ? '' : $obj['avatar'],						
						'created'=>empty($obj['created']) ? '' : substr($obj['created'],0,10),
						'last_visit'=>empty($obj['last_visit']) ? '' : $obj['last_visit'],						
						'location_state'=>empty($obj['location']['state']) ? '' : $obj['location']['state'],
						'location_city'=>empty($obj['location']['city']) ? '' : $obj['location']['city'],
						'has_shop'=>empty($obj['has_shop']) ? '0' : $obj['has_shop'], 
						'type'=>empty($obj['type']) ? '' : $obj['type'],
						'is_golden_seller'=>empty($obj['is_golden_seller']) ? '0' : $obj['is_golden_seller'], 
						'is_lightning_consignment'=>empty($obj['is_lightning_consignment']) ? '0' : $obj['is_lightning_consignment'], 
						'seller_credit_good_num'=>empty($obj['seller_credit']['good_num']) ? 0 : $obj['seller_credit']['good_num'],
						'seller_credit_level'=>empty($obj['seller_credit']['level']) ? 0 : $obj['seller_credit']['level'],
						'seller_credit_score'=>empty($obj['seller_credit']['score']) ? 0 : $obj['seller_credit']['score'],
						'seller_credit_total_num'=>empty($obj['seller_credit']['total_num']) ? 0 : $obj['seller_credit']['total_num'],
					);	
					$key = $obj['nick'];
					$val = dba_fetch($key, $dbh);
					$cur_last_visit = empty($obj['last_visit']) ? 0 : strtotime($obj['last_visit']);
					if ($val !== false)
					{
						if (strtotime($val) >= $cur_last_visit)
						{
							//U::W("$key,{$obj['last_visit']},need not update");
							continue;
						}
						else
						{
							//U::W("$key,{$obj['last_visit']},need replace");
							$ret = dba_replace($key, empty($obj['last_visit']) ? '' : $obj['last_visit'], $dbh);	
							if ($ret === false)
							{
								U::W("dba_replace err, $key, {$obj['last_visit']}");	
								R();
							}							 
							unset($item['nick']);
							$command->update($table, $item, 'nick=:nick', array(':nick'=>$obj['nick']));							
						}
					}
					else
					{
						$ret = dba_insert($key, empty($obj['last_visit']) ? '' : $obj['last_visit'], $dbh);
						if ($ret === false)
						{
							U::W("dba_insert err, $key, {$obj['last_visit']}");	
							R();
						}						
						$command->insert($table, $item);						
					}
					
					$i++;				
					if ($i % 10000 == 1) {
						Util::write_log("i=$i, ");				
//						break;		
					}

				} catch (Exception $e) {
					Util::write_log($e->getCode().":".$e->getMessage());
					continue;			
				}

			}
			fclose($fh);	

			rename ($file, "G:\\buyer_bak\\".basename($file)); 

			$idx++;
			if ($idx >= 100)
				break;			
		}
		dba_close($dbh);
		Util::write_log('actionHandleTradeSmUpdateBuyerInfoX done');	
	}
			$hour =date("G");
			if ($hour > 6 && $hour <9)
			{
				U::W("it is morning, hour=$hour");
				break;
			}


						$val_arr['buyer_credit_good_num'] = $buyer_info['buyer_credit']['good_num'];
						$val_arr['buyer_credit_level'] = $buyer_info['buyer_credit']['level'];
						$val_arr['buyer_credit_score'] = $buyer_info['buyer_credit']['score'];
						$val_arr['buyer_credit_total_num'] = $buyer_info['buyer_credit']['total_num'];
						$val_arr['seller_credit_good_num'] = $buyer_info['seller_credit']['good_num'];
						$val_arr['seller_credit_level'] = $buyer_info['seller_credit']['level'];
						$val_arr['seller_credit_score'] = $buyer_info['seller_credit']['score'];
						$val_arr['seller_credit_total_num'] = $buyer_info['seller_credit']['total_num'];

SELECT seller_nick,x_sm_mob_cat,nick INTO OUTFILE 'a3.txt' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\r\n' FROM sm_seller1 WHERE x_sm_mob_cat = '-1' AND nick!='' limit 10;		

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SplitDbByCid
	public function actionSplitDbByCid() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$db = Yii::app()->db;		
		$table = 'sm_order_all';		
		//$table = 'sm_order_all_test';	
		
		$root_cids = $db->createCommand('SELECT cid from sm_itemcat WHERE parent_cid=0')->queryColumn();
		//U::W($root_cids);
		foreach($root_cids as $cid)
		{
			//Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_{$cid}")->execute();				
			//$cid = 16;
			//$cid = 50013886;
			U::W($cid);		
			$sub_cids = MSmItemCat::model()->getAllSubCids($cid);
			U::W($sub_cids);						
			if (empty($sub_cids))
			{
				U::W("$cid is empty!");
				echo "$cid is empty!";
				continue;
			}
			$sub_cids_str = implode(',', $sub_cids);			
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS sm_{$cid}")->execute();			

			$sql = "CREATE TABLE sm_{$cid} ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM $table WHERE cid IN ($sub_cids_str)";
			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																	
			
			$sql = "DELETE FROM $table WHERE cid IN ($sub_cids_str);";
			$n = Yii::app()->db->createCommand($sql)->execute();			
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																				
		}

		Yii::app()->db->createCommand("OPTIMIZE TABLE $table")->execute();		
		U::W("OPTIMIZE TABLE $table");			
		
		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

	//C:\xampp\php\php.exe C:\htdocs\parsecode\yii\demos\sms\protected\yiic.php hhb SplitDbByTwoLevelCid
	public function actionSplitDbByTwoLevelCid() 
	{
		set_time_limit(0);
		echo __FUNCTION__;
		$time=microtime(true);			
		$n = 0;
		$prefix = 'sm';
		//$parent_cid = 50230002;		//test		
		//$parent_cid = MSmItemCat::CID_NU_ZHUANG;
		//$parent_cid = MSmItemCat::CID_MOB_CHONGZHI;		
		$parent_cid = MSmItemCat::CID_NAN_ZHUANG;				
		$table = "{$prefix}_{$parent_cid}";		
		$root_cids = Yii::app()->db->createCommand("SELECT cid from sm_itemcat WHERE parent_cid=$parent_cid")->queryColumn();
 		U::W($root_cids);
		foreach($root_cids as $cid)
		{
			U::W($cid);				
			$sub_table_name = "{$prefix}_{$cid}";	
			
			$sub_cids = MSmItemCat::model()->getAllSubCids($cid);
			if (empty($sub_cids))
				continue;

			$sub_cids_str = implode(',', $sub_cids);	
			Yii::app()->db->createCommand("DROP TABLE IF EXISTS $sub_table_name")->execute();		

			$sql = "CREATE TABLE $sub_table_name ENGINE=MyISAM DEFAULT CHARSET=utf8 SELECT * FROM $table WHERE cid IN ($sub_cids_str)";
			$n = Yii::app()->db->createCommand($sql)->execute();
			U::W("$sql OK...,n=$n");		
			error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');																	

			//$sql = "DELETE FROM $table WHERE cid IN ($sub_cids_str);";
			//$n = Yii::app()->db->createCommand($sql)->execute();			
			//U::W("$sql OK...,n=$n");		
			//error_log("{$sql}\r\n", 3, Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'sql.log');				
		}

		Yii::app()->db->createCommand()->update('sm_itemcat', array('x_split'=>1), 'cid=:cid', array(':cid'=>$parent_cid));

		//Yii::app()->db->createCommand("OPTIMIZE TABLE $table")->execute();		
		//U::W("OPTIMIZE TABLE $table");			

		echo __FUNCTION__." done (time: ".sprintf('%.3f', microtime(true)-$time)."s)\n";						
	}

		ALTER IGNORE TABLE sm_order_all_shorter_sm 
			DROP buyer_email, 
			DROP buyer_alipay_no, 
			DROP createdx, 
			DROP vip_info, 
			DROP created, 
			DROP receiver_name, 
			DROP receiver_phone,
			DROP x_send_cnt, 
			DROP x_send_time	;

	public function actionImportSmtpAcc($filename)	
	{
		set_time_limit(0);	
		$filename =  Yii::app()->getRuntimePath()."/{$filename}";
		$handle = @fopen($filename, "r");
		if (!$handle)
			die("fopen $filename failed");

		$cnt = 0;
		while (!feof($handle)) 
		{
			$data = fgets($handle);
			$data = trim($data);
			if (empty($data))
				continue;
	    		if (strlen($data) == 0)
				continue;
	    		
//			list($email_full, $password) = explode("|", $data);
			list($email_full, $password) = explode("----", $data);
			list($username, $host) = explode("@", $email_full);
//			list($username,$password,$email_full) = explode("----", $data);
			
			$email_full = trim($email_full);
			$username = trim($username);
			$password = trim($password);			
			$params = array(':email_full' => $email_full);
			$exists = Yii::app()->db->createCommand("select id from ".self::SMTP_ACC_TABLE." where email_full = :email_full")->queryScalar($params);                         
			if($exists) 
			{
				$criteria = new CDbCriteria(array('condition' => 'email_full = :email_full', 'limit' => 1, 'params' => $params));				
				Yii::app()->db->getCommandBuilder()->createUpdateCommand(self::SMTP_ACC_TABLE, array('password'=>$password), $criteria)->execute();
				self::log_smtp("$email_full exist, just update its password");				
			} 
			else 
			{
				$row['email_full'] = $email_full;
				$row['username'] = $username;
				$row['password'] = $password;
				$row['email_cat'] = self::get_email_cat($email_full);
				//$row['seller'] = 'youxiangcheng';
				Yii::app()->db->getCommandBuilder()->createInsertCommand(self::SMTP_ACC_TABLE, $row)->execute();
			}

		}
		fclose($handle);
	}

	
*/

