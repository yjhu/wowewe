<?php
namespace app\models;

/*
CREATE TABLE wx_user (
    id int(10) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    unionid VARCHAR(32) NOT NULL DEFAULT '',    
    nickname VARCHAR(32) NOT NULL DEFAULT '',    
    sex tinyint(3) unsigned NOT NULL DEFAULT 0,        
    city VARCHAR(32) NOT NULL DEFAULT '',
    country VARCHAR(32) NOT NULL DEFAULT '',
    province VARCHAR(32) NOT NULL DEFAULT '',
    headimgurl VARCHAR(256) NOT NULL DEFAULT '',
    subscribe tinyint(3) unsigned NOT NULL DEFAULT 0,
    subscribe_time int(10) unsigned NOT NULL DEFAULT '0',
    password CHAR(16) NOT NULL DEFAULT '',
    email VARCHAR(32) NOT NULL DEFAULT '',    
    role tinyint(3) NOT NULL DEFAULT 0,
    status int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_time TIMESTAMP NOT NULL DEFAULT 0,
    mobile VARCHAR(64) NOT NULL DEFAULT '',
    msg_time TIMESTAMP NOT NULL DEFAULT 0,    
    msg_cnt int(10) unsigned NOT NULL DEFAULT '0',        
    scene_id int(10) unsigned NOT NULL DEFAULT '0',
    scene_balance int(10) unsigned NOT NULL DEFAULT '0',
    scene_balance_time TIMESTAMP NOT NULL DEFAULT 0,
    scene_level tinyint(3) unsigned NOT NULL DEFAULT 0,
    scene_pid int(10) unsigned NOT NULL DEFAULT '0',
    lat float(10,6) NOT NULL DEFAULT '0.000000',
    lon float(10,6) NOT NULL DEFAULT '0.000000',
    prec float(10,6) NOT NULL DEFAULT '0.000000',
    gid int(10) unsigned NOT NULL DEFAULT '0',
    is_liantongstaff tinyint(3) unsigned NOT NULL DEFAULT 0,
    sign_time TIMESTAMP NOT NULL DEFAULT 0,
    sign_money int(10) unsigned NOT NULL DEFAULT '0',
    user_account_balance int(10) NOT NULL DEFAULT '0',
    user_account_charge_mobile VARCHAR(32) NOT NULL DEFAULT '',
    KEY idx_gh_id_scene_pid(gh_id,scene_pid),
    UNIQUE KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE wx_user ADD user_account_balance int(10) NOT NULL DEFAULT '0';
ALTER TABLE wx_user ADD user_account_charge_mobile VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_user ADD unionid VARCHAR(32) NOT NULL DEFAULT '' after openid;

ALTER TABLE wx_user ADD scene_pid_direct int(10) unsigned NOT NULL DEFAULT '0' after scene_pid;


// role has no use now.

INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('root', 'root', 'root', '1', 9);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', 'admin', 'admin','1', 2);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '1', 'office#1','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '2', 'office#2','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '3', 'office#3','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '4', 'office#4','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '5', 'office#5','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '6', 'office#6','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '7', 'office#7','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '8', 'office#8','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '9', 'office#9','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '10', 'office#10','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '11', 'office#11','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '12', 'office#12','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '13', 'office#13','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '14', 'office#14','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '15', 'office#15','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '16', 'office#16','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '17', 'office#17','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '18', 'office#18','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '19', 'office#19','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '20', 'office#20','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '21', 'office#21','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '22', 'office#22','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '23', 'office#23','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '24', 'office#24','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '74', 'office#74','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '75', 'office#75','1', 1);


ALTER TABLE wx_user ADD is_liantongstaff tinyint(3) unsigned NOT NULL DEFAULT 0;
ALTER TABLE wx_user ADD scene_balance int(10) unsigned NOT NULL DEFAULT '0' after scene_id;
ALTER TABLE wx_user ADD scene_level tinyint(3) unsigned NOT NULL DEFAULT 0 after scene_id;

ALTER TABLE wx_user ADD msg_cnt int(10) unsigned NOT NULL DEFAULT '0' after msg_time;


ALTER TABLE wx_user ADD gid int(10) unsigned NOT NULL DEFAULT '0';
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_1ad98f5481f3', 'admin', 'admin','1', 2);


ALTER TABLE wx_user CHANGE msg_time msg_time TIMESTAMP NOT NULL DEFAULT 0;

ALTER TABLE wx_user ADD scene_balance_time TIMESTAMP NOT NULL DEFAULT 0 after scene_balance;

ALTER TABLE wx_user ADD sign_time TIMESTAMP NOT NULL DEFAULT 0;
ALTER TABLE wx_user ADD sign_money int(10) unsigned NOT NULL DEFAULT '0';

//ALTER TABLE wx_user ADD sign_is_member int(10) unsigned NOT NULL DEFAULT '0' after scene_pid;



*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use app\models\MUserAccount;
use yii\helpers\Url;

class MUser extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 10;
    const STATUS_ACTIVE = 0;

//    const ROLE_NONE = 0;
//    const ROLE_OFFICE = 1;    
//    const ROLE_ADMIN = 2;    
//    const ROLE_ROOT = 9;    

    public $verifyCode;
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
        if (!$insert && isset($changedAttributes['msg_time'])) {
//            U::W(['MUser::afterSave', $insert, $changedAttributes]);
            $messages = WechatMessage::find()->where([
                'reciever_id'   => $this->id,
                'recieve_time' => '0000-00-00 00:00:00',
            ])->all();
            foreach($messages as $message) {
//                $sender = MUser::findOne(['id' => $message->sender_id]);
//                $content = $message->content->content;
//                $content = $sender->nickname . "说：" . PHP_EOL . PHP_EOL . $content; 
                if ($this->sendWechatMessage($message)) {
                    $message->updateAttributes(['recieve_time' => date('Y-m-d H:i:s')]);
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public static function tableName()
    {
        return 'wx_user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($nickname)
    {
        return static::findOne(['nickname' => $nickname, 'status' => static::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::find(['nickname' => $nickname, 'status' => static::STATUS_ACTIVE]);
        return null;
    }

    public function getUsername()
    {
        return $this->nickname;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        //return $this->auth_key;
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        //return Security::validatePassword($password, $this->password_hash);
        return $password === $this->password;
    }

    public function rules()
    {
        return [
            ['nickname', 'filter', 'filter' => 'trim'],
            ['nickname', 'required'],
            ['nickname', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'This email address has already been taken.', 'on' => 'signup'],
            ['email', 'exist', 'message' => 'There is no user with such email.', 'on' => 'requestPasswordResetToken'],

            ['password', 'required'],
            ['password', 'string', 'min' => 1, 'max' => 16],
                                                            
            ['mobile', 'filter', 'filter' => 'trim'],
            ['mobile', 'required'], 
            ['mobile', 'match', 'pattern' => '/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/' ],

//            ['verifyCode', 'required', 'on'=>'bind_mobile'],                        
            ['verifyCode', 'captcha', 'captchaAction'=>'site/smcaptcha', 'on'=>'bind_mobile'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'mobile'=>'手机号',
            'password'=>'密码',
			'nickname'=>'微信昵称',
			'create_time'=>'关注时间',
			'is_liantongstaff'=>'联通员工',
			'scene_id'=>'推广Id',
        ];
    }

    public function getChannel()
    {
        return $this->hasOne(MChannel::className(),  ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }
    
    public static function getBoundWechatFanCount($gh_id, $office_id) {
        return self::find()
                ->join('INNER JOIN', 'wx_openid_bind_mobile', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                ->where([
                    'wx_user.gh_id'     => $gh_id,
                    'wx_user.belongto'  => $office_id,
                    'wx_user.subscribe' => 1,
                ])->count();
    }

    public function isActivedFan()
    {
        if ($this->subscribe == 0)
        {
            U::W('subscribe = 0');
            return false;
        }
        if (time() - strtotime($this->create_time) < 30*24*3600)    
        {
            U::W('interval active time is to short = 0');        
            return false;
        }
        if ($this->msg_cnt < 1)
            return false;            
        return true;            
    }

    public function getWokeYqwd()
    {
        //预期沃点
        if(empty($this->scene_id))
            return 0;
        //$n = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND create_time>:create_time',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT, ':create_time'=>$this->scene_balance_time])->sum('scene_amt');
        $n = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        
        return empty($n) ? 0 : $n;
    }

    public function getWokeKtwd()
    {
        //可提沃点
        if(empty($this->scene_id))
            return 0;
        //$n = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_CONFIRMED])->sum('scene_amt');
        //return empty($n) ? 0 : $n;
        return  $this->scene_balance;   
    }

    public function getWokeYtwd()
    {
        //已提沃点
        if(empty($this->scene_id))
            return 0;
        $n = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt<0',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_TIXIAN_OK])->sum('scene_amt');
        return empty($n) ? 0 : abs($n); 
    }


    public function getWokeYqwdLast7Days()
    {
        //已提沃点
        if(empty($this->scene_id))
            return 0;

        //今天
        $d1 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(create_time)=to_days(now())',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d1==null) $d1=0;
        //昨天
        $d2 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=1',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d2==null) $d2=0;

        $d3 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=2',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d3==null) $d3=0;

        $d4 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=3',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d4==null) $d4=0;

        $d5 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=4',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d5==null) $d5=0;

        $d6 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=5',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d6==null) $d6=0;

        $d7 = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND status=:status AND scene_amt>0 AND to_days(now())-to_days(create_time)=6',[':gh_id'=>$this->gh_id, ':scene_id'=>$this->scene_id, ':status'=>MSceneDetail::STATUS_INIT])->sum('scene_amt');
        if($d7==null) $d7=0;

        $last7days = array($d1, $d2, $d3, $d4, $d5, $d6, $d7);

        U::W("###########$$$$$$$$$$$$$$$$$$$$$$$\n");
        U::W($last7days);
        //return array_values($last7days);
        return empty($last7days) ? 0 : $last7days;
    }

    public function sendWechatMessage($message) {
        if (empty($this->gh_id) || empty($this->openid)) {
            return false;
        }
        
        try {
            if (WechatMessageContent::MSGTYPE_TEXT == $message->content->content_type) {
                \Yii::$app->wx->setGhId($this->gh_id);
                $url = \yii\helpers\Url::to([
                            'wapx/wechat-messaging',
                            'gh_id' => $this->gh_id,
                            'openid' =>  $this->openid,
                            'reciever_id'   => $message->sender->id,
                        ], true);
                $content = $message->sender->nickname . " 说：". PHP_EOL . PHP_EOL;
                $content .= $message->content->content . PHP_EOL . PHP_EOL;
                $content .= "<a href='{$url}'>点这里直接与Ta聊天</a>";
                $arr = Yii::$app->wx->WxMessageCustomSendText($this->openid, $content);
            } else if (WechatMessageContent::MSGTYPE_VOICE == $message->content->content_type) {
                \Yii::$app->wx->setGhId($this->gh_id);
                $url = \yii\helpers\Url::to([
                            'wapx/wechat-messaging',
                            'gh_id' => $this->gh_id,
                            'openid' =>  $this->openid,
                            'reciever_id'   => $message->sender->id,
                        ], true);
                $content = $message->sender->nickname . " 向你喊话".PHP_EOL;
                $content .= "<a href='{$url}'>点这里直接与Ta聊天</a>";
                $arr = Yii::$app->wx->WxMessageCustomSendText($this->openid, $content);
                $media_id = $message->content->content;
                $arr = \Yii::$app->wx->WxMessageCustomSendVoice($this->openid, $media_id);
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
    
    public function sendWxm($content)
    {
        if (empty($this->gh_id) || empty($this->openid))
        {
            U::W(["gh_id or openid is empty", $this->getAttributes(), __METHOD__]);
            return false;
        }
        try
        {
            Yii::$app->wx->setGhId($this->gh_id);
            //$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$this->openid,'msgtype'=>'text', 'text'=>['content'=>$content]]);
            $arr = Yii::$app->wx->WxMessageCustomSendText($this->openid, $content);
        }
        catch (\Exception $e)
        {
            U::W($e->getCode().':'.$e->getMessage());
            return false;
        }
        return true;
    }

    public function getOpenidBindMobiles()
    {
        return $this->hasMany(OpenidBindMobile::className(), ['gh_id'=>'gh_id', 'openid'=>'openid']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Custom::className(), ['mobile'=>'mobile'])
            ->viaTable('wx_openid_bind_mobile', ['gh_id'=>'gh_id', 'openid'=>'openid']);
    }

    public function getMobileStaff()
    {
        return $this->hasOne(MStaff::className(), ['gh_id'=>'gh_id', 'mobile'=>'mobile'])
            ->viaTable('wx_openid_bind_mobile', ['gh_id'=>'gh_id', 'openid'=>'openid']);
    }


    public function getOrders()
    {
        $sql = "select * from ".MOrder::tableName().
               " where gh_id='".$this->gh_id."' and openid='".$this->openid.
                "' and status !=".MOrder::STATUS_DRAFT.
                " and create_time > DATE_SUB(NOW(), INTERVAL 1 month) order by create_time DESC";
               
        return Morder::findBySql($sql)->all();
//        return $this->hasMany(MOrder::className(), ['gh_id'=>'gh_id', 'openid'=>'openid']);
    }
    public function getOrderInfoCount()
    {
        $sql = "select * from ".MOrder::tableName().
               " where gh_id='".$this->gh_id."' and openid='".$this->openid.
                "' and (status =".MOrder::STATUS_SUBMITTED.
                " or status =".MOrder::STATUS_PAID.
                " or status =".MOrder::STATUS_FULFILLED.
                ") and create_time > DATE_SUB(NOW(), INTERVAL 1 month) order by create_time DESC";
               
        return count(Morder::findBySql($sql)->all());
//        return $this->hasMany(MOrder::className(), ['gh_id'=>'gh_id', 'openid'=>'openid']);
    }

    public function newSceneIdForOpenid()
    {
        $staff = new MStaff;
        $staff->gh_id = $this->gh_id;
        $staff->openid = $this->openid;        
        $staff->scene_id = MStaff::newSceneId($this->gh_id);
        $staff->name = $this->nickname;
        $staff->cat = MStaff::SCENE_CAT_FAN;                
        if (!$staff->save(false)) {
            U::W(['error', __METHOD__, $staff]);
        }                    
        return $staff;        
    }

    public function getQrImageUrl()
    {
        $staff = MStaff::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        if (empty($staff)) {
            $staff = $this->newSceneIdForOpenid();
        }
        return $staff->getQrImageUrl();
    }

    public function getBindMobileNumbers()
    {
        $mobiles = [];
        foreach($this->openidBindMobiles as $openidBindMobile) {
            $mobiles[] = $openidBindMobile->mobile;
        }
        return $mobiles;
    }

    public function getBindMobileNumbersStr()
    {
        $mobiles = $this->getBindMobileNumbers();
        return empty($mobiles) ? '' : implode(',', $mobiles);
    }

    public function bindMobileIsInside($tableName='wx_t1')
    {
        foreach($this->openidBindMobiles as $openidBindMobile) {
            if (empty($openidBindMobile->mobile)) {
                continue;
            }
            $command = Yii::$app->db->createCommand("SELECT * FROM $tableName WHERE mobile=:mobile", [':mobile'=>$openidBindMobile->mobile]);
            $row = $command->queryOne();
            if (!empty($row)) {
                return true;
            }                
        }
        return false;
    }
    
    public function getPromotees() {
        $staff = MStaff::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        if (empty($staff)) {
            return NULL;
        }
        return $staff->getPromotees();
    }

    public function getScore()
    {
        $staff = MStaff::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        if (empty($staff)) {
            return 0;
        }
        return $staff->getScore(); 
    }
    
    public function getMemberScore() {
        $staff = MStaff::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        if (empty($staff)) {
            return 0;
        }
        return $staff->getMemberScore();
    }
    
    public function getFans()
    {
//        $staff = MStaff::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
        $staff = $this->staff;
        if (empty($staff)) {
            return [];
        }
        return $staff->getFans(); 
    }

    public function getUserAccountBalanceInfo()
    {
        return Yii::$app->formatter->asCurrency($this->user_account_balance/100);    
    } 
    
    public static function getTotalFans(MOffice $target = null)
    {
        if (null === $target) {
            return self::find()->where(['subscribe' => 1])->count();
        } else {
            return self::find()->where([
                'subscribe' => 1,
                'belongto' => $target->office_id,
            ])->count();
        }
    }
    
    public static function getTotalMembers(MOffice $target = null)
    {
        if (null === $target) {
            return self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
        } else {
            return self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])
                    ->andWhere(['belongto' => $target->office_id])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
            
        }
    }
    
    public static function getTotalOffices() 
    {
        $office_ids = (new \yii\db\Query())->select('belongto')->distinct()->from('wx_user')->where('subscribe=1')->column();
        $office_ids = array_diff($office_ids, array_merge([0, 491], range(25,48)));
        $offices = MOffice::find()->where(['office_id' => $office_ids])->orderBy('title')->all();
        return $offices;
    }
    
    public static function getMemberTimeline($startDate, $endDate, $accumulatedFlag, $targetOfficeId = 0) {
        \Yii::warning(__METHOD__ . '(' .\yii\helpers\Json::encode([$startDate, $endDate, $accumulatedFlag]) .')');
        $results = [];
        $startTimestamp = strtotime($startDate .' 00:00:00');
        $endTimestamp = strtotime($endDate . ' 23:59:59');
        $start = 0;
        $n = 0; 
        $start_fans = 0;
        
        if ($accumulatedFlag) {
            if (0 === $targetOfficeId) {
                $start = self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
                $start_fans = self::find()
                    ->where(['subscribe' => 1])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp])
                    ->count();
            } else {
                $start = self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])
                    ->andWhere(['belongto' => $targetOfficeId])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
                $start_fans = self::find()
                    ->where(['subscribe' => 1])
                    ->andWhere(['belongto' => $targetOfficeId])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp])
                    ->count();
            }
        }

        while ($startTimestamp < $endTimestamp) {
            if ( 0 === $targetOfficeId ) {
                $daySum = self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])                    
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>', 'subscribe_time', $startTimestamp])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp + 24 * 3600])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
                $dayFans = self::find()
                    ->where(['subscribe' => 1])
                    ->andWhere(['>', 'subscribe_time', $startTimestamp])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp + 24 * 3600])
                    ->count();
            } else {
                $daySum = self::find()
                    ->joinWith('openidBindMobiles')
                    ->where(['subscribe' => 1])
                    ->andWhere(['belongto' => $targetOfficeId])
                    ->andWhere(['not', ['wx_openid_bind_mobile.mobile' => null]])
                    ->andWhere(['>', 'subscribe_time', $startTimestamp])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp + 24 * 3600])
                    ->groupBy(['gh_id', 'openid'])
                    ->count();
                $dayFans = self::find()
                    ->where(['subscribe' => 1])
                    ->andWhere(['belongto' => $targetOfficeId])
                    ->andWhere(['>', 'subscribe_time', $startTimestamp])
                    ->andWhere(['<', 'subscribe_time', $startTimestamp + 24 * 3600])
                    ->count();
            }
            if ($accumulatedFlag) {
                $results['data'][] = [$startTimestamp * 1000, $start + $daySum];
                $results['data1'][] = [$startTimestamp * 1000, $start_fans + $dayFans];
            } else {
                $results['data'][] = [$startTimestamp * 1000, $daySum];
                $results['data1'][] = [$startTimestamp * 1000, $dayFans];
            }
            $n += 1;
            $startTimestamp += 24 * 3600;
            if ($accumulatedFlag) {
                $start += $daySum;
                $start_fans += $dayFans;
            }
        }
        $results['length'] = $n;
        return \yii\helpers\Json::encode($results);        
    }

    public function getUserAccounts()
    {
        return $this->hasMany(\app\models\MUserAccount::className(), [
            'gh_id' => 'gh_id',
            'openid' => 'openid',
        ])->orderBy('create_time DESC');
    }

    public function getUserAccountDepositTotal()
    {
        $sql = 'select sum(amount) from wx_user_account where gh_id = :gh_id and openid = :openid and cat = :cat';
        $total = Yii::$app->db->createCommand($sql)
                    ->bindValues([
                        ':gh_id' => $this->gh_id,
                        ':openid' => $this->openid,
                        ':cat' => \app\models\MUserAccount::CAT_DEBIT_FAN,
                      ])
                    ->queryScalar();
        return Yii::$app->formatter->asCurrency($total/100);
    }   

    public function getStaff()
    {
        if (!empty($this->mobileStaff)) 
            return $this->mobileStaff;
        else 
            return $this->hasOne(MStaff::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getSceneStaff()
    {        
        if ($this->scene_pid == 0)
            return null;
        return $this->hasOne(MStaff::className(), ['gh_id' => 'gh_id', 'scene_id' => 'scene_pid']);
    }

    public function getManagers()
    {
        $managers = [];
        foreach ($this->openidBindMobiles as $openidBindMobile) {

            if (!empty($openidBindMobile->custom->customManager->manager)) {
                $managers[] = $openidBindMobile->custom->customManager->manager;
            }
        }
        return $managers;
    }

    public function sendTemplateCharge($amount, $remark = '')
    {
        $amountStr = sprintf("%0.2f", $amount/100);
        $url = Url::to(['wap/hyzx1', 'gh_id'=>$this->gh_id, 'openid'=>$this->openid], true);
        $first = '襄阳联通官方微信平台会员账户';
        if (empty($remark)) {
            $balanceStr = sprintf("%0.2f", $this->user_account_balance/100);
            $remark = "账户充值记账成功！您当前的会员账户余额为:{$balanceStr}";
        }
        $accountType = '微信昵称';
        $account = $this->nickname;
        $msg = Wechat::getTemplateCharge($this->openid, $url, $first, $remark, $accountType, $account, $amountStr, '成功');
        $msg = Wechat::getTemplateCharge(MGh::GH_XIANGYANGUNICOM_OPENID_YJHU, $url, $first, $remark, $accountType, $account, $amountStr, '成功');
        Yii::$app->wx->setGhId($this->gh_id); 
        $arr = Yii::$app->wx->WxTemplateSend($msg);
        return $arr;
    }

    public function sendTemplateDonateMobileBill($mobile, $amount, $remark = '')
    {
        $url = Url::to(['wap/hyzx1', 'gh_id'=>$this->gh_id, 'openid'=>$this->openid], true);
        $amountStr = sprintf("%0.2f", $amount/100);
        $first = '襄阳联通官方微信平台';
        if (empty($remark)) {
            $balanceStr = sprintf("%0.2f", $this->user_account_balance/100);
            $remark = "赠送话费成功！您当前的会员账户余额为:{$balanceStr}";
        }
        $msg = Wechat::getTemplateDonateMobileBill($this->openid, $url, $first, $remark, $mobile, $amountStr); 
        $msg = Wechat::getTemplateDonateMobileBill(MGh::GH_XIANGYANGUNICOM_OPENID_YJHU, $url, $first, $remark, $mobile, $amountStr); 
        Yii::$app->wx->setGhId($this->gh_id); 
        $arr = Yii::$app->wx->WxTemplateSend($msg);
        return $arr;
    }

    public function sendSmAlert($balance)
    {
        $url = '';
        $first = '沃手科技：短信余量不足鸟！！！';
        $remark = "短信余量: {$balance}, 请沃手科技相关人员尽快联系购买短信";
        $msg = Wechat::getTemplateDonateMobileBill($this->openid, $url, $first, $remark, '', '');                
        Yii::$app->wx->setGhId($this->gh_id); 
        $arr = Yii::$app->wx->WxTemplateSend($msg);
        return $arr;
    }
    
        
    public function getBelongTo() {
        if ($this->scene_pid == 0) return 0;
        $staff = MStaff::findOne(['gh_id' => $this->gh_id, 'scene_id' => $this->scene_pid]);
        if (empty($staff))
            return 0;
        if ($staff->cat == MStaff::SCENE_CAT_OFFICE || $staff->cat == MStaff::SCENE_CAT_IN )
            return $staff->office_id;
        $wx_user = $staff->user;
        if (empty($wx_user))
            return 0;
        if ($wx_user->scene_pid == $staff->scene_id)
            return 0;
//        if ($wx_user->belongto)
            return $wx_user->belongto;
//        return $wx_user->getBelongTo();
    }
    
    public function getOutlet() {
        if ($this->belongto === 0) return null;
        $office = MOffice::findOne(['office_id' => $this->belongto]);
        return $office->outlet;
    }
    
    public function getWechatInfo() {
        \Yii::$app->wx->setGhId($this->gh_id);            
        $arr = Yii::$app->wx->WxGetUserInfo($this->openid);                                  
        if ($arr['subscribe'] == 0) {
            $this->updateAttributes(['subscribe' => 0]);              
        } else {
            $this->updateAttributes([
                'nickname' => $arr['nickname'],                     
                'headimgurl' => $arr['headimgurl'], 
                'city' => empty($arr['city']) ? '' : $arr['city'],
                'province' => empty($arr['province']) ? '' : $arr['province'],
                'country' => empty($arr['country']) ? '' : $arr['country'],
                'sex' => empty($arr['sex']) ? '' : $arr['sex'],
                'subscribe' => empty($arr['subscribe']) ? '' : $arr['subscribe'],   
            ]);                   
        }
    }
    
    public static function getValidRecvFans($cat) {
        if (0 === $cat) {
            return self::find()->where(['subscribe' => 1])->andWhere([
                '>', 'msg_time', date('Y-m-d H:i:s', strtotime('-2 days'))
            ])->all();
        } else {
            return self::find()->where(['subscribe' => 1])->andWhere([
                '>', 'msg_time', date('Y-m-d H:i:s', strtotime('-2 days'))
            ])->andWhere([
                'belongto' => $cat
            ])->all();
        }
    }
    
    public function getHeadImgUrl() {
        if (empty($this->headimgurl) || time() - strtotime($this->update_time) > 2 * 24 * 60 * 60) {
            try {
                $this->getWechatInfo();
            } catch (\yii\base\Exception $e) {}
        }
        return $this->headimgurl;
    }
    
    public function getPromoteOutlet() {
        return $this->hasOne(\app\models\ClientOutlet::className(), [
            'original_office_id'    => 'belongto',
        ]);
    }
            
    
}

/*
ALTER TABLE wx_user ADD lat float(10,6) NOT NULL DEFAULT '0.000000', ADD lon float(10,6) NOT NULL DEFAULT '0.000000', ADD prec float(10,6) NOT NULL DEFAULT '0.000000';

DROP TABLE IF EXISTS wx_user;
CREATE TABLE wx_user (
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    nickname VARCHAR(32) NOT NULL DEFAULT '',    
    sex tinyint(3) unsigned NOT NULL DEFAULT 0,        
    city VARCHAR(32) NOT NULL DEFAULT '',
    country VARCHAR(32) NOT NULL DEFAULT '',
    province VARCHAR(32) NOT NULL DEFAULT '',
    headimgurl VARCHAR(256) NOT NULL DEFAULT '',
    subscribe tinyint(3) unsigned NOT NULL DEFAULT 0,
    subscribe_time int(10) unsigned NOT NULL DEFAULT '0',
    password CHAR(16) NOT NULL DEFAULT '',
    email VARCHAR(32) NOT NULL DEFAULT '',    
    role tinyint(3) NOT NULL DEFAULT 0,
    status int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    update_time TIMESTAMP NOT NULL DEFAULT 0,
    mobile VARCHAR(16) NOT NULL DEFAULT '',
    msg_time int(10) unsigned NOT NULL DEFAULT '0',    
    KEY idx_gh_id(gh_id),    
    PRIMARY KEY (openid)    
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'admin', 'admin','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'root', 'root','1', 9);
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_78539d18fdcc', 'o6biBt5yaB7d3i0YTSkgFSAHmpdo','hoya-hehbhehb','1');
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_1ad98f5481f3', 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o','woso-hehbhehb','1');

CREATE TABLE wx_user (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    openid VARCHAR(64) NOT NULL DEFAULT '',    
    nickname VARCHAR(24) NOT NULL DEFAULT '',    
    password CHAR(16) NOT NULL DEFAULT '',
    password_hash CHAR(64) NOT NULL DEFAULT '',    
    password_reset_token CHAR(32) NOT NULL DEFAULT '',    
    email VARCHAR(32) NOT NULL DEFAULT '',    
    auth_key CHAR(32) NOT NULL DEFAULT '',    
    role int(10) unsigned NOT NULL DEFAULT '0',
    status int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP,                
    update_time TIMESTAMP,                
    PRIMARY KEY (id),    
    UNIQUE KEY idx_openid(openid),    
    UNIQUE KEY idx_nickname(nickname)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_user (id,nickname,password) VALUES ('1','hehbhehb','1');

ALTER TABLE wx_user CHANGE mobile mobile VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_user ADD pid int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user ADD office_id int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user CHANGE pid pid VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_user DROP INDEX idx_gh_id;
ALTER TABLE wx_user ADD KEY idx_gh_id_pid(gh_id,pid);
ALTER TABLE wx_user DROP INDEX idx_gh_id_pid;
ALTER TABLE wx_user ADD scene_id int(10) unsigned NOT NULL DEFAULT '0' after msg_time;
ALTER TABLE wx_user CHANGE pid scene_pid int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user ADD KEY idx_gh_id_scene_pid(gh_id,scene_pid);


    public function Release()
    {    
        $gh = MGh::findOne($this->gh_id);        
        $gh->freeSceneId($this->scene_id);
        if ($gh->save(false))
            $this->delete();
    }


// for test
class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $nickname;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'nickname' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'nickname' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public static function findIdentityByAccessToken($token)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    public static function findByUsername($nickname)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['nickname'], $nickname) === 0) {
                return new static($user);
            }
        }
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}

zengkai, xiangyangunicom   openid:    oKgUduJJFo9ocN8qO9k2N5xrKoGE
sungt,                             oKgUduNaK7mfojofz2qnSxa_FTMs
hbhe                            oKgUduNHzUQlGRIDAghiY7ywSeWk

INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'admin', 'admin','1', 2);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'root', 'root','1', 9);
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_78539d18fdcc', 'o6biBt5yaB7d3i0YTSkgFSAHmpdo','hoya-hehbhehb','1');
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_1ad98f5481f3', 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o','woso-hehbhehb','1');

ALTER IGNORE TABLE wx_staff DROP KEY gh_id_idx, ADD UNIQUE KEY idx_gh_id_openid (gh_id,openid);        

    public function getQrImageUrl()
    {
        $gh_id = $this->gh_id;
        if (empty($this->scene_id))
        {
            $gh = MGh::findOne($gh_id);
            $scene_id = $gh->newSceneId();
            $gh->save(false);
            $this->scene_id = $scene_id;
            $this->save(false);
            U::W("new a scene_id=$scene_id");                                
        }
        else
        {
            $scene_id = $this->scene_id;
            U::W("old scene_id=$scene_id");                                                                
        }
        $log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
        U::W($log_file_path);                            
        if (!file_exists($log_file_path))
        {
            $arr = $this->WxgetQRCode($scene_id, true);
            $url = $this->WxGetQRUrl($arr['ticket']);
            Wechat::downloadFile($url, $log_file_path);    
        }
        $qrUrl =  Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg";
        return $qrUrl;
        //$url = Url::to(['wap/aboutqr','name'=>$this->nickname, 'qrurl'=>Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg"],true);        
    }

    public function scenarios()
    {
        return [
            Yii\base\Model::SCENARIO_DEFAULT => ['nickname', 'email', 'password'],
            'signup' => ['nickname', 'email', 'password'],
            'resetPassword' => ['password'],
            'requestPasswordResetToken' => ['email'],
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (($this->isNewRecord || $this->getScenario() === 'resetPassword') && !empty($this->password)) {
                //$this->password_hash = Security::generatePasswordHash($this->password);
            }
            if ($this->isNewRecord) {
                //$this->auth_key = Security::generateRandomKey();
            }
            return true;
        }
        return false;
    }

        public function getScore()
        {
            if ($this->scene_id == 0)
                $count = 0;
            else
                $count = MUser::find()->where(['gh_id'=>$this->gh_id, 'scene_pid' => $this->scene_id, 'subscribe' => 1])->count();                        
            return $count;    
        }
    
        public function getQrImageUrl()
        {
            $gh_id = $this->gh_id;
            if (empty($this->scene_id))
            {
                $newFlag = true;
                $gh = MGh::findOne($gh_id);
                $scene_id = $gh->newSceneId();
                $this->scene_id = $scene_id;
            }
            else
            {
                $newFlag = false;        
                $scene_id = $this->scene_id;
            }
            $log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
            if (!file_exists($log_file_path))
            {
                Yii::$app->wx->setGhId($gh_id);    
                $arr = Yii::$app->wx->WxgetQRCode($scene_id, true);
                $url = Yii::$app->wx->WxGetQRUrl($arr['ticket']);
                Wechat::downloadFile($url, $log_file_path);
            }
            if ($newFlag)
            {
                if ($this->save(false))
                   $gh->save(false);                    
            }        
            $url = Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg";
            //U::W($url);
            return $url;
        }
    
        public function beforeDelete()
        {
            if (parent::beforeDelete()) {
                if (!empty($this->scene_id))
                {
                    $gh = MGh::findOne($this->gh_id);        
                    $gh->freeSceneId($this->scene_id);
                    return $gh->save(false);
                }
                return true;            
            } else {
                return false;
            }
        }
    */
        

