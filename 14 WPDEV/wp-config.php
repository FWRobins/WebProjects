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
define( 'DB_NAME', 'wpdev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'BlaekDragon1!' );

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
define( 'AUTH_KEY',         'EsQR`:O`OQBNYTOVO-Y$TcmwPBNYaz5K:i]e18$D8m<xbzNd0kt?R:E w;o.er@4' );
define( 'SECURE_AUTH_KEY',  '1v64`#l1uFxt,mP>NeZsbm,Gg:e9Wm<SejV5 T1[Be1U.t*2h1}z+RKY4IBoVK0e' );
define( 'LOGGED_IN_KEY',    '/+Ud`Lo&C(b&jLBvsg^#ODDXgQ_{A.L`gC_[njj:;jYIF:wXsnmJ$cl9d2<KU-!E' );
define( 'NONCE_KEY',        ';QI&6jX pdDTM1$h;5TF=(H0S`BR*`2daSYK{:MyN4CXJ [DNp_{Tc@z<DcbNwBV' );
define( 'AUTH_SALT',        'mnnz+b9utik,V: 8[G0vH4Mh?rTR]]1zXnP)-bcjeR=MuDmI|X*FQd-;0G]gm89:' );
define( 'SECURE_AUTH_SALT', 'x1,(`[`@~[u3Zc[H<tupO~e~MwtME!Tm-uyHNB*qXP-*pp_T-!Wb`[]LWUIx*|RI' );
define( 'LOGGED_IN_SALT',   '^~V+A}$la5-Y}8vCO*WOH[tw6Zv5#O:NnRv9R+KnmOMR$$oVG>hn:BNH/^.0$Ja&' );
define( 'NONCE_SALT',       'BukfpD~noYM 9A]vf-sa-W<L| ok=W#;l}VW+25j[.]|lIvX!F,7I?WpeF-;}(9E' );

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
