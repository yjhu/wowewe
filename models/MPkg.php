<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_pkg;
CREATE TABLE wx_pkg (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',

	pkg3g4g VARCHAR(16) NOT NULL DEFAULT '',
	monthprice int(10) unsigned NOT NULL DEFAULT '0',
	period int(10) unsigned NOT NULL DEFAULT '0',	
	plan VARCHAR(8) NOT NULL DEFAULT '',
	pkg_price int(10) unsigned NOT NULL DEFAULT '0',
	prom_price int(10) unsigned NOT NULL DEFAULT '0',
	yck int(10) unsigned NOT NULL DEFAULT '0',
	income_return int(10) unsigned NOT NULL DEFAULT '0',
	month_return int(10) unsigned NOT NULL DEFAULT '0',
	
	KEY idx_gh_id_cid(gh_id,cid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#Apple iphone 5s 32G  --- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 12, '', 6299, 4799, 1500, 0, 125);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 12, '', 6299, 4399, 1900, 0, 158);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 12, '', 6299, 3899, 2400, 0, 200);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 12, '', 6299, 2899, 3400, 0, 283);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 24, '', 6299, 3899, 2400, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 24, '', 6299, 2899, 3400, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 24, '', 6299, 1999, 4300, 0, 179);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 24, '', 6299, 99, 6200, 0, 258);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 36, '', 6299, 2999, 3300, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 36, '', 6299, 1499, 4800, 0, 133);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 36, '', 6299, 99, 6200, 0, 172);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 36, '', 6299, 0, 6299, 0, 174);
#-----------------------------------------
#Apple iphone 5s 32G  --- 3G普通套餐

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 12, '', 6299, 4799, 1500, 0, 125);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 12, '', 6299, 4599, 1700, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 12, '', 6299, 4299, 2000, 0, 166);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 12, '', 6299, 3699, 2600, 0, 216);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 12, '', 6299, 2599, 3700, 0, 308);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 12, '', 6299, 999, 5300, 0, 441);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 24, '', 6299, 4399, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 24, '', 6299, 4099, 2200, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 24, '', 6299, 3799, 2500, 0, 104);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 24, '', 6299, 3399, 2900, 0, 120);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 24, '', 6299, 2699, 3600, 0, 150);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 24, '', 6299, 1599, 4700, 0, 195);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 24, '', 6299, 0, 6299, 0, 262);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 24, '', 6299, 0, 6299, 0, 262);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 36, '', 6299, 4199, 2100, 0, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 36, '', 6299, 3299, 3000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 36, '', 6299, 2799, 3500, 0, 97);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 36, '', 6299, 2099, 4200, 0, 116);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 36, '', 6299, 1199, 5100, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 36, '', 6299, 0, 6299, 0, 174);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 36, '', 6299, 0, 6299, 0, 174);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 36, '', 6299, 0, 6299, 0, 174);

#Apple iphone 5c 8G  White--- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 76, 12, '', 3799, 3099, 700, 0, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 106, 12, '', 3799, 2999, 800, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 136, 12, '', 3799, 2799, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 166, 12, '', 3799, 2699, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 169, 12, '', 3799, 2499, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 296, 12, '', 3799, 2099, 1700, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 396, 12, '', 3799, 1599, 2200, 0, 183);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 596, 12, '', 3799, 599, 3200, 0, 266);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 76, 24, '', 3799, 2799, 1000, 0, 41);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 106, 24, '', 3799, 2499, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 136, 24, '', 3799, 2199, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 166, 24, '', 3799, 1899, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 169, 24, '', 3799, 1599, 2200, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 296, 24, '', 3799, 599, 3200, 0, 133);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 396, 24, '', 3799, 0, 3799, 0, 158);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 596, 24, '', 3799, 0, 3799, 0, 158);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 76, 30, '', 3799, 2599, 1200, 0, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 106, 30, '', 3799, 2199, 1600, 0, 53);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 136, 30, '', 3799, 1799, 2000, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 166, 30, '', 3799, 1499, 2300, 0, 76);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 169, 30, '', 3799, 1099, 2700, 0, 90);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 296, 30, '', 3799, 0, 3799, 0, 126);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 396, 30, '', 3799, 0, 3799, 0, 126);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 310, '4g', 596, 30, '', 3799, 0, 3799, 0, 126);

