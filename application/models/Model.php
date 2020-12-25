<?php

class Model
{
  static protected $query;
  public static function instance()
  {
    $these = get_instance();
    return $these;
  }
  public static function all()
  {
    $these = get_instance();
    return $these->db->select('*')->order_by('id', "DESC")->get(strtolower(get_called_class()));
  }
  public static function select($select)
  {
    $these = get_instance();
    $these->db->select($select);
    return new static;
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
  public static function orWhere($field, $value)
  {
    $these = get_instance();
    $these->db->or_where($field, $value);
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
}
