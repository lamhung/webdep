<div class="page-title">
   <div class="row">
        <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('news_list')?></h4>
        </div>
        <div class="col-md-1">
            <a href="<?php echo base_url('acp/news/add');?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open">&nbsp;</span><?php echo $this->lang->line('btn_add'); ?></a>
        </div>
    </div>  
</div>
<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <th><?php echo $this->lang->line('STT');?></th>
                    <th><?php echo $this->lang->line('news_title');?></th>
                    <th><?php echo $this->lang->line('news_image');?></th>
                    <th><?php echo $this->lang->line('news_description');?></th>
                    <th><?php echo $this->lang->line('news_get_at');?></th>
                    <th><?php echo $this->lang->line('btn_edit');?>/<?php echo $this->lang->line('btn_delete');?></th>
                </tr>
            </thead>
            <tbody>
               
                    <?php
                    foreach ($rows as $key => $row)
                    {
                        $row = $this->news_model->convert_data($row);
                    ?>
                     <tr>
                        <td><?php echo $key+1;?></td>
                        <td><a href="<?php echo base_url('acp/news/show/'.$row['id']);?>"><?php echo $row['title'];?></a></td>
                        <td><img src="<?php echo $row['image_'];?>"/></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['get_at_'];?></td>
                        <td>
                            <a href="<?php echo base_url('acp/news/edit/'.$row['id']);?>" class="btn btn-warning btn-xs"><?php echo $this->lang->line('btn_edit'); ?></a>
                            <a href="<?php echo base_url('acp/news/delete/'.$row['id']);?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><?php echo $this->lang->line('btn_delete'); ?></a>
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
