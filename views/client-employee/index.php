<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\models\ClientOrganization;
use app\models\ClientEmployee;
use app\models\ClientEmployeeSearch;

include('../models/utils/emoji.php');

function echoJsTreeNode(ClientEmployeeSearch $searchModel, ClientOrganization $root) {
    if ($searchModel->organization_id == $root->organization_id) {
        echo "<li data-jstree='{ \"selected\" : true, \"opened\": true }' organization_id=\"". $root->organization_id.'">'. $root->title;
    } else {
        echo "<li organization_id=\"". $root->organization_id.'">'. $root->title;
    }
    if (!empty($root->directSubordinateOrganizations))
        echo '<ul>';
    foreach ($root->directSubordinateOrganizations as $sub) {
        echoJsTreeNode($searchModel, $sub);
    }
    if (!empty($root->directSubordinateOrganizations))
        echo '</ul>';
    echo '</li>';
}

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientEmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '员工管理';
$this->params['breadcrumbs'][] = $this->title;
$employees = $dataProvider->getModels();
?>
<script>
    var target_organization = <?= $searchModel->organization_id ?>;
    var ajax_url = "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>";
    function redirectTo() {
        location.href = '<?= Url::to(['client-employee/index']) ?>' + '&ClientEmployeeSearch[organization_id]=' + target_organization;
    }
    function redirectToSearch(keyword) {
        location.href = '<?= Url::to(['client-employee/index']) ?>' + '&ClientEmployeeSearch[search_keyword]=' + keyword;
    }
</script>
<div class="page-bar" style="background-color: #f1f3fa;">
    <div class='pull-left'>
        <a href="<?= Url::to(['client-employee/create']); ?>" class='btn bg-green'><i class='fa fa-plus'></i>&nbsp;新增员工</a>
    </div>
    <div class="input-group input-medium pull-right">
        <input type="text" id='search-key' class="form-control" placeholder="请输入姓名或电话进行查找">
        <span class="input-group-btn">
        <button type="submit" id='search' class="btn green"><i class="fa fa-search"></i></button>
        </span>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-sitemap"></i>
                        部门
                    </span>
                    <span class="caption-helper">
                        选择部门进行过滤
                    </span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body">
                <div id="organization_tree">
                        <ul>
                            <?php 
                                $root = \app\models\ClientOrganization::findOne(['organization_id' => 1]);                                
                                echoJsTreeNode($searchModel, $root);                               
                            ?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-user"></i>
                        员工列表
                    </span>
                    <span class="caption-helper">
                        第<?= $dataProvider->pagination->page + 1;?>/<?= $dataProvider->pagination->pageCount;?>页，共<?= $dataProvider->getTotalCount(); ?>名员工
                    </span>
                </div>
                <div class="actions">
                    <?php 
                        echo  LinkPager::widget([
                            'pagination' => $dataProvider->pagination,
                        ]);
                    ?>
                </div>
            </div>
            <div class="portlet-body"> 
                <div class="row">
                    <?php foreach ($employees as $employee) { ?>
                    <div class="col-md-6  col-sm-6 col-xs-12">
                        <div class="row employee">
                            <div class="col-md-6">
                                <?php if (!empty($employee->wechat) && !empty($employee->wechat->headImgUrl)) { ?>
                                <img class="avatar" alt="" src="<?= $employee->wechat->headImgUrl; ?>"/>
                                <?php } else { ?>
                                <img class="avatar" alt="" src="/wx/web/images/wxmpres/headimg-blank.png"/>
                                
                                <?php } ?> 
                            </div>
                            <div class="col-md-6">
                                <a href="<?= Url::to(['client-employee/view', 'id' => $employee->employee_id]);?>">
                                    <?= $employee->name; ?> 
                                </a>
                                <span>
                                    <?= implode(',',$employee->mobiles); ?>                                   
                                </span>
                                <div>
                                    <?php
                                        foreach ($employee->organizations as $organization) {
                                            echo $organization->title . ', '.$employee->getOrganizationPosition($organization->organization_id). '<br>';
                                        }
                                        foreach ($employee->outlets as $outlet) {
                                            echo $outlet->title . ', '.$employee->getOutletPosition($outlet->outlet_id). '<br>';
                                        }
                                    ?>
                                    <?php if (!empty($employee->wechat)) { ?>
                                    <i class="fa fa-weixin" style="color:#80d63f;"></i>：<?= emoji_unified_to_html(emoji_softbank_to_unified($employee->wechat->nickname)); ?> <br>
                                    关注时间：<?= $employee->wechat->create_time; //date('Y年m月d日 H:i:s', $employee->wechat->subscribe_time); ?><br>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCssFile( '@web/metronic/theme/assets/global/plugins/jstree/dist/themes/default/style.min.css' );
$this->registerCssFile( '@web/php-emoji/emoji.css' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/jstree/dist/jstree.js' );
$this->registerJsFile( '@web/js/yjhu/client-employee-index.js' );

$this->registerCss('
    .employee {
        padding: 10px;
        background-color: #fafafa;
    }
    
    .employee .avatar {
        height: 128px;
        width: 128px;   
        /**
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
        **/
    }    

    .pagination {
	border-radius: 0;
	margin: 0;
    }
    .pagination > li {
        display: inline-block;
        margin-left: 5px;
    }
    .pagination > li > a, .pagination > li > span,
    .pagination > li:first-child > a, .pagination > li:first-child > span,
    .pagination > li:last-child > a, .pagination > li:last-child > span {
            border-radius: 25px !important;
            border: none;
            color: #868c93;
    }
    .pagination > li > span,
    .pagination > li > span:hover {
            background: #555;
            color: #fff;
    }
    .pagination > li:first-child > a,
    .pagination > li:last-child > a {
            padding: 4px 12px 8px;
    }
    
    ');

