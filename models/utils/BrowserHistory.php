<?php
namespace app\models\utils;

class BrowserHistory 
{
    const KEY_PREFIX = 'BROWSER_HISTORY_';
    
    private static function key($gh_id, $openid) {
        return self::KEY_PREFIX . "gh_id=" . $gh_id . "&openid=" . $openid;
    }
    
    public static function peek($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        return $history = \Yii::$app->cache->get($key);
    }
    
    public static function previous($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) return false;        
        if (count($history) < 2) return false;
        $url = $history[count($history) - 2];
        if (false === strpos($url, '&pop=1'))
                $url .= '&pop=1';
        return $url; 
    }
    
    private static function url_isAlreadyTopOfStack($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) return false;        
        $url = \yii\helpers\Url::to();
        $top_url = $history[count($history) - 1];
        $url = str_replace('&pop=1', '', $url);
        $top_url = str_replace('&pop=1', '', $top_url);
        return (strcasecmp($url, $top_url)== 0);
    }
    
    public static function push($gh_id, $openid) {
        if (self::url_isAlreadyTopOfStack($gh_id, $openid))
            return;
        $key = self::key($gh_id, $openid);
        $history = \Yii::$app->cache->get($key);
        if (false === $history) {
            $history = [];
        }
//        \yii\helpers\Url::remember();
//        $url = \yii\helpers\Url::previous();
        $url = \yii\helpers\Url::to();
        $url = str_replace('&pop=1', '', $url);
        $history[] = $url;
        \Yii::$app->cache->set($key, $history);
    }
    public static function delete($gh_id, $openid) {
        $key = self::key($gh_id, $openid);
        return \Yii::$app->cache->delete($key);
    }
    
    public static function pop($gh_id, $openid, $level = 1) {
        if (self::url_isAlreadyTopOfStack($gh_id, $openid))
            return;
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
        if (!empty($history))
            \Yii::$app->cache->set($key, $history);
        else
            self::delete($gh_id, $openid);
        
        return $ret;
    }
}
