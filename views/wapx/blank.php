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


