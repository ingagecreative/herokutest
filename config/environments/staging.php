<?php
/**
 * Configuration overrides for WP_ENV === 'staging'
 */

use Roots\WPConfig\Config;

/**
 * You should try to keep staging as close to production as possible. However,
 * should you need to, you can always override production configuration values
 * with `Config::define`.
 *
 * Example: `Config::define('WP_DEBUG', true);`
 * Example: `Config::define('DISALLOW_FILE_MODS', false);`
 */
$url = parse_url(env('JAWSDB_MARIA_URL'));
putenv(sprintf('DB_NAME=%s', substr($url['path'], 1)));
putenv(sprintf('DB_USER=%s', $url['user']));
putenv(sprintf('DB_PASSWORD=%s', $url['pass']));
putenv(sprintf('DB_HOST=%s', $url['host']));
unset($url);

/**
 * Memcached settings
 */
Config::define('WP_CACHE', true);
global $memcached_servers, $memcached_username, $memcached_password;
$memcached_servers  = array_map(function ($server) {
    return explode(':', $server, 2);
}, explode(',', env('MEMCACHEDCLOUD_SERVERS')));
$memcached_username = env('MEMCACHEDCLOUD_USERNAME');
$memcached_password = env('MEMCACHEDCLOUD_PASSWORD');