<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wpuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wpuser' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x,aKwH)InBE7foi uW18nHx6;MOZX;XteY7Be*&O p!2}FO[_X|n(_@^L+V>kspz' );
define( 'SECURE_AUTH_KEY',  '`i-x?s#6Ul/Uzx&,nS=z&>_,#jtq_G<orQ@:ZW^Cb+AJbSBPB.id/:s]s[-+-?I}' );
define( 'LOGGED_IN_KEY',    '&]R@Z}re-HuOi~QPIC8R&5Jttc)#=(/>yxJX#kj$+w2_iD#v0.%YgyB-eDtFh8{U' );
define( 'NONCE_KEY',        '6zi~0Fn#1*>?YHATsKej!y;Z%w#Zr)X/E{V!u|E7O(csE1emf7}BLH8=AFJ8Mj^a' );
define( 'AUTH_SALT',        '>v0{`k4MJqWQQL7c/z.nlI!:.kUo?ux,QN_vQuA1*:zYd(!17O.?NBma?%v*UJdY' );
define( 'SECURE_AUTH_SALT', '>1ux{Y5WMIt% C_|ycQ8c*|Iu]t_A=|iOl]^T+KzQ*41a &vZTbXaYdfS;&bh2&^' );
define( 'LOGGED_IN_SALT',   'G:u apH:6d]d@x*pT_~K}Vuf~jh?Zi8L>[BMl&#Tku%SWhJ()S3fO.*y<a(p_$H.' );
define( 'NONCE_SALT',       'KyXt,lg#%I2S8tbjAeD!@K(_IakOEhL!@Dc,aX?Q[r_reJO~0[i0H[u xf[RHp&~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('WP_MEMORY_LIMIT', '256M');
