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
    <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet light ">
                    <div class="portlet-title">
                            <div class="caption">
                                    <i class="icon-bar-chart font-green-sharp hide"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Site Visits</span>
                                    <span class="caption-helper">weekly stats...</span>
                            </div>
                            <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">New</label>
                                            <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Returning</label>
                                    </div>
                            </div>
                    </div>
                    <div class="portlet-body">
                            <div id="site_statistics_loading" style="display: none;">
                                    <img src="./metronic/theme/assets/admin/layout/img/loading.gif" alt="loading">
                            </div>
                            <div id="site_statistics_content" class="display-none" style="display: block;">
                                    <div id="site_statistics" class="chart" style="padding: 0px; position: relative;">
                                    <canvas class="flot-base" width="357" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 357px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 16px; text-align: center;">02/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 54px; text-align: center;">03/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 92px; text-align: center;">04/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 130px; text-align: center;">05/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 169px; text-align: center;">06/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 207px; text-align: center;">07/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 245px; text-align: center;">08/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 283px; text-align: center;">09/2013</div><div style="position: absolute; max-width: 35px; top: 285px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 322px; text-align: center;">10/2013</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; top: 273px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 21px; text-align: right;">0</div><div style="position: absolute; top: 220px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">1000</div><div style="position: absolute; top: 166px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">2000</div><div style="position: absolute; top: 113px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">3000</div><div style="position: absolute; top: 59px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">4000</div><div style="position: absolute; top: 6px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 11px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">5000</div></div></div><canvas class="flot-overlay" width="357" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 357px; height: 300px;"></canvas></div>
                            </div>
                    </div>
            </div>
            <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet light ">
                <div class="portlet-title">
                        <div class="caption">
                                <i class="icon-share font-red-sunglo hide"></i>
                                <span class="caption-subject font-red-sunglo bold uppercase">Revenue</span>
                                <span class="caption-helper">monthly stats...</span>
                        </div>
                        <div class="actions">
                                <div class="btn-group">
                                        <a href="" class="btn grey-salsa btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        Filter Range<span class="fa fa-angle-down">
                                        </span>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                                <li>
                                                        <a href="javascript:;">
                                                        Q1 2014 <span class="label label-sm label-default">
                                                        past </span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="javascript:;">
                                                        Q2 2014 <span class="label label-sm label-default">
                                                        past </span>
                                                        </a>
                                                </li>
                                                <li class="active">
                                                        <a href="javascript:;">
                                                        Q3 2014 <span class="label label-sm label-success">
                                                        current </span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="javascript:;">
                                                        Q4 2014 <span class="label label-sm label-warning">
                                                        upcoming </span>
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </div>
                <div class="portlet-body">
                        <div id="site_activities_loading" style="display: none;">
                                <img src="./metronic/theme/assets/admin/layout/img/loading.gif" alt="loading">
                        </div>
                        <div id="site_activities_content" class="display-none" style="display: block;">
                                <div id="site_activities" style="height: 228px; padding: 0px; position: relative;">
                                <canvas class="flot-base" width="357" height="228" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 357px; height: 228px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 22px; text-align: center;">DEC</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 58px; text-align: center;">JAN</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 92px; text-align: center;">FEB</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 124px; text-align: center;">MAR</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 160px; text-align: center;">APR</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 193px; text-align: center;">MAY</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 230px; text-align: center;">JUN</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 266px; text-align: center;">JUL</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 297px; text-align: center;">AUG</div><div style="position: absolute; max-width: 32px; top: 209px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 18px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 334px; text-align: center;">SEP</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; top: 197px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 21px; text-align: right;">0</div><div style="position: absolute; top: 149px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 7px; text-align: right;">500</div><div style="position: absolute; top: 100px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">1000</div><div style="position: absolute; top: 52px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">1500</div><div style="position: absolute; top: 3px; font-style: normal; font-variant: small-caps; font-weight: 400; font-stretch: normal; font-size: 10px; line-height: 14px; font-family: 'Open Sans', sans-serif; color: rgb(111, 123, 138); left: 1px; text-align: right;">2000</div></div></div><canvas class="flot-overlay" width="357" height="228" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 357px; height: 228px;"></canvas></div>
                        </div>
                        <div style="margin: 20px 0 10px 30px">
                                <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-success">
                                                Revenue: </span>
                                                <h3>$13,234</h3>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-info">
                                                Tax: </span>
                                                <h3>$134,900</h3>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-danger">
                                                Shipment: </span>
                                                <h3>$1,134</h3>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-warning">
                                                Orders: </span>
                                                <h3>235090</h3>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
<?php
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.resize.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.categories.min.js' );


