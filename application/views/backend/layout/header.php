<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CMS -> Trang chủ</title>
        <link href="<?php echo base_url('assets/backend/css/style.css'); ?>" rel="stylesheet"/>
        <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-toggle.min.css'); ?>" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url('vendor/jquery/jquery-2.2.3.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('vendor/bootstrap/js/bootstrap-toggle.min.js'); ?>"></script>
        <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    </head>
    <body>
        <?php 
            $user_login = $this->session->userdata('user_login'); 
        ?>
        <div class="header navbar-inverse">
            <nav class="navbar" style = "margin-bottom : 0px">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header_top">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="" class="navbar-brand">CMS -> WEB ĐẸP</a>
                </div>
                <div class="navbar-collapse collapse " id="header_top">
                    <ul class="nav navbar-nav navbar-right nav_top">
                        <li><a href=""><span class="icons_welcome"></span>Xin Chào: <?php echo $user_login['fullname'];?></a></li>
                        <li><a href=""><span class="icons_user_info"></span>Cập Nhật Thông Tin Cá Nhân</a></li>
                        <li><a href=""><span class="icons_vietnam"></span>Tiếng Việt</a></li>
                        <li><a href=""><span class="icons_english"></span>English</a></li>
                        <li><a href="<?php echo base_url('acp/logout');?>"><span class="icons_exit"></span>Thoát</a></li>
                    </ul>
                </div>
            </nav>
        </div><!--END HEADER-->
        <div class="menu">
            <nav class="navbar navbar-default" style = 'margin-bottom:0;'>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="" class="navbar-brand home"><span class="glyphicon glyphicon-home" style="font-size: 20px;"></span></a>
                </div>
                <div class="navbar-collapse collapse" id="menu">
                    <ul class="nav navbar-nav nav_menu">
                        <li class="active dropdown">
                            <a href="<?php echo base_url('acp/user');?>" data-toggle = 'dropdown'><span class="glyphicon glyphicon-user">&nbsp;</span>User<span class="caret">&nbsp;</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('acp/user/add');?>"><?php echo $this->lang->line('user_add');?></a></li>
                                <li><a href="<?php echo base_url('acp/user');?>"><?php echo $this->lang->line('user_list');?></a></li>
                            </ul>
                        </li>
                        <li><a href=""><span class="glyphicon glyphicon-blackboard">&nbsp;</span>Banner</a></li>
                        <li><a href="">Product</a></li>
                        <li><a href="">New</a></li>
                    </ul>
                </div>
            </nav>
        </div><!--END MENU-->
        <div class="note">
            <marquee behavior="scroll" align="left" scrollamount="4" >
                <img src="<?php echo base_url('assets/backend/img/icons/news.png'); ?>" alt="" />Lưu ý: Mã nguồn do công ty chúng tôi phát triển - Tuyệt đối không xài mã nguồn mở ( joomla, wordpress... ) - Quí khách có nhu cầu thêm chức năng vui lòng liên hệ : 123456
            </marquee>
        </div><!--END NOTE-->

        <div class="clear"></div>
        <div style = 'height: 30px;'></div>
        <!-- ///////////////////////////////////////////////// BEGIN MODUEL ///////////////////////////////////////////////////////////////////////-->
        <div class="container-fluid">
            <div class="wrapper">

