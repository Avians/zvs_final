        </div>
        <!-- END CONTAINER -->
        
        
        <?php
        
        if(empty($activeURL[0]) || ($activeURL[0] == "initialize" && empty($activeURL[1])) || ($activeURL[0] == "initialize" && ($activeURL[1] == "authentication" || $activeURL[1] == "forgot_password"))){
            
            //Login form footer is held in this widget file
            Zf_ApplicationWidgets::zf_load_widget("initialize", "form_footer.php");
            
        }else{
            
            //Dashboard footer is held in this widget file.
            Zf_ApplicationWidgets::zf_load_widget("footer_section", "dashboard_footer.php"); 
            
        }
 
            
        ?>
        
        <!--This is the javascript that dictates the zozo tabs-->
        <script type="text/javascript">
            $(document).ready(function() { 
                /* default activation and setting options for all the tabs*/
                 var tabbedNav = $("#tabbed-nav").zozoTabs({
                     position: "top-left",
                     theme: "silver",
                     rounded: true,
                     shadows: true,
                     size: "small",
                     animation: {
                         duration: 600,
                         easing: "easeOutQuint",
                         effects: "none"
                     },
                     defaultTab: "tab1"
                 });

            });
        </script>
        
    </body>
</html>
