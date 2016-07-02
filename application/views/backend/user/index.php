<div class="page-title">
   <div class="row">
        <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('user_list')?></h4>
        </div>
        <div class="col-md-1">
            <a href="<?php echo base_url('acp/user/add');?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open">&nbsp;</span><?php echo $this->lang->line('btn_add'); ?></a>
        </div>
    </div>  
</div>
<?php $this->load->view('backend/user/_search'); ?>
<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <th><?php echo $this->lang->line('STT');?></th>
                    <th><?php echo $this->lang->line('user_fullname');?></th>
                    <th><?php echo $this->lang->line('user_username');?></th>
                    <th><?php echo $this->lang->line('user_group');?></th>
                    <th><?php echo $this->lang->line('user_phone');?></th>
                    <th><?php echo $this->lang->line('user_email');?></th>
                    <th><?php echo $this->lang->line('user_gender');?></th>
                    <th><?php echo $this->lang->line('user_status');?></th>
                    <th><?php echo $this->lang->line('btn_edit');?>/<?php echo $this->lang->line('btn_delete');?></th>
                </tr>
            </thead>
            <tbody>
               
                    <?php
                    foreach ($rows as $key => $row)
                    {
                        $row = $this->user_model->convert_data($row);
                    ?>
                     <tr>
                        <td><?php echo $key+1;?></td>
                        <td><a href="<?php echo base_url('acp/user/show/'.$row['id']);?>"><?php echo $row['fullname'];?></a></td>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['groups_'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['gender_'];?></td>
                        <td><?php echo $row['status_'];?></td>
                        <td>
                            <a href="<?php echo base_url('acp/user/edit/'.$row['id']);?>" class="btn btn-warning btn-xs"><?php echo $this->lang->line('btn_edit'); ?></a>
                            <a href="<?php echo base_url('acp/user/delete/'.$row['id']);?>" class="btn btn-danger btn-xs"><?php echo $this->lang->line('btn_delete'); ?></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <?php echo $this->pagination->create_links();?>
    </div>
</div>