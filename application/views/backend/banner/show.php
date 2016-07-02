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
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_weblink');?> :</td>
                <td class="col-md-10"><?php echo $row['weblink'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_company');?> :</td>
                <td class="col-md-10"><?php echo $row['company'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_orig_name');?> :</td>
                <td class="col-md-10"><img src="<?php echo $row['image_'];?>" class="img-responsive"></td>
            </tr>  
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_file_size');?> :</td>
                <td class="col-md-10"><?php echo $row['file_size_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_image_width');?> :</td>
                <td class="col-md-10"><?php echo $row['image_width_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_image_height');?> :</td>
                <td class="col-md-10"><?php echo $row['image_height_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_image_type');?> :</td>
                <td class="col-md-10"><?php echo $row['image_type_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_posted_date');?> :</td>
                <td class="col-md-10"><?php echo $row['posted_date_'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('banner_expiration_date');?> :</td>
                <td class="col-md-10"><?php echo $row['expiration_date_'];?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-offset-5">
        <a href="<?php echo base_url('acp/banner');?>" class="btn btn-info active"><?php echo $this->lang->line('btn_back')?></a>
        <a href="<?php echo base_url('acp/banner/edit/'.$row['id']);?>" class="btn btn-warning btn-md"><?php echo $this->lang->line('btn_edit')?></a>
        <a href="<?php echo base_url('acp/banner/delete/'.$row['id']);?>" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('btn_delete')?></a>
    </div>
</div>