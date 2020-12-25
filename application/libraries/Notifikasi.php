<?php

class Notifikasi
{
  public static function flash($type = 'success', $message)
  {
    $these = &get_instance();
    $these->session->set_flashdata('notif', "<div class='alert alert-$type alert-dismissible'> 
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> 
      <strong>$type!</strong> $message</div>");
  }
  public static function showFlash($type = 'notif')
  {
    $these = &get_instance();
    return $these->session->flashdata($type);
  }
}
