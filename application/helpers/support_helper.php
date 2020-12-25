<?php
function req()
{
  $obj = new class
  {
    protected $request;
    public function post()
    {
      $this->request = (object) $_POST;
      return $this->request;
    }
    public function get()
    {
      $this->request = (object) $_GET;
      return $this->request;
    }
    public function json()
    {
      $data = json_decode(file_get_contents('php://input', TRUE));
      return (object) $data;
    }
  };
  return $obj;
}
function request($val)
{

  $these = &get_instance();

  if (isset($_POST[$val])) {
    return $these->input->post($val);
  }

  if (isset($_GET[$val])) {
    return $these->input->get($val);
  }
}

function requestAll()
{
  $these = &get_instance();
  if (isset($_POST)) {
    return $these->input->post();
  }

  if (isset($_GET)) {
    return $these->input->get();
  }
}
