<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if( strlen(getenv("DB_NAME")) > 0 ) {
  define('DB_NAME', getenv("DB_NAME"));
} else {
  define('DB_NAME', 'wordpress');
}

/** MySQL database username */
if( strlen(getenv("DB_USER")) > 0 ) {
  define('DB_USER', getenv("DB_USER"));
} else {
  define('DB_USER', 'wordpress');
}

/** MySQL database password */
define('DB_PASSWORD', getenv("DB_PASSWORD"));

/** MySQL hostname */
if( strlen(getenv("DB_HOST")) > 0 ) {
  define('DB_HOST', getenv("DB_HOST"));
} else {
  define('DB_HOST', (getenv("DB_1_PORT_3306_TCP_ADDR") . ":" . getenv("DB_1_PORT_3306_TCP_PORT")));
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** Fix WooCommerce Checkout error */
define('WP_USE_EXT_MYSQL', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9cee0cf855b4d4a98b3687a0cd2064a594e53be1');
define('SECURE_AUTH_KEY',  '4c31f511c853992460fccb5dff0e05b07f3e81b6');
define('LOGGED_IN_KEY',    '617288d16f26cb33f876b3dd1a1f9ac732d9ac39');
define('NONCE_KEY',        'f0633896eb8c6a049db41b631ff43aa47e7245db');
define('AUTH_SALT',        '4770a49cdeb5f4cd7b72da9c4b0655c37a5e70e5');
define('SECURE_AUTH_SALT', '8cd1f20b7db2efdef11193bd502045c246895333');
define('LOGGED_IN_SALT',   'f78241a8e1ab69658e0af6facc99c9552f134423');
define('NONCE_SALT',       '9d102d81461ed7cefb5eaf3c6443c1ca45baa0f1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WP_CACHE',true);
define ('WPLANG', 'zh_CN');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
$plugins = get_option( 'active_plugins' );
if ( count( $plugins ) === 0 ) {
  require_once(ABSPATH .'/wp-admin/includes/plugin.php');
  $wp_rewrite->set_permalink_structure( '/%postname%/' );
  $pluginsToActivate = array( 'nginx-helper/nginx-helper.php' );
  foreach ( $pluginsToActivate as $plugin ) {
    if ( !in_array( $plugin, $plugins ) ) {
      activate_plugin( '/usr/share/nginx/www/wp-content/plugins/' . $plugin );
    }
  }
}
