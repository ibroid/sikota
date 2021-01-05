<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CI_Defender
{
  public static $zeroReferer;
  public static $condition = [];

  static public function setReferer($params = '')
  {
    if ($_SERVER['HTTP_REFERER'] != $params) {
      self::$condition['setReferer'] = FALSE;
    }
    return new static;
  }

  static public function noUriParameters($params = '')
  {
    if (!isset($_GET[$params])) {
      self::$condition['noUriParameters'] = FALSE;
    }
    return new static;
  }

  static public function zeroReferer()
  {
    if (!isset($_SERVER['HTTP_REFERER'])) {
      self::$condition['zeroReferer'] = FALSE;
    }
    return new static;
  }

  static public function blockReferer($params)
  {
    if (isset($_SERVER['HTTP_REFERER'])) {
      if ($_SERVER['HTTP_REFERER'] == $params) {
        self::$condition['blockReferer'] = FALSE;
      }
    }
    return new static;
  }

  static public function setOrigin()
  {
    $url = 'DEFINED YOUR URL HERE';
    if (base_url() != $url) {
      self::$condition['setOrigin'] = FALSE;
    }
  }

  public function secure()
  {
    if (count(self::$condition) != 0) {
      header("HTTP/1.0 404 Not Found");
      echo 'Not Found -  Please Dont try Anything';
      die;
    }
    // return self::$condition;
  }
}

  /* End of file LibraryName.php */;
