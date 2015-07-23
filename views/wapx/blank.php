<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light blue-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \app\models\MUser::getTotalFans(); ?>
                            </div>
                            <div class="desc">
                                     粉丝
                            </div>
                    </div>
            </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light red-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \app\models\MUser::getTotalMembers(); ?>
                            </div>
                            <div class="desc">
                                     会员
                            </div>
                    </div>
            </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light green-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-trophy"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \app\models\MOrder::getTotalSucceedOrderSum(); ?>元
                            </div>
                            <div class="desc">
                                     成交金额
                            </div>
                    </div>
            </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light purple-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \app\models\MOrder::getTotalSucceedOrders(); ?>笔
                            </div>
                            <div class="desc">
                                     成交订单
                            </div>
                    </div>
            </a>        
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">粉丝及会员</span>
                    <span class="caption-helper">发展趋势</span>
                </div>
                
                <div class="actions">  
                    <div id="member-flot-daterange" class='pull-left' style="margin-right: 30px;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span>July 16, 2015 - July 22, 2015</span> <b class="caret"></b>
                    </div>
                    <!--
                    <div class="btn-group" data-toggle="buttons" style="margin-right:50px;">
                        <label class="btn btn-default">
                        <input type="radio" name="member-flot-daterange" class="toggle" id="member-flot-daterange-7days">7天</label>
                        <label class="btn btn-default">
                        <input type="radio" name="member-flot-daterange" class="toggle" id="member-flot-daterange-14days">14天</label>
                        <label class="btn btn-default active">
                        <input type="radio" name="member-flot-daterange" class="toggle" id="member-flot-daterange-30days">30天</label>
                    </div>
                    -->
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                        <input type="radio" name="member-flot-accumulated" class="toggle" id="member-flot-accumulated-off">新增</label>
                        <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                        <input type="radio" name="member-flot-accumulated" class="toggle" id="member-flot-accumulated-on">累积</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div id="member-flot" style="height:300px;"></div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerCssFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css' ); 
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.resize.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.time.min.js' );
$this->registerJsFile( '@web/js/yjhu/member-flot.js' );


