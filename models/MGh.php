<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_gh;
CREATE TABLE wx_gh (
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    appid VARCHAR(64) NOT NULL DEFAULT '',
    appsecret VARCHAR(64) NOT NULL DEFAULT '',
    token VARCHAR(32) NOT NULL DEFAULT '',
    partnerid VARCHAR(32) NOT NULL DEFAULT '',
    partnerkey VARCHAR(64) NOT NULL DEFAULT '',
    paysignkey VARCHAR(200) NOT NULL DEFAULT '',
    wxname VARCHAR(32) NOT NULL DEFAULT '',    
    nickname VARCHAR(32) NOT NULL DEFAULT '',
    menu text,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,    
    update_time TIMESTAMP,
    scene_ids text NOT NULL DEFAULT '',
    PRIMARY KEY (gh_id)    
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\U;

class MGh extends ActiveRecord
{
    const GH_WOSO = 'gh_1ad98f5481f3';
    const GH_XIANGYANGUNICOM = 'gh_03a74ac96138';    
    const GH_HOYA = 'gh_78539d18fdcc';

    const GH_XIANGYANGUNICOM_OPENID_HBHE = 'oKgUduNHzUQlGRIDAghiY7ywSeWk';
    const GH_XIANGYANGUNICOM_OPENID_KZENG = 'oKgUduJJFo9ocN8qO9k2N5xrKoGE';
    const GH_XIANGYANGUNICOM_OPENID_GTSUN = 'oKgUduNaK7mfojofz2qnSxa_FTMs';    

    const GH_WOSO_OPENID_HBHE = 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o';
    const GH_WOSO_OPENID_KZENG = 'oSHFKs9_gq4Ve6sHdQ86mJh1U3ZQ';
    

    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
            ],
        ];
    }

    public static function tableName()
    {
        return 'wx_gh';
    }

    public function rules()
    {
        return [
            [['gh_id','wxname','appid','appsecret','token'], 'required'],
            ['token', 'string', 'min' => 8, 'max' => 32],            
            ['gh_id', 'string', 'min' => 8, 'max' => 32],
            [['wxname','appid','appsecret'], 'string', 'max' => 64],
            [['gh_id','wxname','nickname','appid','appsecret','token'], 'filter', 'filter' => 'trim'],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            if ($this->isNewRecord) {
                $this->token = U::generateRandomString(16);
            }
            return true;
        }
        return false;
    }

    public function newSceneId()
    {
        if (empty($this->scene_ids))
        {
            $this->scene_ids = '1';
            return 1;
        }
        $scene_ids = explode(',', $this->scene_ids);
        $i=1;
        while(1)
        {
            if (!in_array($i, $scene_ids))
            {
                $scene_ids[] = $i;    
                $this->scene_ids = implode(',',$scene_ids);
                return $i;
            }
            $i++;
            if ($i>100000)
                break;
        }
        U::W([__METHOD__, 'not find avail scene_id']);            
        return false;
    }

    public function freeSceneId($scene_id)
    {
        if (empty($scene_id))
            return;
        $scene_ids = explode(',', $this->scene_ids);
        foreach($scene_ids as $key=>$val)
        {
            if ($scene_id == $val)
                unset($scene_ids[$key]);
        }
        if (empty($scene_ids))
            $this->scene_ids = '';
        else
            $this->scene_ids = implode(',', $scene_ids);
    }
    
}

/*
wx_url VARCHAR(128) NOT NULL DEFAULT '',
access_token VARCHAR(512) NOT NULL DEFAULT '',

INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_1ad98f5481f3','wx79c2bf0249ede62a','c4d53595acf30e9caf09c155b3d95253','HY09uB1h','1220047701','wosotech20140526huyajun197310070','Yat5dfJA2M8v8kZXH9rDk9q7Ae8dqmxRVApfsoiVxUrhvk8DFipBILgDzNFvVPSBJkZctFbqw0LNhfijqE8R8RLZfW04RGk8MkDXQoDES1Ac84LEtjdAt6hzJTNKG7on','xiangyangwoso','wosotech');
INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_03a74ac96138','wx1b122a21f985ea18','35eda7e6cd9b69f5ffb3c8662f62eb25','HY09uB1h','1220047701','wosotech20140526huyajun197310070','Yat5dfJA2M8v8kZXH9rDk9q7Ae8dqmxRVApfsoiVxUrhvk8DFipBILgDzNFvVPSBJkZctFbqw0LNhfijqE8R8RLZfW04RGk8MkDXQoDES1Ac84LEtjdAt6hzJTNKG7on','xiangyangunicom','xiangyangunicom');
INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_78539d18fdcc','wx4190748b840f102d','a5c3d42268d8b1a470fad26f9808198e','HY09uB1h','1200000000','partnerkey222','paysignkey222','hoyatech-cn','hoyakejiguanhao');

INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_1ad98f5481f3','wx79c2bf0249ede62a','c4d53595acf30e9caf09c155b3d95253','HY09uB1h','1220047701','wosotech20140526huyajun197310070','Yat5dfJA2M8v8kZXH9rDk9q7Ae8dqmxRVApfsoiVxUrhvk8DFipBILgDzNFvVPSBJkZctFbqw0LNhfijqE8R8RLZfW04RGk8MkDXQoDES1Ac84LEtjdAt6hzJTNKG7on','xiangyangwoso','沃手科技');
INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_03a74ac96138','wx1b122a21f985ea18','35eda7e6cd9b69f5ffb3c8662f62eb25','HY09uB1h','','','','xiangyangunicom','襄阳联通');

//INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_78539d18fdcc','wx4190748b840f102d','a5c3d42268d8b1a470fad26f9808198e','HY09uB1h','','','','hoyatech-cn','厚亚科技');
//INSERT INTO wx_gh (gh_id,appid,appsecret,token,partnerid,partnerkey,paysignkey,wxname,nickname) VALUES ('gh_03a74ac96138','wx1b122a21f985ea18','35eda7e6cd9b69f5ffb3c8662f62eb25','HY09uB1h','1220047701','wosotech20140526huyajun197310070','Yat5dfJA2M8v8kZXH9rDk9q7Ae8dqmxRVApfsoiVxUrhvk8DFipBILgDzNFvVPSBJkZctFbqw0LNhfijqE8R8RLZfW04RGk8MkDXQoDES1Ac84LEtjdAt6hzJTNKG7on','xiangyangunicom','襄阳联通');

*/
