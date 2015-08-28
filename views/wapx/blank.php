<div class="page-bar">
    <div class="pull-right">
        <?php if (NULL !== $target_office) { ?>
        <a href="#qrcode-target-office" data-toggle="modal">
            <i style='font-size:2em;' class="fa fa-qrcode"></i>
        </a>&nbsp;&nbsp;&nbsp;
        <?php } ?>
        <label>渠道选择：</label>
        <?php if (\Yii::$app->user->isAdmin) { ?>
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
        <?php } else if (\Yii::$app->user->isOffice){ ?>
        <label><?= \Yii::$app->user->identity->title; ?></label>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
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
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
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
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="dashboard-stat dashboard-stat-light green-soft" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-trophy"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= \Yii::$app->formatter->asCurrency(intval(\app\models\MOrder::getTotalSucceedOrderSum($target_office)), NULL, 
                                         [
                                            NumberFormatter::MIN_FRACTION_DIGITS => 0,
                                            NumberFormatter::MAX_FRACTION_DIGITS => 0,
                                         ]); ?>
                            </div>
                            <div class="desc">
                                     成交金额
                            </div>
                    </div>
            </a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
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
    <?php if (NULL !== $target_office) { ?>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <a class="dashboard-stat dashboard-stat-light yellow-gold" href="javascript:;">
                    <div class="visual">
                            <i class="fa fa-money"></i>
                    </div>
                    <div class="details">
                            <div class="number">
                                     <?= $target_office->score; ?>分
                            </div>
                            <div class="desc">
                                     渠道积分
                            </div>
                    </div>
            </a>        
    </div>
    <?php } ?>
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
                    <span class="caption-subject">
                        <i class="fa fa-line-chart"></i>
                        粉丝及会员
                    </span>
                    <span class="caption-helper">发展</span>
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
<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-pie-chart"></i>
                        会员
                    </span>
                    <span class="caption-helper">
                        运营商分布
                    </span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-sm btn-circle btn-default" id="member-carrier-pie-reload">
                    <i class="fa fa-repeat"></i> 重载 </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="member-carrier-pie" style="height:300px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-pie-chart"></i>
                        会员
                    </span>
                    <span class="caption-helper">
                        地域分布
                    </span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-sm btn-circle btn-default"  id="member-region-pie-reload">
                    <i class="fa fa-repeat"></i> 重载 </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="member-region-pie" style="height:300px;"></div>
            </div>
        </div>
    </div>
</div>
<?php if (NULL !== $target_office) { ?>
<div class="modal fade in" id="qrcode-target-office"  style="display: none;">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title"><?= $target_office->title ?>的二维码</h4>
                        </div>
                        <div class="modal-body">
                                 <?php echo \yii\helpers\Html::img($target_office->getQrImageUrl(), ['class'=>'img-responsive center-block']); ?>
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
<?php
$this->registerCssFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css' ); 
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/moment.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.resize.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.time.min.js' );
$this->registerJsFile( '@web/metronic/theme/assets/global/plugins/flot/jquery.flot.pie.min.js' );
$this->registerJsFile( '@web/js/yjhu/member-flot.js' );


