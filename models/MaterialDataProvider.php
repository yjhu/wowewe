<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\Connection;
use yii\db\Expression;
use yii\di\Instance;

use app\models\U;

class MaterialDataProvider extends \yii\data\BaseDataProvider
{
    public $key = 'media_id';

    public $type = 'news';      // news, image, vedio, voice

    public $wechat;

    public function init()
    {
    }

    protected function prepareModels()
    {
        $pagination = $this->getPagination();
        if ($pagination === false) {
            throw new InvalidConfigException(' MUST HAS pagination');
        }
        if (empty($this->wechat)) {
            throw new InvalidConfigException('Has no wechat');
        }
        $limit = $offset = 0;
        if ($pagination !== false) {
            $limit = $pagination->getLimit();
            $offset = $pagination->getOffset();
        }
        $arr = $this->wechat->WxGetMaterials($this->type, $offset, $limit);
        //U::W($arr);
        $this->setTotalCount($arr['total_count']);  //item_count
        if ($pagination !== false) {
            $pagination->totalCount = $this->getTotalCount();
        }        
        return $arr['item'];
    }

    protected function prepareKeys($models)
    {
        $keys = [];
        foreach ($models as $model) {
            if (is_string($this->key)) {
                $keys[] = $model[$this->key];
            } else {
                $keys[] = call_user_func($this->key, $model);
            }
        }
        return $keys;
    }

    protected function prepareTotalCount()
    {
        return 0;
    }
}
