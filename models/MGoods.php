<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wx_goods".
 *
 * @property integer $goods_id
 * @property string $title
 * @property string $descript
 * @property integer $price
 * @property string $price_hint
 * @property integer $price_old
 * @property string $price_old_hint
 * @property string $detail
 * @property string $list_img_url
 * @property string $body_img_url
 * @property integer $quantity
 * @property integer $office_ctrl
 * @property integer $package_ctrl
 * @property integer $detail_ctrl
 * @property integer $pics_ctrl
 */
class MGoods extends \yii\db\ActiveRecord
{

    public $file;
    public $files;

    const CTRL_NO = 0;
    const CTRL_YES = 1;

    //goods_kind 字段为商品分类，如：特价手机，流量包，老用户专享，活动海报宣传商品（办理）
    const GOODS_KIND_NONE = 0;
    const GOODS_KIND_TJSJ = 1;
    const GOODS_KIND_LYHZX = 2;
    const GOODS_KIND_LLB = 3;
    const GOODS_KIND_HDHB = 4;

    const PHOTO_PATH = 'goods/photo';
    //const THUMB_PATH = 'thumb'; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wx_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['office_ctrl', 'list_img_url', 'body_img_url', 'package_ctrl', 'detail_ctrl', 'pics_ctrl', 'file', 'files'], 'safe'],
            [['goods_kind', 'quantity', 'price', 'price_old'], 'integer'],
            [['detail'], 'string'],
            [['title'], 'string', 'max' => 64],
            [['descript', 'list_img_url', 'body_img_url'], 'string', 'max' => 256],
            [['price_hint', 'price_old_hint'], 'string', 'max' => 512],
            [['file'], 'file'],
            [['files'], 'file', 'maxFiles' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品编号',
            'title' => '商品名',
            'descript' => '描述',
            'price' => '现价',
            'price_hint' => '现价提示语',
            'price_old' => '原价',
            'price_old_hint' => '原价提示语',
            'detail' => '商品详情',
            'list_img_url' => '商品小图',
            'body_img_url' => '商品图',
            'quantity' => '数量',
            'office_ctrl' => '显示营业厅',
            'package_ctrl' => '显示套餐',
            'detail_ctrl' => '显示详情',
            'pics_ctrl' => '显示轮播图',
            'file' => '小图',
            'files' => '大图',
            'goods_kind' => '分类',
        ];
    }

    static function getGoodsKindOption($key=null)
    {
        $arr = array(
            self::GOODS_KIND_NONE => '未分类',
            self::GOODS_KIND_TJSJ => '特价手机',
            self::GOODS_KIND_LYHZX => '老用户专享',
            self::GOODS_KIND_LLB => '流量包',
            self::GOODS_KIND_HDHB => '活动宣传商品',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    } 

    static function getOfficeCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getPackageCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getDetailCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getPicsCtrlOption($key=null)
    {
        $arr = array(
            self::CTRL_YES => '是',
            self::CTRL_NO => '否',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getViewGoodsPics($model)
    {
        $len = 0;
        $imgHtml = "";
        $imgs = explode(";",$model->body_img_url);
        foreach ($imgs as $img) {
            $len++;
            if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
            $imgHtml = $imgHtml . '<img src=' . $img . ' width=160> &nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $imgHtml;
    }
    

}
