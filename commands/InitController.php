<?php
namespace app\commands;

class InitController extends \yii\console\Controller 
{
    public function actionGiftboxCategory()
    {
        $giftbox_category = new \app\models\GiftboxCategory;
        $giftbox_category->content = '自拍器';
        $giftbox_category->quantity = 200;
        $giftbox_category->remaining = 0;
        $giftbox_category->save(false);
        
        $giftbox_category = new \app\models\GiftboxCategory;
        $giftbox_category->content = '电影票兑换券';
        $giftbox_category->quantity = 200;
        $giftbox_category->remaining = 0;
        $giftbox_category->save(false);
        
        $giftbox_category = new \app\models\GiftboxCategory;
        $giftbox_category->content = 'U盘';
        $giftbox_category->quantity = 200;
        $giftbox_category->remaining = 0;
        $giftbox_category->save(false);
    }
}

