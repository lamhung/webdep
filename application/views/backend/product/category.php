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

