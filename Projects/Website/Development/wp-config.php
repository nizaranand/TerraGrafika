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
define('DB_NAME', 'terra');

/** MySQL database username */
define('DB_USER', 'vertex');

/** MySQL database password */
define('DB_PASSWORD', 'Thevertex01');

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
define('AUTH_KEY',         's!|(4)S+.4<^>!DyENgcP8W|SGBiQP3{QUd+dW=RQ&[L0Z-H f~~<Pr4k{fHgCgv');
define('SECURE_AUTH_KEY',  'pQ,U(_>D)IKLHL+Bwbbs[vPEUP QJsMq%wP%h/i(b,yX_6F_I||;P7}up5fM@FLO');
define('LOGGED_IN_KEY',    'p6&UChr)|ky(Vv8uy|*%!}lm7Mw0FR(@0@Er2lGvYmQf;bB)/I!p_Fw+bT+cSK9&');
define('NONCE_KEY',        'j8V|Es25B|Lty- eVXb^,1er&{?[pt8fRc$c~wr@R6fST_UNWStF%$Hn|{LapF,a');
define('AUTH_SALT',        'C*srqQafjGA_nFjz4[bM}[MF+QXn^{E*m+!/| r9(D$}8tV;%32OT[.M<e0ick{6');
define('SECURE_AUTH_SALT', 'OvQsmd|<Jb!ow-{A|SCz5H6f}w[IH;i&Q&kTK)Y~(rB=Nhz-[r|ZWmS;?X{o~3MG');
define('LOGGED_IN_SALT',   'LkcqaZ4L-E6oj88hxZ-]DqC$BDZw=F)XI*1UIh7-V3?jP+zWKw5-[(9m$v|EFX%L');
define('NONCE_SALT',       'UNRsYDuppU(|wG#g,(7Hp2+jzBSB]K^yzIR,~KUmQ^5+QP(wR+J1 %.NDs]0h +i');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
