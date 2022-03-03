<?php
/**
 * Plugin Name: Login Redirect
 * Description: Some plugins set login redirects to $_SERVER['SERVER_NAME'], which fails on Pantheon servers. Use $_SERVER['HTTP_HOST] instead.
 * Author: JB Christy
 * Author URI: https://www.stanford.edu/site
 * Text Domain: stanvord
 * Version: 1.00
 * License: GPLv2
 */

namespace Stanford\Login_Redirect;

function fix_hostname( string $redirect_to, string $requested_redirect_to, WP_User $user ) {
  if ( function_exists( '\Stanford\ConsoleLog\console_log' ) ) {
    \Stanford\ConsoleLog\console_log( [
      '$redirect_to'           => $redirect_to,
      '$requested_redirect_to' => $requested_redirect_to,
      '$user'                  => $user,
    ] );
  }
  return $redirect_to;
}
add_filter( 'login_redirct', 'Stanford\Login_Redirect\fix_hostname', 99, 3 );