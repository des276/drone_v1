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
define('DB_NAME', 'themedia_dji');

/** MySQL database username */
define('DB_USER', 'themedia_dji');

/** MySQL database password */
define('DB_PASSWORD', 'vimbly123');

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
define('AUTH_KEY',         '~|iN[s*9Yq>9[ UwOzU(Kb~KV/COA|dA=.rxHeRvNYCVA7rgA=EVXB+Z) &C!iw,');
define('SECURE_AUTH_KEY',  'y+e32U>zln^pGFtOF-Cf|:n$eYfTOkbJ.s)+qYy.Z[dSMTC&0dQz|:?< ;<dbxM~');
define('LOGGED_IN_KEY',    'U00C}!1wD^jmHo2-W>y]|LjDeEZ7@@sMeblMG-H,;JI>g}M94VObE<#<OaRS1[LA');
define('NONCE_KEY',        ',yjZ_vmn2B]/?-$_5|!7lU6.4tAxXe:1<Gl4Cb.3k-As6Sz}[)xMhHA/}< #Aq<O');
define('AUTH_SALT',        'smacTHZ)o`t)svhy#sOB|nPU;k?PrOjRW&]9b:|&GTJGr 1]wbT~`d;7!/duGo}4');
define('SECURE_AUTH_SALT', 'SES&1flgTKC=;Ps-$c&cA}6%FaCf0$yW=%fE<Iz4 -4dvQqIO?NH5*Os)1ujs_[.');
define('LOGGED_IN_SALT',   'R.oOw|}GVTFoPWJAo8{W`}O_A_W.p5|rfX^Z)cDs|gzRW2EyWjrUR9?Q^xOnU+qv');
define('NONCE_SALT',       ':9QKeorWWbE2LE#A`.w{gjdzD&$cS=2AslXYVYXtYQ%uP=pM$?Nvx~B6go0/ddGl');

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