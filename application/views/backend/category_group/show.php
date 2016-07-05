<div class="page-title">
   <div class="row">
        <div class="col-md-12">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('category_group_info')?></h4>
        </div>
    </div>  
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tbody>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('category_group_name');?> :</td>
                <td class="col-md-10"><?php echo $row['name'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('category_group_url');?> :</td>
                <td class="col-md-10"><?php echo $row['url'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('category_group_ordinal');?> :</td>
                <td class="col-md-10"><?php echo $row['ordinal'];?></td>
            </tr>  
            
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-offset-5">
        <a href="<?php echo base_url('acp/category_group');?>" class="btn btn-info active"><?php echo $this->lang->line('btn_back')?></a>
        <a href="<?php echo base_url('acp/category_group/edit/'.$row['id']);?>" class="btn btn-warning btn-md"><?php echo $this->lang->line('btn_edit')?></a>
        <a href="<?php echo base_url('acp/category_group/delete/'.$row['id']);?>" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('btn_delete')?></a>
    </div>
</div>