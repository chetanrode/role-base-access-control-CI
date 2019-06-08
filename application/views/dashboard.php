<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $userCount; ?></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>userListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-maroon-gradient">
                    <div class="inner">
                        <h3><?php echo $siteCount; ?></h3>
                        <p>Sites</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-home"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>siteListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal-active">
                    <div class="inner">
                        <h3><?php echo $deviceCount; ?></h3>
                        <p>IoT Devices</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-desktop"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>deviceListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->


            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $taskCount; ?></h3>
                        <p>New Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>taskListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo count($taskRecords); ?></h3>
                        <p>Completed Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-loop-strong"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>completedTaskList" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo "50"?></h3>
                        <p>Assigned Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-checkmark"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>assignedTask" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
        </div>
    </section>
</div>