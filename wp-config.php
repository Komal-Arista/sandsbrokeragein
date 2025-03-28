<?php
# BEGIN WP Cache by 10Web
define( 'WP_CACHE', true );
define( 'TWO_PLUGIN_DIR_CACHE', '/home/sandsportal/public_html/wp-content/plugins/tenweb-speed-optimizer/' );
# END WP Cache by 10Web
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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 's&s' );



/** Database username */

define( 'DB_USER', 'root' );



/** Database password */

define( 'DB_PASSWORD', '' );



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

define( 'AUTH_KEY',         'A32RsR`UFB^iD%1KwN4dwpj16Pb^R){8;$>!/r6+T~<>&j`pt>l8[u[)6{OI?iTP' );

define( 'SECURE_AUTH_KEY',  'v`K ]?l;n-=ul6vn>gw2Rp{a^q-<@K6r@>nDD.SOuMSYF/%3pl.qC6HmX OF3*rw' );

define( 'LOGGED_IN_KEY',    '+mW!z;&<:!=_({=!jgYQQ]_14[,Id06h$CXTvv%_{RXV*( /]+K3RNgL%=Jp3I4:' );

define( 'NONCE_KEY',        '$/x>u[N@3mtrnWO{#rjr;E:&F]3QbS?;4ZeYPvsIpuCAB>tFLWx8,7rM$Vq:!uu$' );

define( 'AUTH_SALT',        'tR3AHDr&*`a?MY~~qVB_!Y:6<`E({!RPV;ZBoJ!!A!Q-kGaf`c%FSX1Hoz)Za|BT' );

define( 'SECURE_AUTH_SALT', '-!msa)2?)p}R@K#$H&~lp[|,2R]bIB{$^rj5:b](kw}1pnIcQdNFG6/Q>Xm s?^|' );

define( 'LOGGED_IN_SALT',   '%CJfR|.,}Doc9Aq|H0(LrqQY%%z.)uP^)Kwn,f]TI4pMErRo~cOLXPsimWQ~?)A3' );

define( 'NONCE_SALT',       'U<9]&TI74,D;:>`gzM$L3ZE[).u$z6MTlKuQm[5i+!k3fNDk#.mEdYaZXGRXbQ;Y' );



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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

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

