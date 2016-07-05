<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group <?php if(form_error('name')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="name"><?php echo $this->lang->line('category_group_name');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name', $row['name']); ?>" placeholder="Enter Name">
                    <?php echo form_error('name', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('ordinal')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="ordinal"><?php echo $this->lang->line('category_group_ordinal');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="ordinal" id="ordinal" value="<?php echo set_value('ordinal', $row['ordinal']); ?>" placeholder="Enter Ordinal">
                    <?php echo form_error('ordinal', "<small class='help-block'>", '</small>'); ?>
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
