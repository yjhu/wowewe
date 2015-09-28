<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\U;

use app\models\MOfficeScoreEvent;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MOfficeScoreEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '渠道优惠券兑换';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = "渠道优惠券兑换";
?>
<div class="moffice-score-event-index">
    <?php

        $office_id = $_GET["office_id"];
        $office = app\models\MOffice::findOne(["office_id" => $office_id ]);
        if(empty($office))
        {
            $office_title = "--";
            $score = 0;
        }
        else
        {
            $office_title = $office->title;
            $score = $office->score;
        }
    ?>

    <h1>【<?= $office_title ?>】 优惠券兑换 </h1>

    <div class="alert alert-warning" role="alert">
        <h1>总积分 <?= $score ?></h1>
                <button type="button" class="btn btn-primary btn-lg" id="dyj30" style="height:80px">30元代金券  &nbsp;&nbsp;&nbsp;(-2000分 )</button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-danger btn-lg" id="dyj100" style="height:80px">100元代金券 (-10000分)</button>
    </div>

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Moffice Score Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'gh_id',
            //'openid',
            //'office_id',
            //'cat',
            'memo',
            'score',
            //'status',
            'create_time',
            'code',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'format' => 'html',
                'value'=>function ($model, $key, $index, $column) 
                { 
                    $flag ="";
                    if($model->status == 1) /**/
                    {
                        $flag = "<span class='glyphicon glyphicon-ok' style='color:green'></span>";
                    }
                    else if($model->status == 2)//failed
                    {
                        $flag = "<span class='glyphicon glyphicon-remove' style='color:red'></span>";
                    }
                    return MOfficeScoreEvent::getOseStatusOption($model->status)." ".$flag; 
                },
                'filter'=> MOfficeScoreEvent::getOseStatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],

            //['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

</div>

<script type="text/javascript">

    $(document).ready(function() {
    
            $('#dyj30').click (function () {

                //alert('confirmAjax');
                var cat =101;
                if (!confirm("确定要兑换吗?"))
                    return;

                var args = {
                    'classname':    '\\app\\models\\MOfficeScoreEvent',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'office_id': '<?= $office_id ?>',
                        'cat': cat,                     
                    }
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            alert("兑换申请已经成功提交！");
                            location.href = '<?= Url::to() ?>';
                        } 
                        else if(1 === ret['code'])
                        {
                            alert("您的积分不足。");
                        }
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


            $('#dyj100').click (function () {

                //alert('confirmAjax');
                var cat =102;
                if (!confirm("确定要兑换吗?"))
                    return;

                var args = {
                    'classname':    '\\app\\models\\MOfficeScoreEvent',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'office_id': '<?= $office_id ?>',
                        'cat': cat,                     
                    }
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            alert("兑换申请已经成功提交！");
                            location.href = '<?= Url::to() ?>';
                        } 
                        else if(1 === ret['code'])
                        {
                            alert("您的积分不足。");
                        }
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


    });
    </script>


