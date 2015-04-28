<!-- BEGIN HEADER -->
<?php

    //The platform main header is held in this widget file 
    Zf_ApplicationWidgets::zf_load_widget("header_section", "main_header.php");

?>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDE BAR -->
    <?php
    
        //The platform main side bar held in this widget file
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "main_sidebar.php");

    ?>
    <!-- END SIDE BAR -->
