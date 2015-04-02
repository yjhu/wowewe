<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\models\SmCaptcha;
use app\models\U;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */
/* @var $form ActiveForm */
?>


<h1>
测速有礼，活动规则如下:
</h1>

<div class="openid-bind-mobile-index">


<br>
<fieldset style="margin: 0px; padding: 5px; border: 1px solid rgb(0, 187, 236); color: rgb(68, 68, 68); font-family: 微软雅黑; font-size: 13px; line-height: 24px; white-space: normal; border-radius: 5px; background-color: rgb(239, 239, 239);">
    <legend style="margin: 0px 10px; padding: 0px; border-width: 0px;">
        <span class="ue_t" style="margin: 0px; padding: 5px 10px; border: 0px; color: rgb(255, 255, 255); font-weight: bold; font-size: 14px; border-radius: 5px; background-color: rgb(0, 187, 236);">活动时间</span>
    </legend>
    <blockquote style="margin: 0px; padding: 10px; border: 0px;">
        <p class="ue_t" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px;">
<ol>
<li>活动时间：2015年4月1日 - 2015年6月31日</li>
<li>活动内容：关注并注册为襄阳联通微信的会员用户，成功推荐1个好友关注并<a style="color:blue;font-weight:bold" href="<?php echo Url::to(['addbindmobile', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-ajax="false">成为襄阳联通公众号会员</a>即可获得5元话费，若推荐2个好友关注并成为襄阳联通公众号会员，即可得10元话费，以此类推，已关注过好友再次关注视为无效推荐。</li>
<li>活动奖品：默认为5元本地网内通话费，用户也可根据需求选择同等价值的业务，如流量包、手机电视软件。</li>
<li>赠送时长：1月</li>
</ol>
        </p>
    </blockquote>
</fieldset>

<br>

<fieldset style="margin: 0px; padding: 5px; border: 1px solid rgb(0, 187, 236); color: rgb(68, 68, 68); font-family: 微软雅黑; font-size: 13px; line-height: 24px; white-space: normal; border-radius: 5px; background-color: rgb(239, 239, 239);">
    <legend style="margin: 0px 10px; padding: 0px; border-width: 0px;">
        <span class="ue_t" style="margin: 0px; padding: 5px 10px; border: 0px; color: rgb(255, 255, 255); font-weight: bold; font-size: 14px; border-radius: 5px; background-color: rgb(0, 187, 236);">活动要求</span>
    </legend>
    <blockquote style="margin: 0px; padding: 10px; border: 0px;">
        <p class="ue_t" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px;">
        凡参与活动并获奖用户，必须满足以下条件：
<ol>
<li>中奖用户仅限襄阳联通正常在网用户，同一微信账户及手机号码活动期间可持续参加此活动，满足核算标准，即可奖励。</li>
<li>参与活动的用户，活动期间建议不要更改微信账号、不要取消关注，更不要变更手机号码、取消绑定，如取消任一操作将无法获得奖励；</li>
<li>参与微信活动的用户，未绑定手机号码的，需要登记一个襄阳联通手机号码，以便获得奖励。</li>
<!--
<li>所有流量、话费奖励将在次月20日前为客户添加；实物奖励将在次月通知中奖用户，安排用户到指定营业厅领取奖品。</li>
-->
<li>所有流量、话费奖励将在次月20日前为客户添加。</li>
<li>若推荐成功奖励未到账用户，可通过沃服务咨询在线客服。</li>
</ol>
        </p>
    </blockquote>
</fieldset>


</div><!-- mp-openidbindmobile-create -->

<br />
    <p>
		<?php //echo Html::a('我要参与 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
		<?php echo Html::a("我要参与测速", ['heatmap'], ['class' => 'btn btn-success']) ?>
    </p>


