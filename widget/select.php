<?php
  namespace widget;
  include_once 'sql.php';
  class Select extends Sql {
    private $value = '*';
    private $table;
    private $where;
    private $group_by;
    private $having;
    private $order_by;
    private $limit;
    private $l_join;
    private $r_join;
    private $i_join;
    public function from($table) {
      $this->table = $table;
      return $this;
    }
    public function value(array $data = []) {
      $column = '';
      foreach ($data as $item) {
        if (is_array($item)) {
          foreach ($item as $key => $val) {
            $column.= $key . ' AS ' . $val . ','; 
          }
        } else {
          $column.= $item . ',';
        }
      }
      $this->value = rtrim($column, ',');
      return $this;
    }
    public function where_and(array $data = []) {
      foreach ($data as $col => $item) {
        $this->where.= " AND $col = \"$item\"";
      }
      return $this;
    }
    public function where_or(array $data = []) {
      foreach ($data as $col => $item) {
        $this->where.= " OR $col = \"$item\"";
      }
      return $this;
    }
	public function group_by(array $data= []) {
    $this->group_by.= 'GROUP BY ';
      foreach ($data as $col => $item) {
		$this->group_by.= " $item[0] $item[1],";
        }
      $this->group_by = rtrim($this->group_by,",");
      return $this;
    }
    public function having_and(array $data = []) {
      foreach ($data as $col => $item) {
        $this->having.= " AND $col = \"$item\"";
      }
      return $this;
    }
    public function having_or(array $data = []) {
      foreach ($data as $col => $item) {
        $this->having.= " OR $col = \"$item\"";
      }
      return $this;
    }
    public function order_by(array $data= []) {
    $this->order_by.= 'ORDER BY ';
      foreach ($data as $col => $item) {
		$this->order_by.= " $item[0] $item[1],";
        }
      $this->order_by = rtrim($this->order_by,",");
      return $this;
    }
	public function limit($limit){
	  if($limit){
		$this->limit = " LIMIT $limit ";
	  }
	  return $this;
	}
  public function L_JOIN($table, $left, $right){
	  if($table){
      $this->l_join.= " LEFT JOIN $table ON $left = $right ";
	  }
	  return $this;
	}
  public function R_JOIN($table, $left, $right){
	  if($table){
      $this->r_join.= " RIGHT JOIN $table ON $left = $right ";
	  }
	  return $this;
	}
   public function I_JOIN($table, $left, $right){
	  if($table){
      $this->i_join.= " INNER JOIN $table ON $left = $right ";
	  }
	  return $this;
	}
    public function start() {
      if ($this->table) {
        $sql = '
          SELECT   '  . $this->value .    '
          FROM     '  . $this->table .    '
          '  . $this->l_join . '
          '  . $this->r_join . '
          '  . $this->i_join . '
          WHERE 1  '  . $this->where .    '
          '  . $this->group_by . '
          HAVING 1 '  . $this->having .   '
          '  . $this->order_by . '
          '  . $this->limit . ';
        ';
        echo $sql;
        $query = mysqli_query($this->db, $sql);
        if (mysqli_errno($this->db)) {
          exit(mysqli_error($this->db));
        }
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
      } else {
        return NULL;
      }
    }
  }
?>