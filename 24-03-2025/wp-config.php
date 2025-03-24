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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 's&s' );



/** Database username */

define( 'DB_USER', 'sandsbrokerage' );



/** Database password */

define( 'DB_PASSWORD', 's&s@2023' );



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
$allowed_ips = [
    '180.151.44.206',
    '103.229.27.26',
    '203.193.167.99',
    '115.247.107.18',
    '183.177.127.146',
    '50.184.119.78',
    '14.195.111.10',
    '122.176.23.236',
    '67.83.5.228',
    '127.0.0.1', // Localhost
    '::1'        // IPv6 Localhost
];
// Define your site URL (Update to your actual site)
$site_url = "https://www.sandsbrokerageinc.com"; // Change this to match your WordPress URL

// Pages to restrict (Add the exact URL path for pages to restrict)
$restricted_pages = [
    "/login",
    "/register",
    "/account",
    "/account/password",
    "/search",
    "/advance-search",
    "/list-user",
    "/user-analytics",
    "/agent-activity-logs",
    "/customers-data",
];

// Check if the user is NOT allowed and trying to access a restricted page
if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
    foreach ($restricted_pages as $page) {
        if (strpos($_SERVER['REQUEST_URI'], $page) === 0) {
            header("HTTP/1.1 302 Found"); // Temporary Redirect
            header("Location: " . $site_url);
            exit();
        }
    }
}

/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}



/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

