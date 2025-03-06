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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '$q:jIJ/DFKe5-&%kG=T-ELh9]%h|8f[KamE,An`B;TZd)R74Y.Ijm}BA0W8OhHe=' );
define( 'SECURE_AUTH_KEY',   '^:Kjhkydq&A%j8a{M^CDp%=UZPqDhr@cVR+ eEi4is;SbD&TTI1~=KEG7=;mU;Z9' );
define( 'LOGGED_IN_KEY',     'E:iiQP+7^)cwAIDgQC3pC)sFBgAOb,;sRZX*5d!Es>6hg[P:QN@W%A56Dhx&XOn`' );
define( 'NONCE_KEY',         'a</21.[HsO-Ui1p{-3%crA^Wjx+<}7.:`?{w$-l0dF<GzH>jO(TvJqo+thXglT20' );
define( 'AUTH_SALT',         '`0,@+n<I~ &l|Y.f`$%}x,~}-E^z1[QsRFCyK^(iZ9z[&vX5v4LcATfiE<Ems~nr' );
define( 'SECURE_AUTH_SALT',  'E1FtVZE:)]C0uTTCiAtKJ5&yGXR!.2?&Odnk;2Xva8x12pA8F<fLA(B{.H0ElKiV' );
define( 'LOGGED_IN_SALT',    'Ws)^X^b>#x/6etBnn3ock>bT@h:o,EYx_qhuS9P^U_jH!6laRG7CzgS&D,s!|sLd' );
define( 'NONCE_SALT',        'q?2&ETvUpUtDA4ea$:d/`(Sne[U kLrsqJ r(6^4Y/s/M;J%fUV$:rBu~!wDr2XA' );
define( 'WP_CACHE_KEY_SALT', '>s7p7v8U!m XE4E)$dz2#`G~KB,C#8I97$uTO&P-XDt<fd5~4_c%aBi{ZA@!:@5w' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/* Add any custom values between this line and the "stop editing" line. */

// GEM App Integration Settings
define('GEM_APP_API_URL', 'https://api.gemapp.com/v1');
define('GEM_APP_DEBUG', true); // Enable debugging for GEM App integration

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
    define( 'WP_MEMORY_LIMIT', '96M' );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
