<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group <?php if(form_error('weblink')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="weblink"><?php echo $this->lang->line('banner_weblink');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="weblink" id="weblink" value="<?php echo set_value('weblink', $row['weblink']); ?>" placeholder="Enter Fullname">
                    <?php echo form_error('weblink', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('company')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="company"><?php echo $this->lang->line('banner_company');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="company" id="company" value="<?php echo set_value('company', $row['company']);?>" placeholder="Enter Username">
                    <?php echo form_error('company', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('posted_date')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="posted_date"><?php echo $this->lang->line('banner_posted_date');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control datepicker1" name="posted_date" id="posted_date" value="<?php echo set_value('posted_date', $row['posted_date_']);?>" placeholder="Enter Posted Date" readonly="on">
                    <?php echo form_error('posted_date', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group <?php if(form_error('expiration_date')) echo 'has-error'; ?>">
                <label class="col-md-3 control-label" for="expiration_date"><?php echo $this->lang->line('banner_expiration_date');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control datepicker2" name="expiration_date" id="expiration_date" value="<?php echo set_value('expiration_date', $row['expiration_date_']);?>" placeholder="Enter Expiration Date" readonly="on">
                    <?php echo form_error('expiration_date', "<small class='help-block'>", '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="image"><?php echo $this->lang->line('banner_orig_name');?> :</label>
                <div class="col-md-2">
                    <img src="<?php echo $row['image_'];?>" width="120" />
                </div>
                <div class="col-md-4 <?php if(isset($image_error)) echo 'has-error'; ?>">
                    <input type="file" class="form-control" name="image">
                    <?php
                        if(isset($image_error)) {
                            echo "<small class='help-block'>".$image_error."</small>";
                        }
                    ?>
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
<script type="text/javascript">
    $(function () {
        var dateToday = new Date();
        var yrRange = (dateToday.getFullYear() - 80) + ":" + (dateToday.getFullYear() - 10);
        $( ".datepicker1" ).datepicker({
            dateFormat: 'dd-mm-yy',
            //maxDate: '-3650',
            changeMonth: true,
            changeYear: true,
            //yearRange : yrRange
        });
        $( ".datepicker2" ).datepicker({
            dateFormat: 'dd-mm-yy',
            //maxDate: '-3650',
            changeMonth: true,
            changeYear: true,
            //yearRange : yrRange
        });
        $.datepicker.setDefaults($.datepicker.regional[REGIONAL]);
    });
    
 
     
</script>