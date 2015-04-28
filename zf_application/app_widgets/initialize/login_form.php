<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="<?php Zf_GenerateLinks::basic_internal_link("initialize", "authentication", "processLogin"); ?>" method="post">
    <h3 class="form-title">Login to your account</h3>
    <?php
        $zf_widgetFolder = "indicators"; $zf_widgetFile = "initialize_indicator.php";
        Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
    ?>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email Address" name="email" value="<?php echo $zf_formHandler->zf_getFormValue("email"); ?>"/>
        </div>
        <div class="controls server-side-error">
            <?php echo $zf_formHandler->zf_getFormError("email") ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" value="<?php echo $zf_formHandler->zf_getFormValue("password"); ?>"/>
        </div>
        <div class="controls server-side-error">
            <?php echo $zf_formHandler->zf_getFormError("password") ?>
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me 
        </label>
        <button type="submit" class="btn blue pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
    <div><hr class="forgot-password"></div>
    <div class="forget-password inner-headings">
        <h4>Forgot your password ?</h4>
        <p>
            <?php
            $reset_password = array(
                'name' => 'Click here to reset your password',
                'controller' => 'initialize',
                'action' => 'forgot_password',
                'parameter' => '',
                'title' => '',
                'style' => '',
                'id' => 'forget-password'
            );
            Zf_GenerateLinks::zf_internal_link($reset_password);
            ?>
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>