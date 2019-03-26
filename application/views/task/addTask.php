<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tasks"></i> Add New Task
            <small>Add / Edit Tasks</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Task Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addTask" action="<?php echo base_url() ?>addNewTask" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="taskName">Task Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('taskName'); ?>" id="taskName" name="taskName" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="assignTo">Assign TO Implementor</label>
                                        <select class="form-control required" id="assignTo" name="assignTo">
                                            <option value="0">Select Implementor</option>
                                            <?php

                                            if(!empty($users))
                                            {
                                                foreach ($users as $im)
                                                {
                                                    ?>
                                                    <option value="<?php echo $im->userId ?>" <?php if($im->userId == set_value('userId')) {echo "selected=selected";} ?>><?php echo $im->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="siteId">Select Site</label>
                                        <select class="form-control required" id="siteId" name="siteId">
                                            <option value="0">Select Site</option>
                                            <?php
                                            if(!empty($sites))
                                            {
                                                foreach ($sites as $st)
                                                {
                                                    ?>
                                                    <option value="<?php echo $st->siteId; ?>" <?php if($st->siteId == set_value('siteId')) {echo "selected=selected";} ?>><?php echo $st->address .','.  $st->city .''. $st->district  ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Select Device</label>
                                        <select class="form-control required" id="deviceId" name="deviceId">
                                            <option value="0">Select Site</option>
                                            <?php
                                            if(!empty($device))
                                            {
                                                foreach ($device as $st)
                                                {
                                                    ?>
                                                    <option value="<?php echo $st->deviceId; ?>" <?php if($st->deviceId == set_value('deviceId')) {echo "selected=selected";} ?>><?php echo $st->deviceName; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="taskName">Discription</label>
                                        <textarea type="text" class="form-control required" value="<?php echo set_value('description'); ?>" id="description" name="description" maxlength="255"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="taskName">Status</label><br>
                                        Completed : <input type="radio"  value="1" name="status"/>
                                        Processing : <input type="radio"  value="0" name="status"/>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
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
<script src="<?php echo base_url(); ?>assets/js/addTask.js" type="text/javascript"></script>