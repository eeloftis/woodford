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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-6][=^Jsq[96@M;j5JchI%U3G@biZ0[W/UsJJvj8-*SG;(d#A+4W>r++^h2|O/a7');
define('SECURE_AUTH_KEY',  'X-P|gQ@?3!>9:8ft(Q`kR@4Fhtcg4hLqb%>+/^:(46jcl8-MeMsp{0%hQ <S*T;v');
define('LOGGED_IN_KEY',    '46 zvA=6MLy9N=, &xdH3HVjbP|y7A$u&RA}L`5!M =SimRi;P!!~5O8^4bJ#=R`');
define('NONCE_KEY',        'Z1{Zzz^MfiIaGp<N~~@,5Z?yZ>ln$Co9)iyB]g:{0o2rs25|9)P3r<;(w;N!TD^5');
define('AUTH_SALT',        ',~Aehj^kRZ:zd9z.fV|N1U^J}-FY`G1#HFJ[2iDqH9%Kii{y62RH}5l7&7-vn>2I');
define('SECURE_AUTH_SALT', '~c`Yy2_6k[i45#7pjWgLH::V!ZQZ%-@B2gA8NZ$o3`r?vw<}]TMS86Pl<wvEVVxY');
define('LOGGED_IN_SALT',   'nCy~9*}WOu(j=mS<9yXW0Oy8m4Oy3(J)W+KV,U-HVu~d)cTU[S]y^;I=Hx;p.|=$');
define('NONCE_SALT',       'EXc%rUt]Q?>5.0v)x~yrO.RN`6&kj,oq{ Tq~J3FH<<OW;`T1Kk{P7?{LalI7`Fd');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wood_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
