<script type="text/javascript" src="<?php echo base_url('vendor/ckeditor/ckeditor.js');?>"></script>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group <?php if(form_error('title')) echo 'has-error'; ?>">
                <label class="col-md-2 control-label" for="title"><?php echo $this->lang->line('news_title');?> :</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo set_value('title', $row['title']); ?>" placeholder="Enter Title">
                    <?php echo form_error('title', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="image"><?php echo $this->lang->line('news_image');?> :</label>
                <div class="col-md-3">
                    <img src="<?php echo $row['image_'];?>" width="120" />
                </div>
                <div class="col-md-7 <?php if(isset($image_error)) echo 'has-error'; ?>">
                    <input type="file" class="form-control" name="image">
                    <?php
                        if(isset($image_error)) {
                            echo "<small class='help-block'>".$image_error."</small>";
                        }
                    ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('description')) echo 'has-error'; ?>">
                <label class="col-md-2 control-label" for="description"><?php echo $this->lang->line('news_description');?> :</label>
                <div class="col-md-10">
                    <textarea id="description" name="description" class="form-control"><?php echo set_value('description', $row['description']); ?></textarea>
                    <?php echo form_error('description', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('content')) echo 'has-error'; ?>">
                <label class="col-md-2 control-label" for="content"><?php echo $this->lang->line('news_content');?> :</label>
                <div class="col-md-10">
                    <textarea id="content" name="content" class="form-control"><?php echo set_value('content', $row['content']); ?></textarea>
                    <?php echo form_error('content', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <script type=”text/javascript”>CKEDITOR.replace('content'); </script>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">    
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_save');?></button>
                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </div>
            </div>
        </form>
    </div>
</div>
<script type='text/javascript'>CKEDITOR.replace('content');</script>
<script type='text/javascript'>CKEDITOR.replace('description');</script>