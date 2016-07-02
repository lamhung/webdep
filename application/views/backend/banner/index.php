<div class="page-title">
   <div class="row">
        <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('banner_list')?></h4>
        </div>
        <div class="col-md-1">
            <a href="<?php echo base_url('acp/banner/add');?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open">&nbsp;</span><?php echo $this->lang->line('btn_add'); ?></a>
        </div>
    </div>  
</div>
<?php $this->load->view('backend/banner/_search'); ?>
<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <th><?php echo $this->lang->line('STT');?></th>
                    <th><?php echo $this->lang->line('banner_orig_name');?></th>
                    <th><?php echo $this->lang->line('banner_weblink');?></th>
                    <th><?php echo $this->lang->line('banner_company');?></th>
                    <th><?php echo $this->lang->line('banner_clicks');?></th>
                    <th><?php echo $this->lang->line('banner_posted_date');?></th>
                    <th><?php echo $this->lang->line('banner_expiration_date');?></th>
                    <th><?php echo $this->lang->line('btn_edit');?>/<?php echo $this->lang->line('btn_delete');?></th>
                </tr>
            </thead>
            <tbody>
               
                    <?php
                    foreach ($rows as $key => $row)
                    {
                        $row = $this->banner_model->convert_data($row);
                    ?>
                     <tr>
                        <td><?php echo $key+1;?></td>
                        <td>
                            <div><img src="<?php echo $row['image_'];?>" width="200"></div>
                            <div align = "center"><a href="<?php echo base_url('acp/banner/show/'.$row['id']);?>"><?php echo $row['orig_name'];?></a></div>
                        </td>
                        <td><?php echo $row['weblink'];?></td>
                        <td><?php echo $row['company'];?></td>
                        <td><?php echo $row['clicks'];?></td>
                        <td><?php echo $row['posted_date_'];?></td>
                        <td><?php echo $row['expiration_date_'];?></td>
                        <td>
                            <a href="<?php echo base_url('acp/banner/edit/'.$row['id']);?>" class="btn btn-warning btn-xs"><?php echo $this->lang->line('btn_edit'); ?></a>
                            <a href="<?php echo base_url('acp/banner/delete/'.$row['id']);?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('btn_delete'); ?></a>
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