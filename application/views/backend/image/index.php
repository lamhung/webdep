<link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-toggle.min.css'); ?>" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url('vendor/jquery/jquery-2.2.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('vendor/bootstrap/js/bootstrap-toggle.min.js'); ?>"></script>
<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
<style>
    #up_img {margin-bottom: 30px;}
    .row {margin-left: 10px;}
    .button {margin-top: 5px;margin-bottom: 5px; text-align: center;}
    .img {text-align: center; border: 1px solid #999999}
    .img img {padding: 5px; width: 100%;}
    .image {border: 1px solid #666666; margin-left: 10px; width: 200px; float: left; margin-bottom: 10px;}
    .form-control {}
</style>
<div class="row" id="up_img">
    <form name="image_form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" >
        <div class="form-group <?php if(isset($image_error)) echo 'has-error'; ?>">
            <label class="col-md-1 control-label" for="image" style="float: left;">Hình ảnh : </label>
            <div class="col-md-3" style="float: left;">
                <input type="file" name="images[]" class="form-control" id="image" multiple>
            </div>
            <div class="col-md-1" style="float: left;">
                <input type="submit" name="submit" class="form-control" id="submit" value="Upload">
            </div>
            <?php 
            if(isset($image_error)) {
                echo "<small class='help-block'>".$image_error."</small>";
            }
            ?>
        </div>
        
    </form>
</div>
<div class="row">
    <?php
    foreach ($rows as $row) {
        $row = $this->image_model->convert_data($row);
    ?>
    <div class="col-md-2 image">
        <div class="img">
            <img src="<?php echo $row['image_'];?>">
        </div>
        <div class="button">
            <a href="javascript:parent.insertImage('<?php echo base_url('uploads/post/'.$row['file_name']);?>')" class="btn btn-sm btn-primary active" role="button">Img</a>
            <a href="javascript:parent.insertThumb('<?php echo base_url('uploads/post/'.$row['path_folder'].'/thumbnail/'.$row['raw_name'].$row['file_ext']);?>')" class="btn btn-sm btn-primary active" role="button">thumb</a>
            <a href="" class="btn btn-sm btn-danger active" role="button" onclick="return parent.deleteImage('<?php echo base_url('uploads/post/'.$row['file_name']);?>','<?php echo base_url('uploads/post/'.$row['path_folder'].'/thumbnail/'.$row['raw_name'].$row['file_ext']);?>'), ajax_deleteImage(<?php echo $row['id'];?>)">Xóa</a>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<script>
    function ajax_deleteImage(image_id){
        $.ajax({
           type : 'post',
           url : "<?php echo base_url('acp/image/ajax_deleteImage');?>",
           data : {image_id : image_id},
           success : function(respone) {
               
           }
           
        });
    }
</script>
