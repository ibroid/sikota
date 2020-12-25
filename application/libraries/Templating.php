<?php

class Templating
{
  var $template_data = [];

  function set($name, $value)
  {
    $this->template_data[$name] = $value;
  }
  function load($template = '', $view = '', $view_data = [], $return = FALSE)
  {
    $this->CI = &get_instance();
    $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
    return $this->CI->load->view($template, $this->template_data, $return);
  }
  static function render($view = '', $view_data = [], $return = FALSE)
  {
    $these = &get_instance();
    $self = new self;
    $self->set('contents', $these->load->view($view, $view_data, TRUE));
    return $these->load->view('template/master', $self->template_data, $return);
  }
}
