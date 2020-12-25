<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (isset($_SESSION['guard'])) {
  $par = 1;
} else {
  $par = 0;
}
$hook['pre_controller'] = array(
  'class'    => 'Authentication',
  'function' => 'auth',
  'filename' => 'Authentication.php',
  'filepath' => 'hooks',
  'params'   =>  $par
);
