<?php

namespace app\models;


use Yii;
use yii\base\Exception;
use yii\web\HttpException;

class U
{
    public static function toString($obj="")
    {
        if (is_array($obj))
            $str = print_r($obj, true);
        else if(is_object($obj))         
            $str = print_r($obj, true);                        
        else 
            $str = "{$obj}";
        return $str;    
    }    

    public static function W($obj="", $log_file='')
    {
        $str = U::toString($obj);
        if (empty($log_file))
            $log_file = Yii::$app->getRuntimePath().'/errors.log';
            
        $date =date("Y-m-d H:i:s");
        $log_str = sprintf("%s,%s\n",$date,$str);
        error_log($log_str, 3, $log_file);
    }    

    public static function parseQuery($str, $and=';', $eq=':') 
    {
        $arr = array();
        $pairs = explode($and, $str);
        foreach($pairs as $pair) 
        {
            list($name, $value) = explode($eq, $pair, 2);
            $arr[$name] = $value;
        }
        return $arr;
    }

    public static function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        //U::W($url);            
        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if("@" != substr($v, 0, 1))
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&"; 
                }
                else
                {
                    $postMultipart = true;
                }
            }
            //U::W($postBodyString);            
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        else if (!empty($postFields))
        {
            curl_setopt($ch, CURLOPT_POST, true);        
            $postBodyString = $postFields;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postBodyString);
            //U::W($postBodyString);    
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

    public static function generateRandomString($length = 32)
    {
        $chars = 'ABCDEFGHIJKLM
        NOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle(str_repeat($chars, 5)), 0, $length);
    }

    public static function generateRandomStr($length = 16) 
    {  
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
        $str ="";  
        for ($i=0; $i<$length; $i++)
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
        return $str;  
    }

    public static function D($str) 
    {
        U::W($str);
        die($str);    
    }

    public static function getClientIp()
    {
        if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
            $ip = getenv ( "HTTP_CLIENT_IP" );
        else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
            $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
        else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
            $ip = getenv ( "REMOTE_ADDR" );
        else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
            $ip = $_SERVER ['REMOTE_ADDR'];
        else
            $ip = "127.0.0.1";
        return $ip;
    }

