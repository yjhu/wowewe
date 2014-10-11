<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_activity;
CREATE TABLE wx_activity (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	start_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	end_time TIMESTAMP, 
	title VARCHAR(128) NOT NULL DEFAULT '',
	descr VARCHAR(256) NOT NULL DEFAULT '',
	status tinyint(10) unsigned NOT NULL DEFAULT '0',
	iids VARCHAR(256) NOT NULL DEFAULT '',
	KEY idx_gh_id(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MUser;


class MActivity extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_activity';
	}


	public function rules()
	{
		return [
			[['gh_id','start_time','end_time','title','descr','status','iids'], 'safe'],
		];
	}


	public function attributeLabels()
    {
        return [
        	'id' => '活动编号',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'title' => '活动标题',
            'descr' => '描述',
            'status' => '状态',
            'iids' => '参与活动商品IDs列表',
        ];
    }


    static function getStatusOptionName($key=null)
    {
        $arr = array(
            '0' => '无效',
            '1' => '有效',
        );        
        //return $arr;
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }



}

/*


*/
