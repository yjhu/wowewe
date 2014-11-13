<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

use kartik\widgets\DatePicker;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '点击分布';
$this->params['breadcrumbs'][] = $this->title;
?>


<ul class="nav nav-tabs">

    <?php $currentDate = date("Y-m-d"); ?>
    <li <?php echo $cur_date == $currentDate ? 'class="active"' : ''; ?>>
    <?php echo Html::a("今天", ['statvisit', 'cur_date'=>$currentDate], []) ?>
    </li>

    <?php $currentDate = date("Y-m-d",strtotime("-1 day")); ?>
    <li <?php echo $cur_date == $currentDate ? 'class="active"' : ''; ?>>
    <?php echo Html::a("昨天", ['statvisit', 'cur_date'=>$currentDate], []) ?>
    </li>

    <?php $currentDate = date("Y-m-d",strtotime("-2 day")); ?>
    <li <?php echo $cur_date == $currentDate ? 'class="active"' : ''; ?>>
    <?php echo Html::a("前天", ['statvisit', 'cur_date'=>$currentDate], []) ?>
    </li>

    <!--
    <//?//php $currentMonth = date("n"); ?>
    <li>
    <//?//php echo Html::a("{$currentMonth}月", ['statvisit', 'month'=>$currentMonth], []) ?>
    </li>

    <//?//php $currentMonth = date("n", strtotime('-1 month', time())); ?>
    <li>
    <//?//php echo Html::a("{$currentMonth}月", ['statvisit', 'month'=>$currentMonth], []) ?>
    </li>

    <//?//php $currentMonth = date("n", strtotime('-2 month', time())); ?>
    <li>
    <//?//php echo Html::a("{$currentMonth}月", ['statvisit', 'month'=>$currentMonth], []) ?>
    </li>
    -->

    <li <?php echo $cur_date == null ? 'class="active"' : ''; ?>>
    <?php echo Html::a("按时间范围成绩排行", ['statvisit'], []) ?>
    </li>
</ul>

    <p>
        <br />

        <?php //echo Html::a('渠道列表', ['channellist'], ['class' => 'btn btn-success']) ?>

        <?php
        
            if(empty($cur_date))
            {
                echo '<label class="control-label">请输入时间范围</label>';
                echo DatePicker::widget([
                    'name' => 'date_start',
                    'value' => $date_start,
                    'options'=>['id'=>'id_date_start'],
                    'type' => DatePicker::TYPE_RANGE,
                    'name2' => 'date_end',
                    'value2' => $date_end,
                    'options2'=>['id'=>'id_date_end'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format'=>'yyyy-mm-dd',
                        'language'=>'zh-CN',
                    ]
                ]);
            }
        ?>
    </p>

<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php //echo Html::a('新增员工', ['staffcreate'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterSelector'=>'#id_date_start, #id_date_end',
//        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			[
//				'label' => '部门编号',
				'attribute' => 'MsgType',
				'headerOptions' => array('style'=>'width:100px;'),	
				'filter'=> false,				
			],
			[
				'attribute' => 'Event',
			],
			[
				'attribute' => 'EventKey',
			],
			[
				'attribute' => 'c',
			],
        ],
    ]); ?>

</div>


<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
//        'themes/grid-light',
    ],
/*
    'options' => [
        'title' => [
            'text' => 'Combination chart',
        ],
        'xAxis' => [
            'categories' => ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums'],
        ],
        'labels' => [
            'items' => [
                [
                    'html' => 'Total fruit consumption',
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Jane',
                'data' => [3, 2, 1, 3, 4],
            ],
            [
                'type' => 'column',
                'name' => 'John',
                'data' => [2, 3, 5, 7, 6],
            ],
            [
                'type' => 'column',
                'name' => 'Joe',
                'data' => [4, 3, 3, 9, 0],
            ],
            [
                'type' => 'spline',
                'name' => 'Average',
                'data' => [3, 2.67, 3, 6.33, 3.33],
                'marker' => [
                    'lineWidth' => 2,
                    'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    'fillColor' => 'white',
                ],
            ],
            [
                'type' => 'pie',
                'name' => 'Total consumption',
                'data' => [
                    [
                        'name' => 'Jane',
                        'y' => 13,
                        'color' => new JsExpression('Highcharts.getOptions().colors[0]'), // Jane's color
                    ],
                    [
                        'name' => 'John',
                        'y' => 23,
                        'color' => new JsExpression('Highcharts.getOptions().colors[1]'), // John's color
                    ],
                    [
                        'name' => 'Joe',
                        'y' => 19,
                        'color' => new JsExpression('Highcharts.getOptions().colors[2]'), // Joe's color
                    ],
                ],
                'center' => [100, 80],
                'size' => 100,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => false,
                ],
            ],
        ],
    ]
*/

    'options' => [
        'chart' => [
            'plotBackgroundColor' => null,
            'plotBorderWidth' => null,
            'plotShadow' => false
        ],
        'title' => [
            'text' => '点击分布图'
        ],
        'tooltip' => [
            'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
        ],
        'plotOptions' => [
            'pie' => [
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => [
                    'enabled'=> true,
                    'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                    'style'=> [
//                        'color' => (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    ],
                    'connectorColor' => 'silver'
                ]
            ]
        ],
        'series' => [[
            'type' => 'pie',
            'name' => '分布占比',
            'data' => $data
        ]]
    ]
]);
?>

