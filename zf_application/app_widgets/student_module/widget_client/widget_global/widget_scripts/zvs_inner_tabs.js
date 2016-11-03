<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab One
        $('#formsTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_2', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            },
            activetab_bg: '#FFFFFF', // background color for active tabs in this group
            inactive_bg: '#57B5E3 !important', // background color for inactive tabs in this group
            active_border_color: '#9C905C', // border color for active tabs heads in this group
            active_content_border_color: '#9C905C' // border color for active tabs contect in this group so that it matches the tab head border
        });
        
        //Horizontal Tab Two
        $('#confirmationTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_2', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            },
            activetab_bg: '#FFFFFF', // background color for active tabs in this group
            inactive_bg: '#57B5E3 !important', // background color for inactive tabs in this group
            active_border_color: '#9C905C', // border color for active tabs heads in this group
            active_content_border_color: '#9C905C' // border color for active tabs contect in this group so that it matches the tab head border
        });
    });
</script>