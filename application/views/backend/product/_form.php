<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            
            <div class="form-group <?php if(form_error('category_group_id')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="category_group_id"><?php echo $this->lang->line('category_group');?> :</label>
                <div class="col-md-8">
                    <select type="text" class="form-control" name="category_group_id" id="category_group_id" onchange="return get_category(this.value)">
                    <option value="">--<?php echo $this->lang->line('category_group_select');?>--</option>
                    <?php
                    foreach ($category_groups as $category_group)
                    {
                    ?>
                        <option value="<?php echo $category_group['id'];?>" <?php echo set_select('category_group_id',$category_group['id'],$category_group['id'] == $row['category_group_id'] );?>>
                            <?php echo $category_group['name'];?>
                        </option>
                    <?php
                    }
                    ?>
                    </select>
                    <?php echo form_error('category_group_id', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('category_id')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="category_id"><?php echo $this->lang->line('category');?> :</label>
                <div class="col-md-8">
                    <select type="text" class="form-control" name="category_id" id="category_id">
                        <option value="">--<?php echo $this->lang->line('category_group_select');?>--</option>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo set_select('category_id',$category['id'],$category['id'] == $row['category_id'] );?>>
                                <?php echo $category['name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo form_error('category_id', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="title"><?php echo $this->lang->line('product_title');?> :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title', $row['title']); ?>" placeholder="Enter Title">
                    <?php echo form_error('title', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('link_web')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="link_web"><?php echo $this->lang->line('product_link_web');?> :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="link_web" id="link_web" value="<?php echo set_value('link_web', $row['link_web']); ?>" placeholder="Enter Link">
                    <?php echo form_error('link_web', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="image"><?php echo $this->lang->line('product_image');?> :</label>
                <div class="col-md-2">
                    <img src="<?php echo $row['image_'];?>" width="120" />
                </div>
                <div class="col-md-6 <?php if(isset($image_error)) echo 'has-error'; ?>">
                    <input type="file" class="form-control" name="image">
                    <?php
                        if(isset($image_error)) {
                            echo "<small class='help-block'>".$image_error."</small>";
                        }
                    ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="description"><?php echo $this->lang->line('product_description');?> :</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="description" id="description" value="<?php echo set_value('description', $row['description']); ?>" placeholder="Enter Description">
                    <?php echo form_error('description', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('content')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="textarea_editor"><?php echo $this->lang->line('product_content');?> :</label>
                <div class="col-md-8">
                    <textarea name="content" id="textarea_editor" class="form-control"><?php echo set_value('content', $row['content']); ?></textarea>
                    <fieldset style="border:1px solid #CCC;" dir="rtl" >
                        <iframe name="image_iframe" id="image_iframe" width="100%" scrolling="yes" frameborder="0" height="300" src="<?php echo base_url('acp/image?table_name=product&table_id='.$row['id']);?>"></iframe>
                        <legend style="font-size:14px; margin-right:50px; padding:0 10px 0 10px;"> Chỉ tải lên các hình có định dạng là <strong>jpg | png | gif</strong> và không vượt quá 5MB</legend>
                    </fieldset>
                        
                    <?php echo form_error('content', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">    
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save');?></button>
                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('vendor/ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/image.js');?>"></script>
<script type='text/javascript'>CKEDITOR.replace('textarea_editor');</script>
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
</script>
