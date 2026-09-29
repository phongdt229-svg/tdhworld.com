<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
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
define( 'DB_NAME', 'tdhworld_home' );

/** Database username */
define( 'DB_USER', 'tdhworld_home' );

/** Database password */
define( 'DB_PASSWORD', 'rUgTcHPHQPdCaP2uUP7f' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('DISABLE_WP_CRON', true);

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
define('AUTH_KEY',         '+MCW?MsXHz@L>omtd}6VF2|s-H2RR=|x|JuPw.Qnvx__kJ)_-G,Do$k- DM+qm/7');
define('SECURE_AUTH_KEY',  '1M-kkFMn(z#mAy8+Ug<B%wa/fs+90It_:w3~Cs1uc<];c)11$7[Z}:~[$snMMR_k');
define('LOGGED_IN_KEY',    '`L3}i1m2|ZZN:4X /l?1+/-.f89RW0UCs2mD`JVZ0+-vG1Yq2r`4!!?o0X~j8Rh/');
define('NONCE_KEY',        ']O>`yxqlEnP!Z2Iu,k>|OH ZeSs oe+D1+H6iAk4Y/|u&NQU<N<tVp#c|Y_p3),p');
define('AUTH_SALT',        '2{t*|)c_(|NbTWIlG_aYk,|o:3+B!a!lI$8s<%,#<RQw[MoV8ad%Rd:9#Ap;P4o~');
define('SECURE_AUTH_SALT', 'CJ^T3L~)MpH2Vv3.YB?|Dvs5D1N!etAQjEZ1{xKdT)B~=VT@cExIGS#e|Y$dWZc7');
define('LOGGED_IN_SALT',   '<IpP}zb+~2zN!@5!.ljFvl%~k,~]D]qC%4o;-lahi-W)3QoDj[E##;|Jjh4}O-4U');
define('NONCE_SALT',       '%WPKE|$vB)o}MqW|y?rR1#qXx-) KS!|qcP8#5JpI>2M67,knz:_NP*ow+H9w5&?');

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';