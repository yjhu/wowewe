<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_suggest;
CREATE TABLE wx_suggest (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    nickname VARCHAR(64) NOT NULL DEFAULT '',
    headimgurl VARCHAR(256) NOT NULL DEFAULT '',    
    detail TEXT NOT NULL DEFAULT '',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MSuggest extends ActiveRecord
{

    public static function tableName()
    {
        return 'wx_suggest';
    }

    public function rules()
    {
        return [      
                //['title', 'filter', 'filter' => 'trim'],
                //['title', 'required'],
                //['title', 'string', 'min' => 2, 'max' => 128],

                ['detail', 'filter', 'filter' => 'trim'],
                ['detail', 'required'],
                ['detail', 'string', 'min' => 2, 'max' => 512],

                [['nickname', 'headimgurl'], 'safe'],
                

                //['mobile', 'filter', 'filter' => 'trim'],
                //['mobile', 'required'],
                //['mobile', 'match', 'pattern' => '/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/' ],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'mobile'=>'手机号',
            'title'=>'吐槽标题',
            'detail'=>'消息内容',
        ];
    }
    
    
}




/*
    title VARCHAR(128) NOT NULL DEFAULT '',
    mobile VARCHAR(16) NOT NULL DEFAULT '',

*/
