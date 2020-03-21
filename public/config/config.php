<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Europe/Berlin');
session_start();
define('NL', '<br>');
define('OPRE', '<pre>');
define('CPRE', '</pre>');
define('NLT',chr(13) . chr(10));//Zeilenumbruch
define('DE','|%|');   //Datensatzende

//Mit wordwrap() kann man innerhalb eines Strings(str) unter Angabe des optionalen Trennzeichens(break) nach einer bestimmten Länge(width) umbrechen .
// Werden die optionalen Parameter width und break nicht angegeben, so umbricht diese Funktion automatisch nach 75 Zeichen mit dem Trennzeichen "\n" die Zeichenkette .
// Mit dem optionalen Parameter cut kann man erzwingen(wenn er auf 1 gesetzt wird), dass exakt nach der vorgegebenen Länge(auch wenn das Wort länger ist) umbrochen wird.
define('UB', '|||');//Zeilenumbruch Textarea
define('WIDTH', 50);//Zeilenumbruch Textarea nach einer bestimmten Länge
define('CUT', 1);//Zeilenumbruch Textarea

define('DS', DIRECTORY_SEPARATOR);

define('PORTFOLIO_INI', parse_ini_file(__DIR__ . DS . 'portfolio.ini', true));

define( 'ROOT_PATH', dirname(__DIR__, 2) . DS );
define( 'BASIC_PATH', dirname( __DIR__ ) );
define('USERS', ROOT_PATH . 'Textfiles' . DS . 'Users.json');
define('GBENTRIES', ROOT_PATH . 'Textfiles' . DS . 'GBentries.json');
define('PORTFOLIO', ROOT_PATH . 'Textfiles' . DS . 'Portfolio.json');

// The size is expressed in bytes. 1000000 === 1 MB.
define('MAX_IMG_SIZE', 1000000);
// Update this array to manage the allowed image types.
define('ALLOWED_IMG_TYPES', ['jpg', 'jpeg', 'png', 'gif']);

require_once ROOT_PATH . 'src' . DS . 'Library' . DS . 'helpers.php';
require_once ROOT_PATH . 'vendor' . DS . 'autoload.php';