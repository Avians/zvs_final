<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="<?php Zf_GenerateLinks::basic_internal_link("initialize", "authentication", "resetPassword"); ?>" method="post">
    <h3 class="form-title">Forgot your password ?</h3>
    <div><hr class="forgot-password"></div>
    <div class="forget-password inner-headings">
        <h4 style="font-size: 14px !important; text-align: center; color: #0DA3E2 !important;">Enter your email address to reset password.</h4>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email Address" name="email" value="<?php echo $zf_formHandler->zf_getFormValue("email"); ?>"/>
        </div>
        <div class="controls server-side-error">
            <?php echo $zf_formHandler->zf_getFormError("email") ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-actions">
        <a href="<?php Zf_GenerateLinks::basic_internal_link('initialize'); ?>">
            <button type="button" class="btn" style="color: #575757 !important;">
                <i  style="color: #0DA3E2 !important;" class="m-icon-swapleft"></i> Login
            </button>
        </a>
        <button type="submit" class="btn blue pull-right">
            Reset <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
<!-- END LOGIN FORM -->
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>