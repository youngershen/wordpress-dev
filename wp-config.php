<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
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
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Tzod|C1G/bL{>&CI2`<@S5G3js<ycXR{lIwWTcO%ad$u/!Vp|Co;)V8ig!:3fx:I');
define('SECURE_AUTH_KEY',  'p}w:bc/bwoaJ(~vXSWV= pQ!f9;^n3:45{f&U.AjL3-79+c6]5alvC/h m5`m0qS');
define('LOGGED_IN_KEY',    'L%PS!LQ<ref47BQ3^aZOtO;TdvLL)Gx.pHx<(H4[Ds6<e6o9{cxI%|TA#Lm@c50c');
define('NONCE_KEY',        'a%ePH|FE]/}$?fKO8cRm8b5#,/oD%aR=qTHn#dR5)<F9lGWbaJY,aG*Q>n/8A>lV');
define('AUTH_SALT',        'F`[ELtdETN#?,=25 :YQ#N7>zL>=sMKiC|Ia)xW3;[WqE$(,oiL1[Yee:B&W33*:');
define('SECURE_AUTH_SALT', 'd.IP,3K:H2#$#G||^ns@jN$Fn;J8.kA4IK$e)$vdh1RzJ&%&<i%!Ykd98~r<@&V4');
define('LOGGED_IN_SALT',   'yqS#dxH..=|jk,9]p4.Ts%BaU+v{GqIW5Zz/0n,Ny$`I`Gv`gaofv;L/t58e=opX');
define('NONCE_SALT',       '*iq( W<h6ob%h.Hbp@,6@(&z8Qt?^ap(+l&^R96;<@D`>7Tb#V6bXhuAefnT3=L}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
