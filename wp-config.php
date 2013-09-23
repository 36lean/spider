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
define('DB_NAME', 'repo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '**p[ur&?W.@ lztsg~#@p/nY&WEU-<]7Ia8Zhm)EM+(~;EkiA=Mh{Gb101*J)m]=');
define('SECURE_AUTH_KEY',  '2*`N$w~_B5f$A<^3}1YT,K+*A,tqwu%P)($*Il{Mb>)]QRt13>zy}6V*6@R#JuvP');
define('LOGGED_IN_KEY',    '{qR8EJN8U*C]520_G5v9?1c[3}Q3onm>X><lff$c urz<=,Fo@$lWUI8xrAus}M0');
define('NONCE_KEY',        'Nqk$cmFRC9)w7-RE/:x Z#%%DomHV~Q?=<,Y?_$Y2~lyOj!<bI5+{mH@^vw4hb?+');
define('AUTH_SALT',        'jVbOX;jr&Gh]06XTnpn%{9)ycONA#y~zajMS;@B`dW8Q$DUQ}J5)UZ.a#lm.M^vn');
define('SECURE_AUTH_SALT', '/rFh*S9W4KyXnN,zff@$Y2_r^zr3W^6M%*<GS,a9Ge-s%&rBLoWKI5?f=k.sovPQ');
define('LOGGED_IN_SALT',   'PT?<@.m2)Fipm0aJv3n_Jhk7QLVlXrw5ZI-!3W_N<H2mFgJN6>,`aE}m2Sd{!N3Q');
define('NONCE_SALT',       'eW[,b*+c#,TjJ&rr8 r3lXd0,+-_t.{7b246h<RH<w6X3 C I?kxrO}b9!+9jlpo');

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
