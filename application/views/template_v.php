<html>
<head >
    <?php $this -> load -> view('tmpl_head_v'); ?>
</head>
<body class="container" style="width: 99%;">  
    <div class="" style="margin: 0 0 0 0;">
        <div class="" id=""><b><?php echo date("l, d F Y");?></b> 
            <span>|</span> 
            <span class="">
                Welcome 
                <a href="<?php echo base_url("user/profile");?>"> <i class="icon user"></i> <?php //echo $this->user_description();?></a>                    
            </span>
            <span class="text-separator">|</span>
        </div>
    </div>

    <div id="title">
        <?php $this -> load -> view('tmpl_title_v'); ?>
    </div>
    <div id="header">
        <?php
        if(isset($hide_menu)==false){
            $this -> load -> view('tmpl_header_v');
        } ?>
    </div>
    <div id="content_view" >
        <div class= "row" >
            <div id="sidemenu" class="col-md-2 sidemenu" > <?php $this -> load -> view('tmpl_side_menu_v'); ?></div>
            <div id="main" class="col-md-10 main"><?php $this -> load -> view($content_view); ?>             
                <?php $this->filters->index(); ?>
            </div>
        </div>
    </div>
    <div id="footer">
        <?php $this -> load -> view('tmpl_footer_v'); ?>
    </div>
    <?php $this -> load -> view('modals'); ?>
</body>
</html>
