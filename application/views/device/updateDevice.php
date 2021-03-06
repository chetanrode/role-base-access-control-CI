<?php
$deviceId = $deviceInfo->deviceId;
$deviceType = $deviceInfo->deviceType;
$deviceName = $deviceInfo->deviceName;
$stock = $deviceInfo->stock;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sites"></i> Update Device
            <small> Edit Device</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Device Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>editDevice" method="post" id="editDevice">
                        <input type="hidden" value="<?php echo $deviceId; ?>" name="deviceId" id="deviceId" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deviceType">Device Type</label>
                                        <select class="form-control required" id="deviceType" name="deviceType">
                                            <option value="<?php echo $deviceType ?>"><?php echo $deviceType ?></option>
                                            <?php

                                            if(!empty($deviceTypes))
                                            {
                                                foreach ($deviceTypes as $dev)
                                                {
                                                    if($deviceType != $dev->deviceType ){
                                                        ?>
                                                        <option value="<?php echo $dev->deviceType; ?>" <?php if($dev->deviceType == $deviceType) {echo "selected=selected";} ?>><?php echo $dev->deviceType ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deviceName">Device Name</label>
                                        <input type="text" class="form-control required" id="deviceName" value="<?php echo $deviceName; ?>" name="deviceName" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="text" class="form-control required" value="<?php echo $stock; ?>" id="stock" name="stock" maxlength="20">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary"  value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if($success)
                {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/editDevice.js" type="text/javascript"></script>