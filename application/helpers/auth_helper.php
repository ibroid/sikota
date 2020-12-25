<?php
function auth()
{
  $CI = get_instance();
  if (!$CI->session->userdata('guard')) {
    redirect('/login');
  }
}
