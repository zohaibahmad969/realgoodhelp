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

define( 'DB_NAME', "realgelp_master_realgh" );


/** Database username */

define( 'DB_USER', "root" );


/** Database password */

define( 'DB_PASSWORD', "" );


/** Database hostname */

define( 'DB_HOST', "localhost" );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );


/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );

/*

 * SMTP Settings

*/
define( 'SMTP_HOST',   'gator2118.hostgator.com' );    // The hostname of the mail server
define( 'SMTP_USER',   'admin@realgoodhelp.com' );           // Username to use for SMTP authentication
define( 'SMTP_PASS',   'aV^j4W+xHWI;' );          // Password to use for SMTP authentication
define( 'SMTP_FROM',   'admin@realgoodhelp.com' ); // SMTP From email address
define( 'SMTP_PORT',   '465' );                  // SMTP port number - likely to be 25, 465 or 587
define( 'SMTP_SECURE', 'ssl' );                 // Encryption system to use - ssl or tls
define( 'SMTP_AUTH',    true );                 // Use SMTP authentication (true|false)
define( 'SMTP_DEBUG',   0 );                    // for debugging purposes only set to 1 or 2


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

define( 'AUTH_KEY',         ';jAui$0MO>xUq5seQ_?o*OJ6qByC@ BP`XT3<B~Qi!z1.M{Ku}B$JmN|YB8I{[9u' );

define( 'SECURE_AUTH_KEY',  'foc[3`mF^X8C_t[d])M|r./d=L<TYO[3[Pdy@7w%NBb?@{YTBQpeCQ{DiaS_;;`P' );

define( 'LOGGED_IN_KEY',    'axGfwN&z(Ksrc=iS%r#4=J(B)%My?nV2:5Tub5Z2,R=AI)Shm62HqehGFs;%|q<L' );

define( 'NONCE_KEY',        '];KX$F)l)Hf5Bm{8s+d1d5RtQ3nBhl(Zfr|t<fdvvqD#8Vb$.C[C|tVT~ qE@*pd' );

define( 'AUTH_SALT',        '5+lJ?m>h?Y%S@(H[X(vt)E>/!(9B!eWgdjn;qD^ H~<1lEqY:c>4U3EboPGY{ZMI' );

define( 'SECURE_AUTH_SALT', '|X-x,&u]%l}cZ=0_M4|FB{;-a+jqUiXzM]<-+F>w!r?oXlA?*LRcB6$Q!:MGPwg*' );

define( 'LOGGED_IN_SALT',   '.T%!@=?E!=ev}6F^P5*PjV6VVM>K~5FU,=ZwxXYv4K+WVvq^VlN2/iN4*;<!h88w' );

define( 'NONCE_SALT',       'E]wO4dt3lZv0|;+j8Nez(xwzH@12vDA;M}W[eDJ|=hgCoN|*[1c(9uO`z32H,MM:' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'rlgh_';


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

define( 'WP_DEBUG_LOG', false );
/* Add any custom values between this line and the "stop editing" line. */




/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

