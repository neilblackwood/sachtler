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

 // determine the current environment
define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));  
 
if(APPLICATION_ENV == 'dev'){
	define('WP_DEBUG', FALSE);
	@ini_set( 'display_errors', 'Off' );
	define('WP_HOME','http://192.168.30.2/sachtler');
	define('WP_SITEURL','http://192.168.30.2/sachtler');	
	define('DB_HOST', '31.25.185.157');
	//define('DB_HOST', 'localhost');
}else{
	define('WP_DEBUG', FALSE);
	@ini_set( 'display_errors', 'Off' );
	define('WP_HOME','http://31.25.185.157/~sachtler');
	define('WP_SITEURL','http://31.25.185.157/~sachtler');
	define('DB_HOST', 'localhost');
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'sachtler');
define('DB_NAME', 'sachtler_wp');

/** MySQL database username */
//define('DB_USER', 'sachtler');
define('DB_USER', 'sachtler_dm');

/** MySQL database password */
define('DB_PASSWORD', 'd351gnm0t1ve');

/** MySQL hostname */
//define('DB_HOST', '31.25.185.157');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-r!sZZZ(H*upS:G`mDoh>_7cNGN*M/8r[xP.:.9g<F]>C|+Ug+uJt4?e8l}?V%5#');
define('SECURE_AUTH_KEY',  'xFfD) ?M}h R!JP%-i+,|+vE,-u{.sX}>&O7X]6LE61#p;rN1uyfb^-9]3D?EF (');
define('LOGGED_IN_KEY',    'x1[E>dK+{bUV]pD0Z:]>6/Y3y|G_9M9ZO%NzU{eN|<Fe /Tb1-E4Yx31m]t8fyY+');
define('NONCE_KEY',        '74/h^7Ri[~!`b^m60p|Szc[45UccU):`$U x{Dc>nBxb[6^]|deHj2$&ci<uXGdi');
define('AUTH_SALT',        'FxcNW3C6h@|{G}#XFu:?<shu=dpv|b ba;~At|,|;0`$r2x`}Z+JZS* dTK2=%|f');
define('SECURE_AUTH_SALT', '+Uv+EUUG:WX&#5b9^HH20;?j:#O1-xAC&@AjbsIpu<6hCKz:!P1iF[LLD`ye%3kL');
define('LOGGED_IN_SALT',   ':X|Btqy%{-&K5)QF8Pz*_1|qyV(/d Y^UZo%7,&v%T/5b7I]8go{< uJ?CUyQP/f');
define('NONCE_SALT',       'LZ-&P%Ihlb-rLMe&Qw^%tERtCL<GMG_-Vl+tTh}_?{cTqi+Whbj(=HkKp%((5B*8');

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
define('WPLANG', '');

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