#Apple iphone 5c 8G  Blue --- 4G/3G一体化套餐 -----
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 76, 12, '', 3799, 3099, 700, 0, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 106, 12, '', 3799, 2999, 800, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 136, 12, '', 3799, 2799, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 166, 12, '', 3799, 2699, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 169, 12, '', 3799, 2499, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 296, 12, '', 3799, 2099, 1700, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 396, 12, '', 3799, 1599, 2200, 0, 183);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 596, 12, '', 3799, 599, 3200, 0, 266);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 76, 24, '', 3799, 2799, 1000, 0, 41);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 106, 24, '', 3799, 2499, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 136, 24, '', 3799, 2199, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 166, 24, '', 3799, 1899, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 169, 24, '', 3799, 1599, 2200, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 296, 24, '', 3799, 599, 3200, 0, 133);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 396, 24, '', 3799, 0, 3799, 0, 158);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 596, 24, '', 3799, 0, 3799, 0, 158);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 76, 30, '', 3799, 2599, 1200, 0, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 136, 30, '', 3799, 1799, 2000, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 166, 30, '', 3799, 1499, 2300, 0, 76);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 169, 30, '', 3799, 1099, 2700, 0, 90);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 296, 30, '', 3799, 0, 3799, 0, 126);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 396, 30, '', 3799, 0, 3799, 0, 126);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 311, '4g', 596, 30, '', 3799, 0, 3799, 0, 126);




#三星 7506V --- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 76, 24, '', 3599, 2589, 1010, 101, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 106, 24, '', 3599, 2299, 1300, 130, 48);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 136, 24, '', 3599, 2019, 1580, 158, 59);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 166, 24, '', 3599, 1729, 1870, 187, 70);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 169, 24, '', 3599, 1439, 2160, 216, 81);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 296, 24, '', 3599, 529, 3070, 307, 115);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 396, 24, '', 3599, 0, 3599, 359, 135);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 596, 24, '', 3599, 0, 3599, 359, 135);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 76, 30, '', 3599, 2429, 1170, 117, 35);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 106, 30, '', 3599, 2069, 1530, 153, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 136, 30, '', 3599, 1709, 1890, 189, 56);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 166, 30, '', 3599, 1349, 2250, 225, 67);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 169, 30, '', 3599, 989, 2610, 261, 78);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 296, 30, '', 3599, 0, 3599, 359, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 396, 30, '', 3599, 0, 3599, 359, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '4g', 596, 30, '', 3599, 0, 3599, 359, 108);

#三星 7506V  --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 66, 24, '', 3599, 2589, 1010, 202, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 96, 24, '', 3599, 2299, 1300, 260, 43);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 126, 24, '', 3599, 2019, 1580, 316, 52);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 156, 24, '', 3599, 1729, 1870, 374, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 186, 24, '', 3599, 1439, 2160, 432, 72);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 226, 24, '', 3599, 1059, 2540, 508, 84);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 286, 24, '', 3599, 479, 3120, 624, 104);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 386, 24, '', 3599, 0, 3599, 719, 120);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 586, 24, '', 3599, 0, 3599, 719, 120);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 886, 24, '', 3599, 0, 3599, 719, 120);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 66, 30, '', 3599, 2429, 1170, 234, 31);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 96, 30, '', 3599, 2069, 1530, 306, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 126, 30, '', 3599, 1709, 1890, 378, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 156, 30, '', 3599, 1349, 2250, 450, 60);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 186, 30, '', 3599, 989, 2610, 522, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 226, 30, '', 3599, 509, 3090, 618, 82);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 286, 30, '', 3599, 0, 3599, 719, 96);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 386, 30, '', 3599, 0, 3599, 719, 96);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 586, 30, '', 3599, 0, 3599, 719, 96);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 886, 30, '', 3599, 0, 3599, 719, 96);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 66, 36, '', 3599, 2279, 1320, 264, 29);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 96, 36, '', 3599, 1839, 1760, 352, 39);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 126, 36, '', 3599, 1409, 2190, 438, 48);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 156, 36, '', 3599, 979, 2620, 524, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 186, 36, '', 3599, 549, 3050, 610, 67);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 226, 36, '', 3599, 0, 3599, 719, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 286, 36, '', 3599, 0, 3599, 719, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 386, 36, '', 3599, 0, 3599, 719, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 586, 36, '', 3599, 0, 3599, 719, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 313, '3g', 886, 36, '', 3599, 0, 3599, 719, 80);

##########################################################################################################

