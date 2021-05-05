<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
return array(
  'components' => array(
    'db' => array(
      'connectionString' => 'mysql:host=lime-db;port=3306;dbname=limesurvey;',
      'emulatePrepare' => true,
      'username' => 'limesurvey',
      'password' => 'MySQL-userpwd',
      'charset' => 'utf8mb4',
      'tablePrefix' => 'lime_',
    ),
    'urlManager' => array(
      'urlFormat' => 'path',
      'rules' => array(),
      'showScriptName' => true,
    ),
    'request' => array(
      'baseUrl' => '',
     ),
  ),
  'config'=>array(
    'publicurl'=>'',
    'debug'=>0,
    'debugsql'=>0,
  )
);
