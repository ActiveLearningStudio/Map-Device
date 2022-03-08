<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = '172.17.0.1';
$CFG->dbname    = 'moodle_new';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'test';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 3307,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_unicode_ci',
);
//$CFG->wwwroot   = 'https://' . $_SERVER['HTTP_HOST'];
$CFG->wwwroot   = 'https://lms.noovo.co:8443';
$CFG->dataroot  = '/var/www/moodledata';
$CFG->admin     = 'admin';
$CFG->debugdisplay = false;
$CFG->directorypermissions = 0777;
$CFG->sslproxy = true;
$CFG->reverseproxy =true;
//$_SERVER['HTTPS'] = 'Off';
//echo "<pre>";
//print_r($_SERVER);
//$_SERVER['SERVER_PORT'] = 8843;
//die();

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!