#酷派7298A 春雷 白色 --- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 76, 24, '', 999, 189, 810, 81, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 106, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 136, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 166, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 169, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 296, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 396, 24, '', 999, 0, 999, 99, 37);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '4g', 596, 24, '', 999, 0, 999, 99, 37);

#酷派7298A 春雷 白色   --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 66, 24, '', 999, 189, 810, 162, 27);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 96, 24, '', 999,  0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 126, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 156, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 186, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 226, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 286, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 386, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 586, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 314, '3g', 886, 24, '', 999, 0, 999, 199, 33);

#联想A850+  黑色 --- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 76, 24, '', 1199, 229, 970, 97, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 106, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 136, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 166, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 169, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 296, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 396, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '4g', 596, 24, '', 1199, 0, 1199, 119, 45);

#联想A850+  黑色  --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 66, 24, '', 1199, 289, 910, 182, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 96, 24, '', 1199,  0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 126, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 156, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 186, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 226, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 286, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 386, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 586, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 315, '3g', 886, 24, '', 1199, 0, 1199, 239, 40);

#酷派7295C   白色--- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 66, 24, '', 999, 189, 810, 162, 27);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 96, 24, '', 999,  0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 126, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 156, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 186, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 226, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 286, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 316, '3g', 386, 24, '', 999, 0, 999, 199, 33);

#酷派7295C   黑色--- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 66, 24, '', 999, 189, 810, 162, 27);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 96, 24, '', 999,  0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 126, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 156, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 186, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 226, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 286, 24, '', 999, 0, 999, 199, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 324, '3g', 386, 24, '', 999, 0, 999, 199, 33);

#酷派7296    黑色--- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 76, 24, '', 1199, 289, 910, 91, 34);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 106, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 136, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 166, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 169, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 296, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 396, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '4g', 596, 24, '', 1199, 0, 1199, 119, 45);

#酷派7296    白色--- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 76, 24, '', 1199, 289, 910, 91, 34);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 106, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 136, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 166, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 169, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 296, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 396, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '4g', 596, 24, '', 1199, 0, 1199, 119, 45);

#酷派7296    黑色--- --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 66, 24, '', 1199, 289, 910, 182, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 96, 24, '', 1199,  0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 126, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 156, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 186, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 226, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 286, 24, '', 1199, 0, 1199, 239, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 318, '3g', 386, 24, '', 1199, 0, 1199, 239, 33);

#酷派7296    白色--- --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 66, 24, '', 1199, 289, 910, 182, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 96, 24, '', 1199,  0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 126, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 156, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 186, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 226, 24, '', 1199, 0, 1199, 239, 40);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 286, 24, '', 1199, 0, 1199, 239, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 319, '3g', 386, 24, '', 1199, 0, 1199, 239, 33);



#酷派7235   黑色 #########################################################################################
#
#
#
#
##########################################################################################################


#酷派K1   白色--- 4G/3G一体化套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 76, 24, '', 1199, 339, 86, 86, 32);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 106, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 136, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 166, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 169, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 296, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 396, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '4g', 596, 24, '', 1199, 0, 1199, 119, 45);

#酷派K1   白色------ --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 66, 24, '', 1199, 339, 860, 86, 32);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 96, 24, '', 1199,  0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 126, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 156, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 186, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 226, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 286, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 386, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 586, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 320, '3g', 886, 24, '', 1199, 0, 1199, 119, 45);

#酷派7230s   黑色#########################################################################################
#
#
#
#
##########################################################################################################

#海信U939 ------ --- 3G普通套餐
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 66, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 96, 24, '', 799,  0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 126, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 156, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 186, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 226, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 286, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 386, 24, '', 799, 0, 799, 159, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 586, 24, '', 799, 0, 499, 99, 16);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 323, '3g', 886, 24, '', 799, 0, 499, 99, 16);


#双4G双百兆
#魅蓝Note 3G######################################
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 66, 24, '', 1199, 369, 830, 83, 31);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 96, 24, '', 1199, 79, 1120, 112, 42);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 126, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 156, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 186, 24, '', 1199, 0, 1199, 119, 45);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 66, 30, '', 1199, 209, 990, 99, 29);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 96, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 126, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 156, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '3g', 186, 30, '', 1199, 0, 1199, 119, 36);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 66, 24, '', 1199, 369, 830, 83, 31);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 96, 24, '', 1199, 79, 1120, 112, 42);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 126, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 156, 24, '', 1199, 0, 1199, 119, 45);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 186, 24, '', 1199, 0, 1199, 119, 45);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 66, 30, '', 1199, 209, 990, 99, 29);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 96, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 126, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 156, 30, '', 1199, 0, 1199, 119, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 850, '4g', 186, 30, '', 1199, 0, 1199, 119, 36);

