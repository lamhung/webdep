
<div class="page-title">
   <div class="row">
        <div class="col-md-11">
            <h4><span class="glyphicon glyphicon-log-in">&nbsp;</span><?php echo $this->lang->line('product_list')?></h4>
        </div>
        <div class="col-md-1">
            <a href="<?php echo base_url('acp/product/add');?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-open">&nbsp;</span><?php echo $this->lang->line('btn_add'); ?></a>
        </div>
    </div>  
</div>
<div id="product_list">
<div class="row">
    <div class="table-responsive col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="success">
                    <th><?php echo $this->lang->line('STT');?></th>
                    <th><?php echo $this->lang->line('category');?></th>
                    <th><?php echo $this->lang->line('product_title');?></th>
                    <th><?php echo $this->lang->line('product_description');?></th>
                    <th><?php echo $this->lang->line('product_create_at');?></th>
                    <th><?php echo $this->lang->line('btn_edit');?>/<?php echo $this->lang->line('btn_delete');?></th>
                </tr>
            </thead>
            <tbody>
               
                    <?php
                    foreach ($rows as $key => $row)
                    {
                        $row = $this->product_model->convert_data($row);
                    ?>
                     <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $row['category'];?></td>
                        <td><a href="<?php echo base_url('acp/product/show/'.$row['id']);?>"><?php echo $row['title'];?></a></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo $row['create_at_'];?></td>
                        <td>
                            <a href="<?php echo base_url('acp/product/edit/'.$row['id']);?>" class="btn btn-warning btn-xs"><?php echo $this->lang->line('btn_edit'); ?></a>
                            <a href="<?php echo base_url('acp/product/delete/'.$row['id']);?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('btn_delete'); ?></a>
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
</div>
<script type="text/javascript">

    function get_category(category_group) {
        $.ajax({
           type : 'POST',
           url : "<?php echo base_url('acp/product/ajax_get_category');?>",
           data : {category_group : category_group},
           success : function(respone) {
               $("#category_id").html(respone);
           }
        });
    }
    
    function filter_product(category_id) {
        $.ajax({
           type : "POST",
           url : "<?php echo base_url('acp/product/ajax_filter_product');?>",
           data : {category_id : category_id},
           success : function(data) {
            $("#product_list").html(data);
        }
        });
    }
</script>
