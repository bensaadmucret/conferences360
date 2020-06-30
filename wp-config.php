<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'conferences360-prod');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'conferences-prod');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'sn^K3l77');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost:3306');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hQQS%(Iv5-n1Bl}u-)& +F2|D]edxR:RQxG}B(r%Nm1$[dU`MVogU@brkEXy =u@');
define('SECURE_AUTH_KEY',  '6W#f42ct#c;KHK]`IEgFNoNCW!x?&4~ji]O,46q.GLWH?:EC0MFBaUydLf/IC{S=');
define('LOGGED_IN_KEY',    '@|b AQua?4.l#P{=hbfr^=t/4%v)Mr597XR]mf)I><y&wt1rj;^Mx:xuUcb=$-hx');
define('NONCE_KEY',        '~,25QD|,`S&/*.#&+ml<f2wiPA 3El2R/8 ;mg6gl-p(eZeBjY{ve=[(7Q0A4{,V');
define('AUTH_SALT',        'g`6P_+$]L5w2DfJdE+]rSrp>rxE=zy@pnxV/#RrpvJBdxMBUt2(d2=d-zMLI!?=s');
define('SECURE_AUTH_SALT', 'iY(bY#(SVdmvA;gIA?/B84d ,-Q49w5z;,%Gz9i~^U%HrO{JUk:^B| Vi4a];-2H');
define('LOGGED_IN_SALT',   ' vHf2Prgq4ohAp$)ku,!DnI8f5P#`)l@AZ eH(F^:}Z%^O%o| LJi_T9xtX|uQfy');
define('NONCE_SALT',       'Q]xWh@^!heMMlx;C:a:cOBf=*>MAst]G6u,2vr$pp5HiEuN2>w$8zu_BEr*1O-(_');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');