#魅族MX4(16G) 3G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 66, 24, '', 1999, 1109, 890, 89, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 96, 24, '', 1999, 819, 1180, 118, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 126, 24, '', 1999, 529, 1470, 147, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 156, 24, '', 1999, 239, 1760, 176, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 186, 24, '', 1999, 0, 1999, 199, 75);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 66, 36, '', 1999, 789, 1210, 121, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 96, 36, '', 1999, 359, 1640, 164, 41);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 126, 36, '', 1999, 0, 1999, 199, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 156, 36, '', 1999, 0, 1999, 199, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '3g', 186, 36, '', 1999, 0, 1999, 199, 50);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 66, 24, '', 1999, 1109, 890, 89, 33);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 96, 24, '', 1999, 819, 1180, 118, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 126, 24, '', 1999, 529, 1470, 147, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 156, 24, '', 1999, 239, 1760, 176, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 186, 24, '', 1999, 0, 1999, 199, 75);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 66, 36, '', 1999, 789, 1210, 121, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 96, 36, '', 1999, 359, 1640, 164, 41);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 126, 36, '', 1999, 0, 1999, 199, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 156, 36, '', 1999, 0, 1999, 199, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 851, '4g', 186, 36, '', 1999, 0, 1999, 199, 50);

#iPhone6 16G 3G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 76, 12, '', 5499, 4599, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 106, 12, '', 5499, 4499, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 136, 12, '', 5499, 4399, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 166, 12, '', 5499, 4199, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 196, 12, '', 5499, 4099, 1400, 0, 116);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 76, 24, '', 5499, 4299, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 106, 24, '', 5499, 3999, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 136, 24, '', 5499, 3699, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 166, 24, '', 5499, 3399, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 196, 24, '', 5499, 3099, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 76, 36, '', 5499, 3899, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 106, 36, '', 5499, 3499, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 136, 36, '', 5499, 3099, 2400, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 166, 36, '', 5499, 2599, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '3g', 196, 36, '', 5499, 2199, 3300, 0, 91);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 76, 12, '', 5499, 4599, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 106, 12, '', 5499, 4499, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 136, 12, '', 5499, 4399, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 166, 12, '', 5499, 4199, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 196, 12, '', 5499, 4099, 1400, 0, 116);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 76, 24, '', 5499, 4299, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 106, 24, '', 5499, 3999, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 136, 24, '', 5499, 3699, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 166, 24, '', 5499, 3399, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 196, 24, '', 5499, 3099, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 76, 36, '', 5499, 3899, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 106, 36, '', 5499, 3499, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 136, 36, '', 5499, 3099, 2400, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 166, 36, '', 5499, 2599, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 852, '4g', 196, 36, '', 5499, 2199, 3300, 0, 91);


#iPhone6+ 16G /iPhone6 64G 3G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 196, 12, '', 6299, 4799, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 196, 24, '', 6299, 3899, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '3g', 196, 36, '', 6299, 2999, 3300, 0, 91);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 196, 12, '', 6299, 4799, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 196, 24, '', 6299, 3899, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 853, '4g', 196, 36, '', 6299, 2999, 3300, 0, 91);

#############################
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 196, 12, '', 6299, 4799, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 196, 24, '', 6299, 3899, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '3g', 196, 36, '', 6299, 2999, 3300, 0, 91);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 196, 12, '', 6299, 4799, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 196, 24, '', 6299, 3899, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 854, '4g', 196, 36, '', 6299, 2999, 3300, 0, 91);


