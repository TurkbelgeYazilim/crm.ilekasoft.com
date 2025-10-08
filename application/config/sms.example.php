<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| SMS Configuration
|--------------------------------------------------------------------------
|
| SMS servisi için gerekli ayarlar
|
*/

$config['sms_api_url'] = 'http://api3.mobilisim.com/';
$config['sms_username'] = 'your_sms_username';
$config['sms_password'] = 'your_sms_password';
$config['sms_originator'] = 'your_sender_name';
$config['sms_action'] = '12';

/*
|--------------------------------------------------------------------------
| SMS Default Settings
|--------------------------------------------------------------------------
*/
$config['sms_encoding'] = 'UTF-8';
$config['sms_timeout'] = 30; // saniye