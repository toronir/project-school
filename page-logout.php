<?php
/*
Template name: Wyloguj
*/

wp_destroy_current_session();
wp_clear_auth_cookie();
wp_set_current_user( 0 );
wp_safe_redirect( home_url() );

?>