#iPhone6 128G /iPhone6+ 64G 3G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 76, 12, '', 7099, 6199, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 106, 12, '', 7099, 5999, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 136, 12, '', 7099, 5899, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 166, 12, '', 7099, 5799, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 196, 12, '', 7099, 5599, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 76, 24, '', 7099, 5799, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 106, 24, '', 7099, 5499, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 136, 24, '', 7099, 5199, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 166, 24, '', 7099, 4999, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 196, 24, '', 7099, 4699, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 76, 30, '', 7099, 5599, 1500, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 106, 30, '', 7099, 5299, 1800, 0, 60);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 136, 30, '', 7099, 4899, 2200, 0, 73);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 166, 30, '', 7099, 4599, 2500, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '3g', 196, 30, '', 7099, 4199, 2900, 0, 96);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 76, 12, '', 7099, 6199, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 106, 12, '', 7099, 5999, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 136, 12, '', 7099, 5899, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 166, 12, '', 7099, 5799, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 196, 12, '', 7099, 5599, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 76, 24, '', 7099, 5799, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 106, 24, '', 7099, 5499, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 136, 24, '', 7099, 5199, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 166, 24, '', 7099, 4999, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 196, 24, '', 7099, 4699, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 76, 30, '', 7099, 5599, 1500, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 106, 30, '', 7099, 5299, 1800, 0, 60);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 136, 30, '', 7099, 4899, 2200, 0, 73);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 166, 30, '', 7099, 4599, 2500, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 855, '4g', 196, 30, '', 7099, 4199, 2900, 0, 96);

###################
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 76, 12, '', 7099, 6199, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 106, 12, '', 7099, 5999, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 136, 12, '', 7099, 5899, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 166, 12, '', 7099, 5799, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 196, 12, '', 7099, 5599, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 76, 24, '', 7099, 5799, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 106, 24, '', 7099, 5499, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 136, 24, '', 7099, 5199, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 166, 24, '', 7099, 4999, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 196, 24, '', 7099, 4699, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 76, 30, '', 7099, 5599, 1500, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 106, 30, '', 7099, 5299, 1800, 0, 60);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 136, 30, '', 7099, 4899, 2200, 0, 73);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 166, 30, '', 7099, 4599, 2500, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '3g', 196, 30, '', 7099, 4199, 2900, 0, 96);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 76, 12, '', 7099, 6199, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 106, 12, '', 7099, 5999, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 136, 12, '', 7099, 5899, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 166, 12, '', 7099, 5799, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 196, 12, '', 7099, 5599, 1500, 0, 125);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 76, 24, '', 7099, 5799, 1300, 0, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 106, 24, '', 7099, 5499, 1600, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 136, 24, '', 7099, 5199, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 166, 24, '', 7099, 4999, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 196, 24, '', 7099, 4699, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 76, 30, '', 7099, 5599, 1500, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 106, 30, '', 7099, 5299, 1800, 0, 60);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 136, 30, '', 7099, 4899, 2200, 0, 73);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 166, 30, '', 7099, 4599, 2500, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 856, '4g', 196, 30, '', 7099, 4199, 2900, 0, 96);

#中兴V5S
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 66, 24, '', 799, 89, 710, 71, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 96, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 126, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 156, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 186, 24, '', 799, 0, 799, 79, 30);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 66, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 96, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 126, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 156, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '3g', 186, 30, '', 799, 0, 799, 79, 24);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 66, 24, '', 799, 89, 710, 71, 26);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 96, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 126, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 156, 24, '', 799, 0, 799, 79, 30);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 186, 24, '', 799, 0, 799, 79, 30);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 66, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 96, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 126, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 156, 30, '', 799, 0, 799, 79, 24);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 857, '4g', 186, 30, '', 799, 0, 799, 79, 24);


#华为MT7 3G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 76, 24, '', 3199, 2039, 1160, 116, 43);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 106, 24, '', 3199, 1749, 1450, 145, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 136, 24, '', 3199, 1469, 1730, 173, 64);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 166, 24, '', 3199, 1179, 2020, 202, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 196, 24, '', 3199, 889, 2310, 231, 86);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 76, 36, '', 3199, 1729, 1470, 147, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 106, 36, '', 3199, 1289, 1910, 191, 47);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 136, 36, '', 3199, 859, 2340, 234, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 166, 36, '', 3199, 429, 2770, 277, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '3g', 196, 36, '', 3199, 0, 3199, 319, 80);

#4G
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 76, 24, '', 3199, 2039, 1160, 116, 43);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 106, 24, '', 3199, 1749, 1450, 145, 54);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 136, 24, '', 3199, 1469, 1730, 173, 64);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 166, 24, '', 3199, 1179, 2020, 202, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 196, 24, '', 3199, 889, 2310, 231, 86);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 76, 36, '', 3199, 1729, 1470, 147, 36);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 106, 36, '', 3199, 1289, 1910, 191, 47);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 136, 36, '', 3199, 859, 2340, 234, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 166, 36, '', 3199, 429, 2770, 277, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 858, '4g', 196, 36, '', 3199, 0, 3199, 319, 80);