/**
   * getRandomWeightedElement()
   * Utility function for getting random values with weighting.
   * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
   * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
   * The return value is the array key, A, B, or C in this case.  Note that the values assigned
   * do not have to be percentages.  The values are simply relative to each other.  If one value
   * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
   * chance of being selected.  Also note that weights should be integers.
   * 
   * @param array $weightedValues
   */
       //U::getRandomWeightedElement(array('AAA'=>5, 'BBB'=>30, 'CCC'=>65));
    public static function getRandomWeightedElement($weightedValues)
    {
        $rand = mt_rand(1, (int) array_sum($weightedValues));
        foreach ($weightedValues as $key => $value) 
        {
            $rand -= $value;
            if ($rand <= 0) 
            {
                return $key;
            }
        }
    }

    public static function array_field_assoc($items, $field1, $field2) 
    {
        $iids = array();    
        foreach ($items as $item) 
            $iids[$item[$field1]] = $item[$field2];
        return ($iids);    
    }

    public static function getSessionParam($key)
    {
        if (isset($_GET[$key]))
            return $_GET[$key];            
        //else if (isset(Yii::$app->session[$key]))
         //   return Yii::$app->session[$key];
        else if (Yii::$app->params['isWin'] && $key == 'gh_id' && Yii::$app->wx->localTest)
        {
            return \app\models\MGh::GH_XIANGYANGUNICOM;
            //return \app\models\MGh::GH_WOSO;
        }
        else if (Yii::$app->params['isWin'] && $key == 'openid' && Yii::$app->wx->localTest)
        {
            //return \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;        
            return \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;        
            //return \app\models\MGh::GH_WOSO_OPENID_HBHE;        
            //return \app\models\MGh::GH_WOSO_OPENID_KZENG;                
        }
        else 
        {
            U::W(["no session data for $key", $_SERVER, $_SESSION]);
            throw new HttpException(500, "session does not exist, key=$key", 9000);
        }
    }

    public static function getWid($gh_id, $openid)
    {
        $wid = Yii::$app->request->get('wid');
        if (empty($wid))
        {
            $wid = Yii::$app->session->get('wid');
            if (empty($wid))
            {
                $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
                $wid = "{$user->scene_id}_0";
            }
        }
        else
        {            
            Yii::$app->session->set('wid', $wid);
        }
        return $wid;
    }
    
    public static function makeDiskResult($type=0)
    {
        if ($type == 0)
        {
            $params = [
                ['name'=>'item 0','value'=>0, 'start'=> 0, 'end'=> 15, 'probability'=> 0.83],
                ['name'=>'item 1','value'=>1, 'start'=>15, 'end'=>30, 'probability'=>7.5],
                ['name'=>'item 2','value'=>2, 'start'=>30, 'end'=>45, 'probability'=>0.83],
                ['name'=>'item 3','value'=>3, 'start'=>45, 'end'=>60, 'probability'=>7.5],
                ['name'=>'item 4','value'=>4, 'start'=>60, 'end'=>75, 'probability'=>0.83],
                ['name'=>'item 5','value'=>5, 'start'=>75, 'end'=>90, 'probability'=>7.5],
                ['name'=>'item 6','value'=>6, 'start'=>90, 'end'=>105, 'probability'=>0.83],
                ['name'=>'item 7','value'=>7, 'start'=>105, 'end'=>120, 'probability'=>7.5],
                ['name'=>'item 8','value'=>8, 'start'=>120, 'end'=>135, 'probability'=>0.83],
                ['name'=>'item 9','value'=>9, 'start'=>135, 'end'=>150, 'probability'=>7.5],
                ['name'=>'item 10','value'=>10, 'start'=>150, 'end'=>165, 'probability'=>0.83],
                ['name'=>'item 11','value'=>11, 'start'=>165, 'end'=>180, 'probability'=>7.5],
                ['name'=>'item 12','value'=>12, 'start'=>180, 'end'=>195, 'probability'=> 0.83],
                ['name'=>'item 13','value'=>13, 'start'=>195, 'end'=>210, 'probability'=>7.5],
                ['name'=>'item 14','value'=>14, 'start'=>210, 'end'=>225, 'probability'=>0.83],
                ['name'=>'item 15','value'=>15, 'start'=>225, 'end'=>240, 'probability'=>7.5],
                ['name'=>'item 16','value'=>16, 'start'=>240, 'end'=>255, 'probability'=>0.83],
                ['name'=>'item 17','value'=>17, 'start'=>255, 'end'=>270, 'probability'=>7.5],
                ['name'=>'item 18','value'=>18, 'start'=>270, 'end'=>285, 'probability'=>0.83],
                ['name'=>'item 19','value'=>19, 'start'=>285, 'end'=>300, 'probability'=>7.5],
                ['name'=>'item 20','value'=>20, 'start'=>300, 'end'=>315, 'probability'=>0.83],
                ['name'=>'item 21','value'=>21, 'start'=>315, 'end'=>300, 'probability'=>7.5],
                ['name'=>'item 22','value'=>22, 'start'=>330, 'end'=>330, 'probability'=>0.87],
                ['name'=>'item 23','value'=>23, 'start'=>345, 'end'=>360, 'probability'=>7.5]
                
            ];
        }
        $par = U::array_field_assoc($params, 'value', 'probability');
        $value = U::getRandomWeightedElement($par);
        
        foreach($params as $key => $param)
        {
            if ($param['value'] == $value)
                break;
        }
        $param['code'] = 0;        
        $param['angle'] = rand($param['start'], $param['end']);
        //U::W($param);
        return $param;
    }

    public static function getMobileLuck($mobile)
    {
        srand($mobile);
        $jx_idx = rand(0,80);
        $gx_idx = rand(0,8);
        //U::W("jx_idx=$jx_idx, gx_idx=$gx_idx");        
        $arr_jx = [
            ['JXDetail'=>'外观昌隆，内隐祸患，克服难关，开出泰运', 'JX'=>'吉带凶'],
            ['JXDetail'=>'事与愿违，终难成功，欲速不达，有始无终', 'JX'=>'凶'],
            ['JXDetail'=>'虽有困难，时来运转，旷野枯草，春来花开', 'JX'=>'吉'],            
            ['JXDetail'=>'半凶半吉，浮沉多端，始凶终吉，能保成功', 'JX'=>'凶带吉'],
            ['JXDetail'=>'遇事猜疑，难望成事，大刀阔斧，始可有成', 'JX'=>'凶'],            
            ['JXDetail'=>'黑暗无光，心迷意乱，出尔反尔，难定方针', 'JX'=>'凶'],
            ['JXDetail'=>'运遮半月，内隐风波，应有谨慎，始保平安', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'烦闷懊恼，事业难展，自防灾祸，始免困境', 'JX'=>'凶'],
            ['JXDetail'=>'万物化育，繁荣之象，专心一意，必能成功', 'JX'=>'吉'],            
            ['JXDetail'=>'见异思迁，十九不成，徒劳无功，不如换号', 'JX'=>'凶'],
            ['JXDetail'=>'吉运自来，能享盛名，把握时机，必获成功', 'JX'=>'吉'],            
            ['JXDetail'=>'黑夜温长，进退维谷，内外不和，信用缺乏', 'JX'=>'凶'],
            ['JXDetail'=>'独营事业，事事如意，功成名就，富贵自来', 'JX'=>'吉'],            
            ['JXDetail'=>'思虑周祥，计书力行，不失先机，可望成功', 'JX'=>'吉'],
            ['JXDetail'=>'动摇不安，常陷逆境，不得时运，难得利润', 'JX'=>'凶'],            
            ['JXDetail'=>'惨淡经营，难免贫困，此数不吉，最好换号', 'JX'=>'凶'],
            ['JXDetail'=>'吉凶参半，惟赖勇气，贯彻力行，始可成功', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'利害混集，凶多吉少，得而复失，难以安顺', 'JX'=>'凶'],
            ['JXDetail'=>'安乐自来，自然吉祥，力行不懈，终必成功', 'JX'=>'吉'],            
            ['JXDetail'=>'利不及费，坐食山空，如无章法，难望成功', 'JX'=>'凶'],
            ['JXDetail'=>'吉中带凶，欲速不达，进不如守，可保安祥', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'此数大凶，破产之象，宜速改名，以避厄运', 'JX'=>'凶'],
            ['JXDetail'=>'先苦后甘，先甜后苦，如能守成，不致失败', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'有得有失，华而不实，须防劫财，始保安顺', 'JX'=>'吉带凶'],
            ['JXDetail'=>'如走夜路，前途无光，希望不大，劳而无功', 'JX'=>'凶'],            
            ['JXDetail'=>'得而复失，枉费心机，守成无贪，可保安稳', 'JX'=>'吉带凶'],
            ['JXDetail'=>'最极之数，还本归元，能得繁荣，发达成功', 'JX'=>'吉'],            
            ['JXDetail'=>'大展鸿图，信用得固，名利双收，可获成功', 'JX'=>'吉'],
            ['JXDetail'=>'根基不固，摇摇欲坠，一盛一衰，劳而无获', 'JX'=>'凶'],            
            ['JXDetail'=>'根深蒂固，蒸蒸日上，如意吉祥，百事顺遂', 'JX'=>'吉'],
            ['JXDetail'=>'前途坎坷，苦难折磨，非有毅力，难望成功', 'JX'=>'凶'],            
            ['JXDetail'=>'阴阳和合，生意兴隆，名利双收，后福重重', 'JX'=>'吉'],
            ['JXDetail'=>'万宝集门，天降幸运，立志奋发，得成大功', 'JX'=>'吉'],            
            ['JXDetail'=>'独营生意，和气吉祥，排除万难，必获成功', 'JX'=>'吉'],
            ['JXDetail'=>'努力发达，贯彻志望，不忘进退，可望成功', 'JX'=>'吉'],            
            ['JXDetail'=>'虽抱奇才，有才无命，独营无力，财力难望', 'JX'=>'凶'],
            ['JXDetail'=>'乌云遮月，暗淡无光，空费心力，徒劳无功', 'JX'=>'凶'],            
            ['JXDetail'=>'草木逢春，枝叶沾露，稳健着实，必得人望', 'JX'=>'吉'],
            ['JXDetail'=>'薄弱无力，孤立无援，外祥内苦，谋事难成', 'JX'=>'凶'],            
            ['JXDetail'=>'天赋吉运，能得人望，善用智慧，必获成功', 'JX'=>'吉'],
            ['JXDetail'=>'忍得若难，必有后福，是成是败，惟靠紧毅', 'JX'=>'凶'],            
            ['JXDetail'=>'谦恭做事，外得人和，大事成就，一门兴隆', 'JX'=>'吉'],
            ['JXDetail'=>'能获众望，成就大业，名利双收，盟主四方', 'JX'=>'吉'],            
            ['JXDetail'=>'排除万难，有贵人助，把握时机，可得成功', 'JX'=>'吉'],
            ['JXDetail'=>'经商做事，顺利昌隆，如能慎始，百事亨通', 'JX'=>'吉'],            
            ['JXDetail'=>'成功虽早，慎防亏空，内外不合，障碍重重', 'JX'=>'凶'],
            ['JXDetail'=>'智商志大，历尽艰难，焦心忧劳，进得两难', 'JX'=>'凶'],            
            ['JXDetail'=>'先历困苦，后得幸福，霜雪梅花，春来怒放', 'JX'=>'吉'],
            ['JXDetail'=>'秋草逢霜，怀才不遇，忧愁怨苦，事不如意', 'JX'=>'凶'],            
            ['JXDetail'=>'旭日升天，名显四方，渐次进展，终成大业', 'JX'=>'吉'],
            ['JXDetail'=>'绵绣前程，须靠自力，多用智谋，能奏大功', 'JX'=>'吉'],            
            ['JXDetail'=>'天时地利，只欠人和，讲信修睦，即可成功', 'JX'=>'吉'],
            ['JXDetail'=>'波澜起伏，千变万化，凌架万难，必可成功', 'JX'=>'凶'],            
            ['JXDetail'=>'一成一败，一盛一衰，惟靠谨慎，可守成功', 'JX'=>'凶带吉'],
            ['JXDetail'=>'鱼临旱地，难逃恶运，此数大凶，不如换号', 'JX'=>'凶'],            
            ['JXDetail'=>'如龙得云，青云直上，智谋奋进，才略奏功', 'JX'=>'吉'],
            ['JXDetail'=>'吉凶参半，得失相伴，投机取巧，吉凶无常', 'JX'=>'凶'],            
            ['JXDetail'=>'此数大吉，名利双收，渐进向上，大业成就', 'JX'=>'吉'],
            ['JXDetail'=>'池中之龙，风云际会，一跃上天，成功可望', 'JX'=>'吉'],            
            ['JXDetail'=>'意气用事，人和必失，如能慎始，必可昌隆', 'JX'=>'吉'],
            ['JXDetail'=>'灾难不绝，难望成功，此数大凶，不如换号', 'JX'=>'凶'],            
            ['JXDetail'=>'中吉之数，进退保守，生意安稳，成就普通', 'JX'=>'吉'],
            ['JXDetail'=>'波澜得叠，常陷穷困，动不如静，有才无命', 'JX'=>'凶'],            
            ['JXDetail'=>'逢凶化吉，吉人天相，风调雨顺，生意兴隆', 'JX'=>'吉'],
            ['JXDetail'=>'名虽可得，利则难获，艺界发展，可望成功', 'JX'=>'凶带吉'],            
            ['JXDetail'=>'云开见月，虽有劳碌，光明坦途，指日可望', 'JX'=>'吉'],
            ['JXDetail'=>'一成一衰，沉浮不定，知难而退，自获天佑', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'天赋吉运，德望兼备，继续努力，前途无限', 'JX'=>'吉'],
            ['JXDetail'=>'事业不专，十九不成，专心进取，可望成功', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'雨夜之花，外祥内苦，忍耐自重，转凶为吉', 'JX'=>'吉带凶'],
            ['JXDetail'=>'虽用心计，事难遂愿，贪功冒进，必招失败', 'JX'=>'凶'],            
            ['JXDetail'=>'杨柳遇春，绿叶发枝，冲破难关，一举成名', 'JX'=>'吉'],
            ['JXDetail'=>'坎坷不平，艰难重重，若无耐心，难望有成', 'JX'=>'凶'],            
            ['JXDetail'=>'有贵人助，可成大业，虽遇不幸，浮沉不定', 'JX'=>'吉'],
            ['JXDetail'=>'美化丰实，鹤立鸡群，名利俱全，繁荣富贵', 'JX'=>'吉'],            
            ['JXDetail'=>'遇吉则吉，遇凶则凶，惟靠谨慎，逢凶化吉', 'JX'=>'凶'],
            ['JXDetail'=>'吉凶互见，一成一败，凶中有吉，吉中有凶', 'JX'=>'吉带凶'],            
            ['JXDetail'=>'一盛一衰，浮沉不常，自重自处，可保平安', 'JX'=>'吉带凶'],
            ['JXDetail'=>'草木逢春，雨过天晴，渡过难关，即获成功', 'JX'=>'吉'],            
            ['JXDetail'=>'盛衰参半，外祥内苦，先吉后凶，先凶后吉', 'JX'=>'吉带凶'],
            ['JXDetail'=>'虽倾全力，难望成功，此数大凶，最好换号', 'JX'=>'凶'],            
        ];
        $arr_gx = [
            ['GXDetail'=>'责任心重，尤其对工作充满热诚，是个彻头彻尾工作狂。但往往因为过分专注职务，而忽略身边的家人及朋友，是个宁要面包不需要爱情的理性主义者', 'GX'=>'要面包不要爱情型'],
            ['GXDetail'=>'在乎身边各人对自己的评价及观感，不善表达个人情感，是个先考虑别人感受，再作出相应配合的内敛一族。对于爱侣，经常存有怀疑之心。', 'GX'=>'不善表达/疑心重型'],
            ['GXDetail'=>'爱好追寻刺激，有不理后果大胆行事的倾向。崇尚自由奔放的恋爱，会拼尽全力爱一场，是就算明知无结果都在所不惜的冲动派。', 'GX'=>'大胆行事冲动派型'],
            ['GXDetail'=>'经常处于戒备状态，对任何事都没法放松处理，孤僻性情难以交朋结友。对于爱情，就更加会慎重处理。任何人必须经过你长期观察及通过连番考验，方会减除戒备与你交往。', 'GX'=>'高度戒备难交心型'],
            ['GXDetail'=>'好奇心极度旺盛，求知欲又强，有打烂沙盘问到笃的锲而不舍精神。此外，你天生有语言天分，学习外文比一般人更易掌握。', 'GX'=>'好奇心旺求知欲强型'],
            ['GXDetail'=>'有特强的第六灵感，性格率直无机心，深得朋辈爱戴。感情路上多采多姿。做事喜好凭个人直觉及预感做决定。', 'GX'=>'做事喜好凭直觉型'],
            ['GXDetail'=>'为人独断独行，事事自行作主解决，鲜有求助他人。而这份独立个性，正正就是吸引异性的特质。但其实心底里，却是渴望有人可让他/她依赖。', 'GX'=>'独断独行/吸引人型'],
            ['GXDetail'=>'对人热情无遮掩，时常梦想可以谈一场戏剧性恋爱，亲身体会个中悲欢离合的动人经历，是个大梦想家。但对于感情却易变卦。', 'GX'=>'热情/善变梦想家型'],
            ['GXDetail'=>'惯于无条件付出，从不祈求有回报，有为了成全他人不惜牺牲自己的情操。但讲到本身的爱情观，却流于被动，往往因为内敛而错过大好姻缘。', 'GX'=>'自我牺牲/性格被动型'],
        ];
        return ['JXDetail'=>$arr_jx[$jx_idx]['JXDetail'],'JX'=>$arr_jx[$jx_idx]['JX'],'GXDetail'=>$arr_gx[$gx_idx]['GXDetail'],'GX'=>$arr_gx[$gx_idx]['GX']];
    }


    // U::getUserHeadimgurl("http://wx.qlogo.cn/mmopen/17ASicSl2de5EHEpImf7IOxZ5w6MibiaWuzsThDo39s0Lq6U0ZG4Kn04AJDfK4XiaxYicCCpsXH3UxW8goFcPnEkfhv7GO2AeFAtR/0", 64);
    public static function getUserHeadimgurl($url, $size)
    {
        if (empty($url))
            return $url;
        if (!in_array($size, [0, 46, 64, 96, 132]))
            return $url;
        $pos = strrpos($url, "/");
        $str = substr($url, 0, $pos) . "/$size";
        return $str;
    }

    public static function mobileIsValid($mobile)
    {    
        $pattern = '/^1\d{10}$/';
        if(preg_match($pattern, $mobile))        
            return true;            
        return false;
    }

    public static function callSimsimi($keyword)
    {
        $params['key'] = "d4677d44-aec1-4045-96c7-d8c521268ace";
        $params['lc'] = "ch";
        $params['ft'] = "1.0";
        $params['text'] = $keyword;
        
        $url = "http://sandbox.api.simsimi.com/request.p?".http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $message = json_decode($output, true);
        $result = "";
        if ($message['result'] == 100){
            $result = $message['response'];
        }else{
            $result = $message['result']."-".$message['msg'];
        }
        return $result;
    }

    public static function getTraceMsg($trace_level)
    {
    	if ($trace_level <= 0)
    		return '';	
    	$msg = "\n";		
    	$traces=debug_backtrace();
    	if(count($traces) >2)
    		$traces=array_slice($traces, 2);
    	if(count($traces) > $trace_level)
    		$traces=array_slice($traces, 0, $trace_level);
    	
    	foreach($traces as $i=>$t)
    	{
    		if(!isset($t['file']))
    			$t['file']='unknown';
    		if(!isset($t['line']))
    			$t['line']=0;
    		if(!isset($t['function']))
    			$t['function']='unknown';
    		$msg.="#$i {$t['file']}({$t['line']}): ";
    		if(isset($t['object']) && is_object($t['object']))
    			$msg.=get_class($t['object']).'->';
    		$msg.="{$t['function']}()\n";
    	}
    	return $msg;
    }

    //10 -> 0.001%
    //10000 -> 1%
    public static function haveProbability($probability=10)
    {
        return mt_rand(0,1000000) < $probability;
    }
    


}

