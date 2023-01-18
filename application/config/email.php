<?php defined('BASEPATH') or exit('No direct script access allowed');

$config = array(
    'mailpath' => '/usr/sbin/sendmail',
    'protocol' => 'sendmail', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_encryption' => "TLS",
    'smtp_user' => '5125.2019.gct@gmail.com',
    'smtp_pass' => 'numan786$',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'utf-8',
    'validate' => TRUE,
    'wordwrap' => TRUE
);
