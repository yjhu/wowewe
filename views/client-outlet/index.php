<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientOutletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use app\models\ClientOrganization;
use app\models\ClientOutletSearch;
use yii\grid\GridView;
use yii\widgets\LinkPager;

function echoJsTreeNode(ClientOutletSearch $searchModel, ClientOrganization $root) {
    if (!$root->isMsc()) return;
    if ($searchModel->msc_id == $root->organization_id) {
        echo "<li data-jstree='{ \"selected\" : true, \"opened\": true }' organization_id=\"". $root->organization_id. "\">". $root->title;
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

$this->title = '渠道管理';
$this->params['breadcrumbs'][] = $this->title;
$outlets = $dataProvider->getModels();
?>
<script>
    var target_msc = <?= $searchModel->msc_id ?>;
    function redirectTo() {
        location.href = '<?= \yii\helpers\Url::to(['client-outlet/index']) ?>' + '&ClientOutletSearch[msc_id]=' + target_msc;
    }
</script>
<div class="row">
    <div class="col-md-3">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-home"></i>
                        营服中心
                    </span>
                    <span class="caption-helper">
                        选择营服中心进行渠道过滤
                    </span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body">
                <div id="msc_tree">
                        <ul>
                            <?php 
                                $root = \app\models\ClientOrganization::findOne(['organization_id' => 1]);
                                if ($searchModel->msc_id == $root->organization_id) {
                                    echo "<li data-jstree='{ \"selected\" : true, \"opened\": true }' organization_id=\"". $root->organization_id. "\">". $root->title;
                                } else {
                                    echo "<li data-jstree='{ \"opened\": true }' organization_id=\"". $root->organization_id. "\">". $root->title;
                                }
                                echo '<ul>';
                                foreach ($root->getDirectSubordinateOrganizations() as $sub) {
                                    echoJsTreeNode($searchModel, $sub);
                                }
                                echo '</ul>';
                                echo '</li>'
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
                        <i class="fa fa-home"></i>
                        渠道列表
                    </span>
                    <span class="caption-helper">
                        第<?= $dataProvider->pagination->page + 1;?>/<?= $dataProvider->pagination->pageCount;?>页，共<?= $dataProvider->getTotalCount(); ?>个渠道
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
                <div class='row product-list'>
                    <?php                         
                        foreach ($outlets as $outlet) {
                    ?>
                    <div class='col-md-4 col-sm-6 col-xs-12'>
                        <div class="product-item">
                            <div class="pi-img-wrapper">
                                <?php 
                                    if (!empty($outlet->pics)) { 
                                        $picUrls = $outlet->getPicUrls();
                                ?>
                                <img src="<?= $picUrls[0]; ?>" class="img-responsive" alt="<?= $outlet->title; ?>">
                                <?php } else { ?>
                                <img src="https://placeholdit.imgix.net/~text?txtsize=28&bg=fff&txtclr=000&txt=300×400&w=300&h=400&fm=png" class="img-responsive" alt="<?= $outlet->title; ?>">
                                <?php } ?>
                              <div>                            
                                <a href="javascript:;" class="btn btn-default">详情</a>
                              </div>
                            </div>
                            <h3><a href="javascript:;"><?= $outlet->title; ?></a></h3>
                            <div class="outlet-address" style='color:#eee'><?= $outlet->address; ?></div>
                            <div class="outlet-telephone" style='color:#eee'><?= $outlet->telephone; ?></div>
                            <div class="outlet-msc" style='color:#eee'><?= $outlet->supervisionOrganization->title; ?></div>
                            
                          </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$this->registerCssFile( '@web/metronic/theme/assets/frontend/layout/css/style.css' );
$this->registerCssFile( '@web/metronic/theme/assets/frontend/pages/css/style-shop.css' );
$this->registerCssFile( '@web/metronic/theme/assets/frontend/layout/css/style-responsive.css' );
$this->registerCssFile( '@web/metronic/theme/assets/frontend/layout/css/themes/red.css' );
$this->registerCssFile( '@web/metronic/theme/assets/global/plugins/jstree/dist/themes/default/style.min.css' );

$this->registerCss('
    body.page-header-fixed {
        padding-top: 0px !important;
    } 
    .product-item {
        background:#2b3643
    } 
    .product-item h3 a {
        color: #eee;
    }
');

$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/jstree/dist/jstree.min.js' );
$this->registerJsFile( '@web/js/yjhu/client-outlet-index.js' );
