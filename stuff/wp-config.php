<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u483172546_Qj1XH' );

/** Database username */
define( 'DB_USER', 'u483172546_L9cGj' );

/** Database password */
define( 'DB_PASSWORD', 'dVj1Q51oyJ' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'tqy|aoKJsxcn6|)XM<Z?E[1IpK,p+q)GFIg{>t)!S@59XNC(7{P&Gr-A;r~],ON}' );
define( 'SECURE_AUTH_KEY',   'P[B ^wF0itOD+A<y,uhkQu;u/(^{B[11Vh .K_jXqsA:(l]3/20W_nM3n5y@fLXC' );
define( 'LOGGED_IN_KEY',     'clFCOP;q]XwD!}5jlj>LqyiXXvxZfX`yhr:AvNoU_-p6V2ZGKe{FA9m4uWCU5B{Z' );
define( 'NONCE_KEY',         '|]{y8pJ7ZR~Kx+~_Y(O8dWFMt~Fk^h1he@b_qZ}VO_{:Y$sbXY[guYx@BiX/Eg:&' );
define( 'AUTH_SALT',         'g<cHGAZjHl*AZRR[~4M.c/_|Ns}If3h-]6=9`&7hJ7TP.6K8G[S _S7}7wBBcqG,' );
define( 'SECURE_AUTH_SALT',  '+}|mu?w-JTkcoM1TW6wh]gBmDx(tN{?+Gy2G#w5,E&*,a$E7!wfY!*g)n4-An_rH' );
define( 'LOGGED_IN_SALT',    '@roKsM9SEww zfsEWeGG_j!7!J0~N#Hj}uyn}a`-Ns8|U);~D/skOzCqx{U6^&Y~' );
define( 'NONCE_SALT',        '5^gN`<O+(JC8b+MjJ:wJT/=y?d+Z,I9)yw;ds?J~Cyx}4HZ=#R}.wygTk,8]6BXv' );
define( 'WP_CACHE_KEY_SALT', 'u|rec5NxrRb!R,JDJ1h+tOrwkVB=QG@qN[LGyYSx<Q9#M<NRGMJIU;)JT(][3AyX' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
