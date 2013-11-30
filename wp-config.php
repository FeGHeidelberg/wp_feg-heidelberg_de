<?php
/**
 * In dieser Datei werden die Grundeinstellungen für WordPress vorgenommen.
 *
 * Zu diesen Einstellungen gehören: MySQL-Zugangsdaten, Tabellenpräfix,
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es auf der {@link http://codex.wordpress.org/Editing_wp-config.php
 * wp-config.php editieren} Seite im Codex. Die Informationen für die MySQL-Datenbank bekommst du von deinem Webhoster.
 *
 * Diese Datei wird von der wp-config.php-Erzeugungsroutine verwendet. Sie wird ausgeführt, wenn noch keine wp-config.php (aber eine wp-config-sample.php) vorhanden ist,
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */

/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
/**  Ersetze database_name_here mit dem Namen der Datenbank, die du verwenden möchtest. */
define('DB_NAME', 'feg-heidel_wp');

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define('DB_USER', 'root');

/** Ersetze password_here mit deinem MySQL-Passwort */
define('DB_PASSWORD', 'wpdb-bb');

/** Ersetze localhost mit der MySQL-Serveradresse */
define('DB_HOST', 'localhost');

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define('DB_CHARSET', 'utf8');

/** Der collate type sollte nicht geändert werden */
define('DB_COLLATE', '');

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden KEY in eine beliebige, möglichst einzigartige Phrase. 
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service} kannst du dir alle KEYS generieren lassen.
 * Bitte trage für jeden KEY eine eigene Phrase ein. Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten Benutzer müssen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define('AUTH_KEY',         ')c/`g%#|^eBh2V!,L|7ggzP/01Fkg;MoZ}l[CivGGMfFeuYimJ8(f-@T+,$FL2SC');
define('SECURE_AUTH_KEY',  'i3F#ePY7x[RXa|gsVwI_iYwka#YW]?r|OKZ+2W`)}|9cN<eEiMr ke-nOo57?5h&');
define('LOGGED_IN_KEY',    '2{5^BX0P)#er+30go-)6.xK)k7#?`=.et}ec,RnX,l,~DbhKGt;t>xkiPl)#;SWZ');
define('NONCE_KEY',        'TPG-lI:pIY]-E;[&58Ti)=xu!|koc3qhLT*,2-n>(y^+WuxH!)ylps?$F{7yh[O+');
define('AUTH_SALT',        'LF);d%ah~iRi x:BeGm}AA.gYf1/?lJq)UcfS9`{qe|OO2Yz -uUU3G1I#K)=#CX');
define('SECURE_AUTH_SALT', 'y!=?_SL?^XU9:=J_ Vr@gC%s9g!-T%^<_]L;x%S]X!HT[^Yo::QxHaWY=-1Z50Cj');
define('LOGGED_IN_SALT',   'gfO&>.;Nh}!o&$`jYF0Q@4AK*9/sfXgMX!u?k9|~/+m}+=QT43Jah~(/?T.8wr?g');
define('NONCE_SALT',       'g}WynaApS$4EkQw~v /`0U<0Z77]mPJf=7#^O-I]aY(RjRt->S]98!QTy|omNowk');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 *  Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Sprachdatei
 *
 * Hier kannst du einstellen, welche Sprachdatei benutzt werden soll. Die entsprechende
 * Sprachdatei muss im Ordner wp-content/languages vorhanden sein, beispielsweise de_DE.mo
 * Wenn du nichts einträgst, wird Englisch genommen.
 */
define('WPLANG', 'de_DE');

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