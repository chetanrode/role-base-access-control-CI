<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-th-list"></i> Task Management
            <small>Add/Edit/Delete</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?= base_url().'pdf/'?>" title="Create PDF"><i class="fa fa-file-pdf-o"></i>Create PDF</a>
                    <a class="btn btn-primary" href="<?= base_url().'exportEtpCsv/'?>" title="Create CSV"><i class="fa fa-file-excel-o"></i>Create CSV</a>
                    <a class="btn btn-primary" href="<?= base_url().'task-history/'?>" title="Task history"><i class="fa fa-history"></i>Task history</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addTask"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Task List</h3><!--
                        <div class="box-tools">
                            <form action="<?php /*echo base_url() */?>taskListing" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php /*echo $searchText; */?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search by Task Name"/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>-->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Task ID</th>
                                <th>Task Name</th>
                                <th>Assign To</th>
                                <th>Address</th>
                                <th>Device Type</th>
                                <th>Description</th>
                                <th>Installation Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($taskRecords))
                            {
                                foreach($taskRecords as $record)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $record->taskId ?></td>
                                        <td><?php echo $record->taskName ?></td>
                                        <td><?php echo $record->UserName ?></td>
                                        <td><?php echo $record->SiteAddress ?></td>
                                        <td><?php echo $record->deviceName ?></td>
                                        <td style="font-size: small"><?php echo $record->description ?></td>
                                        <td><?php if(!empty($record->updatedDtm)){echo $record->updatedDtm;}else{echo "Not Install Yet!";}   ?></td>
                                        <td><?php
                                            if($record->status == 1){
                                                echo "Completed";
                                            }else{
                                                echo "Processing";
                                            }
                                            ?></td>
                                        <td class="text-center">

                                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'task/editOldTask/'.$record->taskId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteTask" href="<?php echo base_url().'task/deleteTask/'.$record->taskId; ?>" data-taskid="<?php echo $record->taskId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "taskListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