#老用户户专享 参与机型及优惠合约
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 136, 24, '', 2399, 1639, 760, 661, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 166, 24, '', 2399, 1349, 1050, 951, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 196, 24, '', 2399, 1059, 1340, 1241, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 296, 24, '', 2399, 0, 2399, 2300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 396, 24, '', 2399, 0, 2399, 2300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 870, '4g', 596, 24, '', 2399, 0, 2399, 2300, 99);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 136, 24, '', 1999, 1539, 460, 361, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 166, 24, '', 1999, 1249, 750, 651, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 196, 24, '', 1999, 969, 1030, 931, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 296, 24, '', 1999, 0, 1999, 1900, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 396, 24, '', 1999, 0, 1999, 1900, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 871, '4g', 596, 24, '', 1999, 0, 1999, 1900, 99);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 106, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 136, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 166, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 196, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 296, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 396, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 872, '4g', 596, 24, '', 399, 0, 399, 300, 99);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 76, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 106, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 136, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 166, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 196, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 296, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 396, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 873, '4g', 596, 24, '', 399, 0, 399, 300, 99);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 76, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 106, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 136, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 166, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 196, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 296, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 396, 24, '', 399, 0, 399, 300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 874, '4g', 596, 24, '', 399, 0, 399, 300, 99);

//4g手机疯狂直降
//iphone6 16g
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 76, 12, '', 5499, 4599, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 106, 12, '', 5499, 4499, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 136, 12, '', 5499, 4399, 1100, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 166, 12, '', 5499, 4199, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 196, 12, '', 5499, 4099, 1400, 0, 116);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 76, 24, '', 5499, 4299, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 106, 24, '', 5499, 3999, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 136, 24, '', 5499, 3699, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 166, 24, '', 5499, 3399, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 196, 24, '', 5499, 3099, 2400, 0, 100);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 76, 36, '', 5499, 3899, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 106, 36, '', 5499, 3499, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 136, 36, '', 5499, 3099, 2400, 0, 66);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 166, 36, '', 5499, 2599, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 861, '4g', 196, 36, '', 5499, 2199, 3300, 0, 91);

//sanxing 9006v
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 136, 24, '', 2399, 1639, 760, 661, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 166, 24, '', 2399, 1349, 1050, 951, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 196, 24, '', 2399, 1059, 1340, 1241, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 296, 24, '', 2399, 0, 2399, 2300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 396, 24, '', 2399, 0, 2399, 2300, 99);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 863, '4g', 596, 24, '', 2399, 0, 2399, 2300, 99);


*/



use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MItem;

class MPkg extends ActiveRecord
{
	//const STATUS_UNUSED = 0;
	
	public static function tableName()
	{
		return 'wx_pkg';
	}

	public static function getVoiceAndFlowValues($k1=null, $k2=null)
	{
		$arr = [
			'46' => [
				'a' => ['50', '150'],
				'b' => ['120', '40'],
				'c' => ['260', '40'],
			],
			'66' => [
				'a' => ['50', '300'],
				'b' => ['200', '60'],
				'c' => ['380', '60'],
			],
			'96' => [
				'a' => ['240', '300'],
				'b' => ['450', '80'],
				'c' => ['550', '80'],
			],
			'126' => [
				'a' => ['320', '400'],
				'b' => ['680', '100'],
			],
			'156' => [
				'a' => ['420', '500'],
				'b' => ['920', '120'],
			],
			'186' => [
				'a' => ['510', '650'],
				'b' => ['1180', '150'],
			],
			'226' => [
				'a' => ['700', '750'],
			],
			'286' => [
				'a' => ['900', '950'],
			],
			'386' => [
				'a' => ['1250', '1300'],
			],
			'586' => [
				'a' => ['1950', '2000'],
			],
			'886' => [
				'a' => ['3000', '3000'],
			],
		];
		if ($k1 === null)
			return $arr;
			
		if ($k2 === null)
			return isset($arr[$k1]) ? $arr[$k1] : null;
			
		return isset($arr[$k1][$k2]) ? $arr[$k1][$k2] : null;
	}

	public function rules()
	{
		return [
			[['cid'], 'integer'],            
			[['pkg3g4g', 'monthprice', 'period', 'plan', 'pkg_price', 'prom_price', 'yck', 'income_return', 'month_return'], 'safe'],
		];
	}

}

/*


*/
