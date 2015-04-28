<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
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
define('DB_USER', 'admin');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         'I1wO]++HR+}pS(}xwy[kn$Lo%r5zBw;WN*<^5=]5LkXCv*fcE{;`hY3+6rg$jQ3f');
define('SECURE_AUTH_KEY',  '1*#0Avp0`.8|WbGAGbY(VlpcCq c}vWx:8hnq+ph[v_$%OGtMrZJ!H+#-7Bda3-_');
define('LOGGED_IN_KEY',    '[KX7N2ODJ0m4F<|j3Lb6xoL6g@z$mozN0bp(`%q ogXpbIj+op|w _[1L-L<<iy{');
define('NONCE_KEY',        '?YbLOWf;~Ct%qz+>m*-|Y[J_sK*mY{m_?t|fyhD,$7r$vo6KLR?|K%^khh0xE_.w');
define('AUTH_SALT',        ' ;~Wq[Z<X}2O~4u<J2*,(aPGo?4wG.,>yk|E9!S|.:$WO7+IuNA(.Eh<$uS2cR)y');
define('SECURE_AUTH_SALT', 'ez~A%{9e|`8ECUZ.9%)|cN$UB9yxnD(TP+- [ZlhJ<m)uhkUE{W@kbef|Q<+[Z&i');
define('LOGGED_IN_SALT',   'c{<]{NI !T+9EL?6auW<nyXA:`g+=DV/45LW|K:<2i.!_j|8nm~?)SK2feI(>^e!');
define('NONCE_SALT',       'nGl*g p`3@|x-6[hkYKq!M&%TDgtz20qZhg?#xcQZ[K!p33?=H^GKWt-3L5+w-YX');

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