/*
    public static function L($msg, $level=Logger::LEVEL_INFO, $category='application')
    {
        Yii::log(CVarDumper::dumpAsString($msg), $level, $category);
    }

    public static function T($msg, $category='application')
    {
        Yii::trace(CVarDumper::dumpAsString($msg), $category);
    }

            //$probability = 0.5    //        0.1/12*100;

            $params = [
                ['name'=>'item 0','value'=>0, 'start'=> 0, 'end'=> 30, 'probability'=> 50],
                ['name'=>'item 1','value'=>1, 'start'=>30, 'end'=>60, 'probability'=>25],
                ['name'=>'item 2','value'=>2, 'start'=>60, 'end'=>90, 'probability'=>25],
                ['name'=>'item 3','value'=>3, 'start'=>90, 'end'=>120, 'probability'=>0],
                ['name'=>'item 4','value'=>4, 'start'=>120, 'end'=>150, 'probability'=>0],
                ['name'=>'item 5','value'=>5, 'start'=>150, 'end'=>180, 'probability'=>0],
                ['name'=>'item 6','value'=>6, 'start'=>180, 'end'=>210, 'probability'=>0],
                ['name'=>'item 7','value'=>7, 'start'=>210, 'end'=>240, 'probability'=>0],
                ['name'=>'item 8','value'=>8, 'start'=>240, 'end'=>270, 'probability'=>0],
                ['name'=>'item 9','value'=>9, 'start'=>270, 'end'=>300, 'probability'=>0],
                ['name'=>'item 10','value'=>10, 'start'=>300, 'end'=>330, 'probability'=>0],
                ['name'=>'item 11','value'=>11, 'start'=>330, 'end'=>360, 'probability'=>0],
            ];

    public static function getDataForWeixin($appId, $MsgImg, $url, $title, $desc)
    {
        $arr = [
            'appId'=>$appId,
            'MsgImg'=>$MsgImg,
            'TLImg'=>$MsgImg,            
            'url'=>$url,
            'title'=>$title,            
            'desc'=>$desc,
            'fakeid'=>'',
            'prepare' => function ($argv){},
            'callback' => function($res) {},
        ];
        return json_encode($arr);
    }

    public static function getMobileLuck($pn)
    {
        $result = '';

        //$loca = U::curl("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$pn."&output=json");
        //$loca = json_decode($loca, true);    
        //U::W($loca);

        $loca = file_get_contents("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$pn."&output=json&callback=querycallback");
        $loca = substr($loca, 14, -2);  
        $loca = json_decode($loca, true);    
        U::W($loca);

        

        $lucy_msg = file_get_contents("http://jixiong.showji.com/api.aspx?m=".$pn."&output=json&callback=querycallback");
        $lucy_msg = substr($lucy_msg, 14, -2);  
        $lucy_msg = json_decode($lucy_msg, true);    
        U::W($lucy_msg);
        $result .= "<b>vendor</b><br/>";

        return $result;
        
    }
*/

