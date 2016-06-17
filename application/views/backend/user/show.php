<div class="page-title">
   <div class="row">
        <div class="col-md-12">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('user_info')?></h4>
        </div>
    </div>  
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tbody>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_fullname');?> :</td>
                <td class="col-md-10"><?php echo $row['fullname'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_username');?> :</td>
                <td class="col-md-10"><?php echo $row['username'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_group');?> :</td>
                <td class="col-md-10"><?php echo $row['groups_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_image');?> :</td>
                <td class="col-md-10"><img src="<?php echo $row['image_'];?>"></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_phone');?> :</td>
                <td class="col-md-10"><?php echo $row['phone'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_email');?> :</td>
                <td class="col-md-10"><?php echo $row['email'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_address');?> :</td>
                <td class="col-md-10"><?php echo $row['address'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_gender');?> :</td>
                <td class="col-md-10"><?php echo $row['gender_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_birthday');?> :</td>
                <td class="col-md-10"><?php echo $row['birthday'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_status');?> :</td>
                <td class="col-md-10"><?php echo $row['status_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('user_create_at');?> :</td>
                <td class="col-md-10"><?php echo $row['create_at_'];?></td>
            </tr>        
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-offset-5">
        <a href="<?php echo base_url('acp/user');?>" class="btn btn-info active"><?php echo $this->lang->line('btn_back')?></a>
        <a href="<?php echo base_url('acp/user/edit');?>" class="btn btn-primary btn-md"><?php echo $this->lang->line('btn_edit')?></a>
        <a href="<?php echo base_url('acp/user/delete');?>" class="btn btn-danger btn-md"><?php echo $this->lang->line('btn_delete')?></a>
    </div>
</div>