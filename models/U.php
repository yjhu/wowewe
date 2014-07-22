<?php

namespace app\models;


use Yii;
use yii\base\Exception;

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

	public static function getMobileLuck($mobile)
	{
		$mobile = substr($mobile, -4);  
		$num = (int)$mobile;
		//U::W($num);
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
		$jx_idx = ($num/10) % 81;
		$gx_idx = $num % 9;
		//U::W("jx_idx=$jx_idx, gx_idx=$gx_idx");
		return ['JXDetail'=>$arr_jx[$jx_idx]['JXDetail'],'JX'=>$arr_jx[$jx_idx]['JX'],'GXDetail'=>$arr_gx[$gx_idx]['GXDetail'],'GX'=>$arr_gx[$gx_idx]['GX']];
	}


/*
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
*/

