<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= \Yii::$app->language; ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?= \Yii::$app->language; ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= \Yii::$app->language; ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="<?= \Yii::$app->charset; ?>"/>
<title>
襄阳联通微信运营平台V2.0
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="./metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="./metronic/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="./metronic/theme/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<?php $this->head(); ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<?php $this->beginBody() ?>
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-fixed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
                    <a href=<?= \Yii::$app->homeUrl; ?>>
			<img src="./xyunicom.png" alt="logo" class="logo-default" style="height:38px;margin-top:4px;"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
                            <?php if (!\Yii::$app->user->isGuest) { ?>
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">                                            
					<img alt="" class="img-circle" src="./unicom.jpg" style="width:32px;"/>
					<span class="username username-hide-on-mobile">
					<?= \yii\helpers\Html::encode(\Yii::$app->user->identity->username); ?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
                                                <?php if ( \Yii::$app->user->isOffice && !\Yii::$app->user->isAdmin ) { ?>
                                                <li>
                                                        <a href="#qrcode-modal" data-toggle="modal">
							<i class="fa fa-qrcode"></i> 二维码 </a>
						</li>
                                                <?php } ?>
						<li>
                                                        <a href="<?= \yii\helpers\Url::to(['/site/profile']); ?>">
							<i class="icon-lock"></i> 修改密码 </a>
						</li>
                                                <li class="divider"></li>
						<li>
                                                    <a href="<?= \yii\helpers\Url::to(['/site/logout']); ?>">
							<i class="icon-key"></i> 退出系统 </a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
                            <?php } else { ?>
                                <li>
                                    <a href="<?= \yii\helpers\Url::to(['/site/login']); ?>">
                                    登录
                                    </a>
                                </li>
                            <?php } ?>
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <?php 
                    if (\Yii::$app->user->isAdmin) {
                        echo \yii\widgets\Menu::widget([
                            'firstItemCssClass' => 'start',
                            'encodeLabels' => false,
                            'activateParents' => true,
                            'items' => [ 
                                [
                                    'label' => '<i class="fa fa-home"></i><span class="title">首页</span><span class="arrow "></span>', 
                                    'url' => ['/wapx/metronic']
                                ],
                                [
                                    'label' => '<i class="fa fa-users"></i><span class="title">客户</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '客户管理','url' => ['/custom/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '客户常见问题','url' => ['/unicom-faq/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '客户统计','url' => ['/order/officecustomstat'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '粉丝管理','url' => ['/admin/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '用户账户管理','url' => ['/useraccount/index'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],
                                [
                                    'label' => '<i class="fa fa-users"></i><span class="title">员工</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '员工管理','url' => ['/client-employee/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '员工推广成绩排行','url' => ['/order/stafftop'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '推广查询','url' => ['/accesslog/index'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],
                                [
                                    'label' => '<i class="fa fa-home"></i><span class="title">渠道</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '渠道管理','url' => ['/client-outlet/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '营业厅推广成绩排行','url' => ['/order/officetop'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],
                                [
                                    'label' => '<i class="fa fa-shopping-cart"></i><span class="title">商品与订单</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '订单管理','url' => ['/order/index'],'linkOptions' => ['data-method' => 'post']],                                                               
                                        ['label' => '消息中心','url' => ['/messagebox/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '促销活动管理','url' => ['/activity/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '商品管理','url' => ['/admin/itemlist'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '商品套餐管理','url' => ['/admin/pkglist'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],
                                [
                                    'label' => '<i class="fa fa-weixin"></i><span class="title">微信</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '微信菜单配置','url' => ['/wxmenu/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '菜单动作设置','url' => ['/wxaction/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '图片管理','url' => ['/photo/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '单图文','url' => ['/article/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '多图文','url' => ['/articlemult/index'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],  
                                /*投票活动需要，临时入口*/
                                [
                                    'label' => '<i class="fa fa-signal"></i><span class="title">活动投票</span><span class="arrow "></span>',
                                    'url' => '',
                                    'items' => [
                                        ['label' => '情诗审核','url' => ['/qingshi-author/index'],'linkOptions' => ['data-method' => 'post']],
                                        ['label' => '投票排行','url' => ['/qingshi-score/index'],'linkOptions' => ['data-method' => 'post']],
                                    ],
                                ],  


                            ],
                            'options' => [
                                'class' => 'page-sidebar-menu',
                                'data-keep-expanded' => "false", 
                                'data-auto-scroll' => "true",
                                'data-slide-speed' => "200",
                            ],
                            'submenuTemplate' => "\n<ul class='sub-menu'>\n{items}\n</ul>\n",
                        ]);
                    } else if (\Yii::$app->user->isOffice) {
                        echo \yii\widgets\Menu::widget([
                            'firstItemCssClass' => 'start',
                            'encodeLabels' => false,
                            'activateParents' => true,
                            'options' => [
                                'class' => 'page-sidebar-menu',
                                'data-keep-expanded' => "false", 
                                'data-auto-scroll' => "true",
                                'data-slide-speed' => "200",
                            ],
                            'submenuTemplate' => "\n<ul class='sub-menu'>\n{items}\n</ul>\n",
                            'items' => [ 
                                [
                                    'label' => '<i class="fa fa-home"></i><span class="title">首页</span><span class="arrow "></span>', 
                                    'url' => ['/wapx/metronic']
                                ],
                                ['label' => '<i class="fa fa-shopping-cart"></i><span class="title">订单管理</span><span class="arrow "></span>','url' => ['/order/index'],'linkOptions' => ['data-method' => 'post']],
                                ['label' => '<i class="fa fa-users"></i><span class="title">员工管理</span><span class="arrow "></span>','url' => ['/order/stafflist'],'linkOptions' => ['data-method' => 'post']],
                                ['label' => '<i class="fa fa-users"></i><span class="title">粉丝管理</span><span class="arrow "></span>','url' => ['/admin/index'],'linkOptions' => ['data-method' => 'post']],
                                ['label' => '<i class="fa fa-users"></i><span class="title">客户管理</span><span class="arrow "></span>','url' => ['/custom/index'],'linkOptions' => ['data-method' => 'post']],
                                ['label' => '<i class="fa fa-search"></i><span class="title">推广查询</span><span class="arrow "></span>','url' => ['/accesslog/index'],'linkOptions' => ['data-method' => 'post']],
                            ],
                            
                        ]);
                    }
                    ?>		
                    <!-- END SIDEBAR MENU -->
                    
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
                    <div class="page-bar">                    
                    <?= \yii\widgets\Breadcrumbs::widget([
                        'options' => ['class' => 'page-breadcrumb'],
                        'itemTemplate' => "<li>{link}<i class='fa fa-angle-right'></i></li>\n",
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'homeLink' => [
                            'label' => '首页',
                            'url' => \Yii::$app->homeUrl,
                            'template' => "<li><i class='fa fa-home'></i>{link}<i class='fa fa-angle-right'></i></li>\n",
                        ],
                    ]) ?>
                    </div>
			<?= $content; ?>
		</div>
	</div>
	<!-- END CONTENT -->
        <?php if ( \Yii::$app->user->isOffice && !\Yii::$app->user->isAdmin ) { ?>
        <div class="modal fade in" id="qrcode-modal"  style="display: none;">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title"><?= \Yii::$app->user->identity->username ?>的二维码</h4>
                                </div>
                                <div class="modal-body">
                                         <?php echo \yii\helpers\Html::img(\Yii::$app->user->identity->getQrImageUrl(), ['class'=>'img-responsive center-block']); ?>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                                </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
        </div>
        <?php } ?>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <?= date('Y'); ?> &copy; 沃手科技 
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="./metronic/theme/assets/global/plugins/respond.min.js"></script>
<script src="./metronic/theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="./metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="./metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="./metronic/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });
   </script>
<!-- END JAVASCRIPTS -->
<?php $this->endBody() ?>
</body>
<!-- END BODY -->
</html>
<?php $this->endPage() ?>