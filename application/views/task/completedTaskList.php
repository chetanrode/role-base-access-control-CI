<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-th-list"></i> Completed Task List
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Task List</h3>
                        <div class="box-tools">
                        </div>
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
                                        <td><?php echo $record->description ?></td>
                                        <td><?php echo $record->updatedDtm ?></td>
                                        <td><?php
                                            if($record->status == 1){
                                                echo "Completed";
                                            }else{
                                                echo "Processing";
                                            }
                                             ?></td>
                                        <td class="text-center"> |
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'task/editOldTask/'.$record->taskId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                           <!-- <a class="btn btn-sm btn-danger deleteTask" href="<?php /*echo base_url().'task/deleteTask/'.$record->taskId; */?>" data-taskid="<?php /*echo $record->taskId; */?>" title="Delete"><i class="fa fa-trash"></i></a>-->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
