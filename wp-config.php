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
define('DB_NAME', 'DDG');

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
define('AUTH_KEY',         'bQFN`Oi0&sKTJX@04c`4L2`{T-hA7y~Rb;6_|YzL~{#~-*m<+%E,So&~|j1/n:zL');
define('SECURE_AUTH_KEY',  'Em/ppc^|ja5nAa$gWx,X-@&F-HfM-xiRaMBIpD@/KPnYLAN=xOcsD8*+-xz0[YY%');
define('LOGGED_IN_KEY',    'esxpr?~-Cs&bSK@@F:^trJeV_uXrk=GPE}&<!>::(y:Cl@x;)TM??3@EO&vB/_HJ');
define('NONCE_KEY',        '!s9&R&zwVhPw(mbWl7mTi96& E?Xr7v/btM<j:``e`1!la<pK0.T1z$}Mj**S6J;');
define('AUTH_SALT',        'O_/>T3br#*+6L[@i+Qlfp^)^fIL{zm-5XUc<uy-yv01G}jSLvmC(ID@j8CqA}P2e');
define('SECURE_AUTH_SALT', '.PN5?-Uz~e^G+<sGhod`AnrpeKHL>L:^B,n]8o3.huVMUcdrZvnpOl-qhCxa<f$W');
define('LOGGED_IN_SALT',   '`%k%OwJ/~:DRnJbA3#IZR~E#QUk_|j>S9J>9XuL`21/*ZB@Kas18xP*>@Dp9_WB*');
define('NONCE_SALT',       ' L4G1[G,J4DM,51vvk&~71RqWo^)K6VB|6+HLOT2*^G+dC2XR#J>^)Dyq.:5[#DG');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
