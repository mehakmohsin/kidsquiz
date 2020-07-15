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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'quizkids' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '(D6+Z&]wBNBrXkc:ghC!&)uMKufl)UU,@kJ=~})}^qAd/rV*m?Go,4(/Ct*pjRE{' );
define( 'SECURE_AUTH_KEY',  'Gq<3J3;qZ4 <d7klxlXL2oUXTR`Gw>i2a>NjYvG)E(8E5:T%nDiI>*YFIzH?OPZJ' );
define( 'LOGGED_IN_KEY',    '.>>*6F.~5`6d@|;sdv`!D{XqgXc/35!$(g5EGh5!TCf^vM%P?on;T^Ou3KGdThx`' );
define( 'NONCE_KEY',        'V^^+85a3{oMd-FO4W}?,u<_8ZP;s*CRD/17,Ty7n8Vtg%9I(zFRf3&DY}LqW%NuT' );
define( 'AUTH_SALT',        'nFW~5iok16|cM.{&B{LpeXnl]%yJ?AXTY>1L>(xty2u!  x]T6;I;%d!^+`?Qzms' );
define( 'SECURE_AUTH_SALT', '&_:LB]&qQNUE_=dC%H!iFEoVwQ/##10@s0fa*+6gaVyE-yV[jj$qo1QBCXQk1lOI' );
define( 'LOGGED_IN_SALT',   '9<s0Iu6z_{NaNpCZbFX3uP4mnE)U/V>j~!.r7@vGig+yV3;m-.+~-]Z Dra%FX0 ' );
define( 'NONCE_SALT',       'T?l+J}?@2~T7|ES>992d(/,jHYQ6:IA$=}?o}~R#XH+3l.yfOFA?~i012W!7Y>&q' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'qk_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
