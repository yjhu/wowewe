<?php
namespace app\models\utils;

class BrowserHistory 
{
    const KEY_PREFIX = 'BROWSER_HISTORY_';
    
    private static function key($gh_id, $openid) {
        return self::KEY_PREFIX . "gh_id=" . $gh_id . "&openid=" . $openid;
    }
    
    public static function previous($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) return false;        
        if (count($history) < 2) return false;
        $url = $history[count($history) - 2];
        $url .='&pop=1';
        return $url; 
    }
    
    public static function push($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) {
            $history = [];
        }
        \yii\helpers\Url::remember();
        $url = \yii\helpers\Url::previous();
        $history[] = $url;
        \Yii::$app->cache->set($key, $history);
    }
    public static function delete($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        return \Yii::$app->cache->delete($key);
    }
    
    public static function pop($gh_id, $openid, $level = 1) {
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) return false;
        while ($level-- > 0) {
            $ret = array_pop($history);
        }
        if (NULL === $ret) {
            self::delete($gh_id, $openid);
            return false;
        }
        if (!empty(history))
            \Yii::$app->cache->set($key, $history);
        else
            self::delete ($gh_id, $openid);
        
        return $ret;
    }
}
