<div class="page-title">
   <div class="row">
        <div class="col-md-12">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('news_info')?></h4>
        </div>
    </div>  
</div>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tbody>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_title');?> :</td>
                <td class="col-md-10"><?php echo $row['title'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_url');?> :</td>
                <td class="col-md-10"><?php echo $row['url'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_image');?> :</td>
                <td class="col-md-10"><img src="<?php echo $row['image_'];?>" class="img-responsive"></td>
            </tr>  
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_description');?> :</td>
                <td class="col-md-10"><?php echo $row['description'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_content');?> :</td>
                <td class="col-md-10"><?php echo $row['content'];?></td>
            </tr>
            <tr class="active">
                <td class="col-md-2 text-right"><?php echo $this->lang->line('news_get_at');?> :</td>
                <td class="col-md-10"><?php echo $row['get_at_'];?></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-offset-5">
        <a href="<?php echo base_url('acp/news');?>" class="btn btn-info active"><?php echo $this->lang->line('btn_back')?></a>
        <a href="<?php echo base_url('acp/news/edit/'.$row['id']);?>" class="btn btn-warning btn-md"><?php echo $this->lang->line('btn_edit')?></a>
        <a href="<?php echo base_url('acp/news/delete/'.$row['id']);?>" class="btn btn-danger btn-md" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('btn_delete')?></a>
    </div>
</div>