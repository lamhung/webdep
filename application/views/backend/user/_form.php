<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $this->lang->line('user_fullname');?> :</label>
                <div class="col-md-6">
                    <input class="form-control" name="fullname" placeholder="Enter Fullname">
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