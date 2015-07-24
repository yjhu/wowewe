<div class="page-bar">
    <div class="pull-right">
        <label class=''>渠道选择：</label>
        <select id='outlet-selection' class='form-control input-large' style="display:inline;">
            <option value='0'>所有</option>
            <?php 
                $offices = \app\models\MUser::getTotalOffices();
                foreach ($offices as $office) {
                    if (null !== $target_office && $target_office->office_id === $office->office_id ) {
            ?>
            <option value='<?= $office->office_id ?>' selected="selected"><?= $office->title ?></option>
            <?php }  else { ?>
            <option value='<?= $office->office_id ?>'><?= $office->title ?></option>
            <?php }} ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light blue-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \app\models\MUser::getTotalFans($target_office); ?>
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
                                     <?= \app\models\MUser::getTotalMembers($target_office); ?>
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
                                     <?= \app\models\MOrder::getTotalSucceedOrderSum($target_office); ?>元
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
                                     <?= \app\models\MOrder::getTotalSucceedOrders($target_office); ?>笔
                            </div>
                            <div class="desc">
                                     成交订单
                            </div>
                    </div>
            </a>        
    </div>
</div>
<div class="clearfix"></div>
<script>
    var target_office_id = <?= null === $target_office ? 0 : $target_office->office_id ?>;
    function redirectTo() {
        location.href = '<?= \yii\helpers\Url::to(['wapx/metronic']) ?>' + '&office_id=' + target_office_id;
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">粉丝及会员</span>
                    <span class="caption-helper">发展趋势</span>
                </div>
                
                <div class="actions">  
                    <div id="member-flot-daterange" class='pull-left' style="display:inline; margin-right: 30px;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span><?= date('Y年m月d日', strtotime('-1 month')) . ' 至 ' . date('Y年m月d日') ?></span> <b class="caret"></b>
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


