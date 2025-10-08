<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Configuration
|--------------------------------------------------------------------------
|
| Email servisi için gerekli ayarlar
|
*/

$config['email_protocol'] = 'smtp';
$config['email_smtp_crypto'] = 'ssl';
$config['email_smtp_host'] = 'your_smtp_host';
$config['email_smtp_port'] = 465;
$config['email_smtp_user'] = 'your_email@domain.com';
$config['email_smtp_pass'] = 'your_email_password';
$config['email_charset'] = 'utf-8';
$config['email_mailtype'] = 'html';
$config['email_wordwrap'] = TRUE;