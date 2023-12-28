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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-practice' );

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
define( 'AUTH_KEY',         'M%}>eE%AgFJ]5Ml+k2R_[!^JrP_(7uPw&Dt~!;3n9+!+:Ei/5<5RYB$Eh>Bqrqy5' );
define( 'SECURE_AUTH_KEY',  ',gtPg!&<|uL-3p@}5V~zz_Qy/t.AaSj8Z;28V;NJ_jnRc(`tPPN`L+V9vh#wA/H^' );
define( 'LOGGED_IN_KEY',    '1F/Si4~yJ}1A{Nz)I82&X+s*7LDgPjUG|3|bbUIdG^{b/X6A,JUTp6R!Wl^_t)ag' );
define( 'NONCE_KEY',        '%^qkTkZQk`,]_GO88S-ESzf`k-I3yv{~/x/p;bHv={-aa?3].b.L@arr/X;h3|;b' );
define( 'AUTH_SALT',        'N.Cu;F!:Js]N]K6;r{r9ew6>zw`R8t|Q7sBn+lrhyZO}@UsTU6/5w6V7_mF)*)Ue' );
define( 'SECURE_AUTH_SALT', 'F}pd2rc|7`s2KaX>~,{%X+v<<&iviZNtTAT4.V9s58!IVS%QU;d+yZI?#mFtuz&^' );
define( 'LOGGED_IN_SALT',   'OM]8,K(^~sPC$G84t6`yiS8Tl|,wOX|d<_WZ 5+cz?mg]5ITXRUK_(Z(,UNVUdvH' );
define( 'NONCE_SALT',       'ESOkm2O ?+.DLS1iN+1Dl+!63#t<pF+ls@!0-%3YdQ* #Y{04/5>@vFS~7RMUYDC' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
