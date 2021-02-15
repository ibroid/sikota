<?php

class Model
{
  static protected $query;

  public function __construct()
  {
  }

  public static function instance()
  {
    $these = get_instance();
    return $these;
  }
  public static function all()
  {
    $these = get_instance();
    return $these->db->select('*')->order_by('id', 'desc')->get(strtolower(get_called_class()));
  }
  public static function select($select)
  {
    $these = get_instance();
    $these->db->select($select);
    return new static;
  }
  public static function findOrDie($par = [])
  {
    $these = get_instance();
    $result =  $these->db->get_where(strtolower(get_called_class()), $par);
    if (empty($result->row_array())) {
      header("HTTP/1.0 404 Not Found");
      echo 'Not Found';
      die;
    } else {
      return $result;
    }
  }
  public static function get($limit = '', $offset = '')
  {
    $these = get_instance();
    return $these->db->get(strtolower(get_called_class()), $limit, $offset);
  }
  public static function getWhere($where = [])
  {
    $these = get_instance();
    return $these->db->get_where(strtolower(get_called_class()), $where);
  }
  public static function where($field, $value, $str = TRUE)
  {
    $these = get_instance();
    $these->db->where($field, $value, $str);
    return new static;
  }
  public static function orWhere($field, $value, $str = TRUE)
  {
    $these = get_instance();
    $these->db->or_where($field, $value, $str);
    return new static;
  }
  public static function like($key, $like)
  {
    $these = get_instance();
    $these->db->like($key, $like);
    return new static;
  }
  public static function orLike($key, $like)
  {
    $these = get_instance();
    $these->db->or_like($key, $like);
    return new static;
  }
  public static function query($query)
  {
    $these = get_instance();
    return $these->db->query($query);
  }
  public static function join($table, $cond, $pos)
  {
    $these = get_instance();
    $these->db->join($table, $cond, $pos);
    return new static;
  }
  public static function update($data = [], $where = [])
  {
    $these = get_instance();
    return $these->db->update(strtolower(get_called_class()), $data, $where);
  }
  public static function insert($data)
  {
    $these = get_instance();
    $these->db->insert(strtolower(get_called_class()), $data);
  }
  public static function delete($par = [])
  {
    $these = get_instance();
    $these->db->delete(strtolower(get_called_class()), $par);
  }
  public static function insertAndGetId($data)
  {
    $these = get_instance();
    $these->db->insert(strtolower(get_called_class()), $data);
    return $these->db->insert_id();
  }
  public static function groupStart()
  {
    $these = get_instance();
    return  $these->db->group_start();
  }
  public static function groupEnd()
  {
    $these = get_instance();
    return  $these->db->group_end();
  }
  public static function orderBy($title, $align = 'desc')
  {
    $these = get_instance();
    return $these->db->order_by($title, $align);
  }
  public static function limit($length, $start)
  {
    $these = get_instance();
    return $these->db->limit($length, $start);
  }
}
