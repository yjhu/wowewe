<?php

/*
DROP TABLE wx_mobile_verify_code;
CREATE TABLE IF NOT EXISTS wx_mobile_verify_code (
  mobile varchar(16) NOT NULL DEFAULT '',
  created date NOT NULL,
  verify_code varchar(10) NOT NULL DEFAULT '',
  ip varchar(16) NOT NULL DEFAULT '',
  KEY idx_mobile_created (mobile,created),
  KEY idx_ip_created (ip,created)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/
namespace app\models;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\HttpException;
use yii\helpers\Json;

use app\models\U;
use app\models\SmCaptcha;

class SmCaptchaAction extends Action
{
    const REFRESH_GET_VAR='refresh';

    const SESSION_VAR_PREFIX='Yii.SmCaptchaAction.';
    
    //public $testLimit = 3;
    public $testLimit = 0;

    public $minLength = 5;

    public $maxLength = 6;

    public $fixedVerifyCode;

    public $tableName = 'wx_mobile_verify_code';

    public $maxPerMobile = 5;    
//    public $maxPerMobile = 300;        
  
    public $maxPerIp = 5000;
//    public $maxPerIp = 5;    
//    public $maxPerIp = 500;    
    
    public $mobile;
    
    public function run()
    {
        if(empty($_GET[SmCaptcha::MOBILE_ATTRIBUTE]))
            throw new HttpException(404,'手机号不能空号!');

        if (!U::mobileIsValid($_GET[SmCaptcha::MOBILE_ATTRIBUTE]))
            throw new HttpException(404,'无效的手机号!');        
            
        $this->mobile = $_GET[SmCaptcha::MOBILE_ATTRIBUTE];
        $verifyCode = $this->getVerifyCode(true);        
        return Json::encode(['code'=>0]);
/*        
        if(isset($_GET[self::REFRESH_GET_VAR]))  // AJAX request for regenerating code
        {
            $code = $this->getVerifyCode(true);
            return Json::encode(array(
                'hash1'=>$this->generateValidationHash($code),
                'hash2'=>$this->generateValidationHash(strtolower($code)),
                'url'=>$this->createUrl($this->controller->getId(),array('v' => uniqid())),
            ));
        }
        else
        {         
            throw new HttpException(404,'Just support ajax!');
        }
*/        
    }

    public function generateValidationHash($code)
    {
        for($h=0,$i=strlen($code)-1;$i>=0;--$i)
            $h+=ord($code[$i]);
        return $h;
    }

    public function getVerifyCode($regenerate=false)
    {
        if($this->fixedVerifyCode !== null)
            return $this->fixedVerifyCode;
        $session = Yii::$app->session;
        $session->open();
        $name = $this->getSessionKey();
        $mobile = $this->mobile;        
        $tableName = $this->tableName;
        if($session[$name] === null || $regenerate)
        {
            $needSendSm = $regenerate ? true : false;
            $session[$name] = $this->generateVerifyCode();
            $session[$name . 'count'] = 1;
            if ($needSendSm)
            {
                if (U::haveProbability(10000))
                {
                    $n = Yii::$app->db->createCommand("DELETE from $tableName where created < DATE_SUB(NOW(), INTERVAL 3 day)")->execute();		
                    U::W("DELETE from $tableName, $n");
                }
                
                U::W("generate a sm verify code, mobile=$mobile, code=".$session[$name]);                
                $sql = "SELECT COUNT(*) FROM $tableName WHERE mobile=:mobile AND created=:created";
                $command = yii::$app->db->createCommand($sql, [':mobile'=>$mobile, ':created'=>date("Y-m-d")]);
                $n= $command->queryScalar();
                if ($n >= $this->maxPerMobile)
                {
                    U::W("n=$n, maxPerMobile={$this->maxPerMobile}, mobile=$mobile, verify_code={$session[$name]}");                        
                    throw new HttpException(404,"今日校验次数满!");    
                }

                $ip = U::getClientIp();
                $sql = "SELECT COUNT(*) FROM $tableName WHERE ip=:ip AND created=:created";
                $command = yii::$app->db->createCommand($sql, [':ip'=>$ip, ':created'=>date("Y-m-d")]);
                $n= $command->queryScalar();
                
                if ($n >= $this->maxPerIp)
                {
                    U::W("n=$n, maxPerIp={$this->maxPerIp}, ip=$ip, verify_code={$session[$name]}");    
                    throw new HttpException(404,"今日校验次数满!!");    
                }

                if (!YII_DEBUG)
                {
                    $s = Yii::$app->sm->S($mobile,  "【沃手科技】短信验证码:{$session[$name]}", '', null, true);
                    if ($s->isSendOk())
                        U::W('Send Sm OK');
                    else
                        U::W('Send Sm err');            
                }
                else
                    U::W('fake to send sm');

                $n = Yii::$app->db->createCommand()->insert($this->tableName, ['mobile'=>$mobile, 'created'=>date("Y-m-d"), 'verify_code'=>$session[$name], 'ip'=>$ip])->execute();
                
            }
            else
            {
                U::W("Session is null, init code=".$session[$name]);
            }
        }
        return $session[$name];
    }

    public function validate($input, $caseSensitive)
    {
        $code = $this->getVerifyCode();
        $valid = $caseSensitive ? ($input === $code) : strcasecmp($input,$code)===0;
        //U::W("$input === $code");   
        $session = Yii::$app->session;
        $session->open();
        $name = $this->getSessionKey() . 'count';
        $session[$name] = $session[$name] + 1;
        if($session[$name] > $this->testLimit && $this->testLimit > 0)
            $this->getVerifyCode(true);
        return $valid;
    }

    protected function generateVerifyCode()
    {
        if($this->minLength < 3)
            $this->minLength = 3;
        if($this->maxLength > 20)
            $this->maxLength = 20;
        if($this->minLength > $this->maxLength)
            $this->maxLength = $this->minLength;
        $length = mt_rand($this->minLength,$this->maxLength);

        //$letters = 'bcdfghjklmnpqrstvwxyz';
        $letters = '1346789';
        $vowels = '025';
        $code = '';
        for($i = 0; $i < $length; ++$i)
        {
            if($i % 2 && mt_rand(0,10) > 2 || !($i % 2) && mt_rand(0,10) > 9)
                $code.=$vowels[mt_rand(0,2)];
            else
                $code.=$letters[mt_rand(0,6)];
        }
        return $code;
    }

    protected function getSessionKey()
    {
        return self::SESSION_VAR_PREFIX.$this->getUniqueId();
    }

}
