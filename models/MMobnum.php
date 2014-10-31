<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_mobnum;
CREATE TABLE wx_mobnum (
	num VARCHAR(16) NOT NULL DEFAULT '',
	ychf int(10) unsigned NOT NULL DEFAULT '0',
	zdxf int(10) unsigned NOT NULL DEFAULT '0',
	status int(10) unsigned NOT NULL DEFAULT '0',
	locktime int(10) unsigned NOT NULL DEFAULT '0',		
	num_cat tinyint(1) unsigned NOT NULL DEFAULT '0',	
	is_good tinyint(1) unsigned NOT NULL DEFAULT '0',		
	PRIMARY KEY (num)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

//diy
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200056', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200136', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200165', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200229', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200276', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200310', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200395', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200396', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200581', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200607', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200683', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200753', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200910', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200922', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201302', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201673', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201857', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201877', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201912', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035201922', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202008', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202023', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202051', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202267', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202276', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202329', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202356', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202365', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202371', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202373', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035238384', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035238436', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035238894', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035238944', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035238946', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239149', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239194', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239249', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239394', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239434', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239461', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239484', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239492', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035239564', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035240414', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241461', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241493', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241548', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242084', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242435', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242749', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243054', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243470', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243749', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244127', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244364', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244382', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244394', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244411', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035244465', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245423', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245640', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246046', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246149', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246403', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246410', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246584', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035247417', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035247459', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248134', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248194', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035240039', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035240596', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035240820', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035240859', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241105', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241120', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241276', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241357', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241509', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241670', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241750', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241771', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241772', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241776', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035241911', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242028', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242030', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242210', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242219', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242506', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242713', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242720', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242782', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242882', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035242977', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243006', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243053', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243107', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243185', 0, 0, 0, 0);

//card
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202392', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202511', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202535', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202573', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202619', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202672', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202726', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202731', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202775', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202813', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202903', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202952', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035202976', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203065', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203117', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203132', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203151', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203239', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203252', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203259', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203276', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203283', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203293', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203296', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203351', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203503', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203627', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203735', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203755', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035203795', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248440', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248464', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248472', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248524', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035248542', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249034', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249174', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249284', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249341', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249344', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249435', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249449', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249467', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249482', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249492', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249594', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249846', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035249949', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042781664', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042805426', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042824416', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830046', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830047', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830224', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830464', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830546', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830641', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830643', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830774', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042830994', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042831042', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042831241', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042831248', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042831413', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042831478', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832040', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832241', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832304', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832400', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832433', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13042832434', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243235', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243353', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243539', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243713', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243771', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243796', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035243987', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245003', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245033', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245125', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245191', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245226', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245262', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245313', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245393', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245536', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245602', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245658', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245720', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245736', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245802', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245811', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035245831', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246016', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246135', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246139', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246208', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246237', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13035246303', 0, 0, 1, 0);

----------

INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('15571195017', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('15571195031', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('15571195077', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('15571195091', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249882', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249893', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249902', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249917', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249920', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13207249921', 0, 0, 1, 0);


//mobile
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat, is_good) VALUES ('13088888888', 820000, 8000, 2, 0);
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MItem;

class MMobnum extends ActiveRecord
{
	const STATUS_UNUSED = 0;
	const STATUS_LOCKED = 1;
	const STATUS_USED = 2;

	const NUM_CAT_DIY = 0;
	const NUM_CAT_CARD = 1;
	const NUM_CAT_MOBILE = 2;
	
	public static function tableName()
	{
		return 'wx_mobnum';
	}

	public static function getNumCat($cid)
	{
		if ($cid == MItem::ITEM_CAT_DIY)
			return self::NUM_CAT_DIY;
		else if ($cid == MItem::ITEM_CAT_CARD_WO || $cid == MItem::ITEM_CAT_CARD_XIAOYUAN)
			return self::NUM_CAT_CARD;
		else
			return self::NUM_CAT_MOBILE;			// mobile and lianghao
	}

}

/*
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205015', 100000, 1000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205017', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205018', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205019', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205020', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205021', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205022', 200000, 2000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205023', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205025', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205026', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205027', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205028', 300000, 3000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205029', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205030', 0, 0, 1, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205031', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205032', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205033', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205035', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205036', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205037', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205038', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205039', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205053', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205056', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205058', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205059', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205060', 800000, 8000, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205061', 810000, 8000, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205062', 820000, 8000, 0, 2);

18696205015
18696205016
18696205017
18696205018
18696205019
18696205020
18696205021
18696205022
18696205023
18696205025
18696205026
18696205027
18696205028
18696205029
18696205030
18696205031
18696205032
18696205033
18696205035
18696205036
18696205037
18696205038
18696205039
18696205053
18696205056
18696205058
18696205059
18696205060
18696205061
18696205062


*/
