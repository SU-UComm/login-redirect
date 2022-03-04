<?php
/**
 * Plugin Name: Login Redirect
 * Description: Some plugins set login redirects to $_SERVER['SERVER_NAME'], which fails on Pantheon servers. Use site_url() instead.
 * Author: JB Christy
 * Author URI: https://www.stanford.edu/site
 * Text Domain: stanvord
 * Version: 1.00
 * License: GPLv2
 */

namespace Stanford\Login_Redirect;

/**
 * The LH Private Content Login plugin sometimes gives us a wonky host name in the url
 * we're being redirected to. In a Local by Flywheel dev environment, it includes Local's
 * port, which doesn't work. On Pantheon servers, it uses $_SERVER['SERVER_NAME'],
 * e.g. appserver-440fae55-nginx-74fc8f611e5f4fc29105c69b83f33b42:11559. This function
 * replaces the host:port with site_url.
 * Invoked via the login_redirect filter.
 *
 * @param string $redirect_to - where we want to end up
 * @param string $requested_redirect_to - also where we want to end up??? - ignored
 * @param \WP_User | \WP_Error $user - WP_Error if logged out - ignored
 * @return string url to redirect to
 */
function fix_hostname( $redirect_to, $requested_redirect_to, $user ) {
  $url = site_url( parse_url( $redirect_to, PHP_URL_PATH ) );
  return $url;
}
add_filter( 'login_redirect', 'Stanford\Login_Redirect\fix_hostname', 99, 3 );
