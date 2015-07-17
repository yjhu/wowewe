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
<title><?= \yii\helpers\Html::encode($this->title); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="./metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
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
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
                    <a href=<?= \Yii::$app->homeUrl; ?>>
			<img src="./xyunicom.png" alt="logo" class="logo-default" style="height:38px;margin-top:4px;"/>
			</a>
			<div class="sidebar-toggler">
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
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li> 
                            <?php if (!\Yii::$app->user->isGuest) { ?>
                                <li class="start active open">
                                        <a href="javascript:;">
					<i class="fa fa-tachometer"></i>
					<span class="title">概况</span>
					<span class="arrow "></span>
					</a>
                                </li>
                                <li>
					<a href="javascript:;">
					<i class="fa fa-weixin"></i>
					<span class="title">微信管理</span>
					<span class="arrow "></span>
					</a>
                                        <ul class="sub-menu">
                                                <li>
							<a href="">
							<i class="fa fa-bars"></i>
							自定义菜单</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-comments"></i>
							自动回复</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-users"></i>
							粉丝管理</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-soundcloud"></i>
							素材管理</a>
						</li>                                                
                                        </ul>
				</li>
                                <li>
					<a href="javascript:;">
					<i class="fa fa-building"></i>
					<span class="title">运营管理</span>
					<span class="arrow "></span>
					</a>
                                        <ul class="sub-menu">
                                                <li>
							<a href="">
							<i class="fa fa-sitemap"></i>
							部门</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-home"></i>
							营业厅</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-user"></i>
							员工</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-users"></i>
							客户</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-user"></i>
							经销商</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-mobile"></i>
							商品</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-shopping-cart"></i>
							订单</a>
						</li>
                                                <li>
							<a href="">
							<i class="fa fa-soundcloud"></i>
							活动</a>
						</li>
                                        </ul>
				</li>
                            <?php } ?>
			</ul>
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