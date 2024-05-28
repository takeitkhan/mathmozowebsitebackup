<?php
    // Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    // (Optional) Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    function my_acf_settings_show_admin( $show_admin ) {
        return false;
    }


?>