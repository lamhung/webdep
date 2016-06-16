<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-3 control-label" for="fullname"><?php echo $this->lang->line('user_fullname');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo set_value('fullname', $row['fullname']); ?>" placeholder="Enter Fullname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="username"><?php echo $this->lang->line('user_username');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('fullname', $row['username']);?>" placeholder="Enter Username">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="password"><?php echo $this->lang->line('user_password');?> :</label>
                <div class="col-md-6">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter PassWord">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="group"><?php echo $this->lang->line('user_group');?> :</label>
                <div class="col-md-6">
                    <label class="radio-inline">
                        <input type="radio" name="group" value="1" <?php echo set_radio('group',1, $row['group'] ==1);?>><?php echo $this->lang->line('user_group_1'); ?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="group" value="0" <?php echo set_radio('group',0, $row['group'] ==0);?>><?php echo $this->lang->line('user_group_0'); ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $this->lang->line('user_gender');?> :</label>
                <div class="col-md-6">
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="1" <?php echo set_radio('gender',1, $row['gender'] ==1);?>><?php echo $this->lang->line('user_gender_1'); ?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="0" <?php echo set_radio('gender',0, $row['gender'] ==0);?>><?php echo $this->lang->line('user_gender_0'); ?>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="image"><?php echo $this->lang->line('user_image');?> :</label>
                <div class="col-md-2">
                    <img src="<?php echo $row['image_'];?>" width="120" />
                </div>
                <div class="col-md-4">
                    <input type="file" class="form-control" name="image">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="phone"><?php echo $this->lang->line('user_phone');?> :</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo set_value('phone', $row['phone']); ?>" placeholder="Enter Phone">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="email"><?php echo $this->lang->line('user_email');?> :</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo set_value('email', $row['email']); ?>" placeholder="Enter Name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="address"><?php echo $this->lang->line('user_address');?> :</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="address" id="address"><?php echo set_value('address', $row['address']); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="birhday"><?php echo $this->lang->line('user_birthday');?> :</label>
                <div class="col-md-6">
                    <div class='input-group date' >
                        <input type='text' name="birthday" class="form-control datepicker" id='birthday' value="<?php echo set_value('birthday', $row['birthday']); ?>" placeholder="Chose birthday"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="status"><?php echo $this->lang->line('user_status'); ?>:</label>
                <div class="col-sm-6"> 
                    <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php echo set_radio('status',1, $row['status'] ==1);?>><?php echo $this->lang->line('user_status_1'); ?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php echo set_radio('status',0, $row['status'] ==0);?> ><?php echo $this->lang->line('user_status_0'); ?>
                    </label>
                </div>  
            </div>
            
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">    
                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><?php echo $this->lang->line('btn_add');?></button>
                </div>
            </div>
        </form>
    </div>
</div>
