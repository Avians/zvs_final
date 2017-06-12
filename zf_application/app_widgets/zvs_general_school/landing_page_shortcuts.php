<?php

    /**
     * In this section we generate all landing page shortcuts
     */

    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvs_identificationCode");
  
    //Here we load widget that verifies allowed resources
    Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "zvs_landing_page_shortcuts.php", $identificationCode);
    
?>