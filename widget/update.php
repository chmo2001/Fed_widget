<?php
  namespace widget;
  include_once 'sql.php';
  class Update extends Sql {
    private $table;
    private $value;
    private $where;
    private $limit;
    
    public function low_priority() {
      $this->table.= " LOW_PRIORITY ";
      return $this;
    }
    public function ignore() {
      $this->table.=  " IGNORE ";
      return $this;
    }    

    public function table($table) {
      $this->table.= $table;
      return $this;
    }
    public function value(array $data = []) {
      foreach ($data as $col => $item) {
        $this->value.= " $item[0] = $item[1],";
        }
      $this->value = rtrim($this->value, ',');
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
    public function limit($limit){
	  if($limit){
		$this->limit = " LIMIT $limit ";
	  }
	  return $this;
    }
    public function start() {
      if ($this->table) {
        $sql = '
          UPDATE   '  . $this->table .    '
          SET      '  . $this->value .    '
          WHERE 1  '  . $this->where .    '
          '  . $this->limit . ';
        ';
        echo $sql;
        $query = mysqli_query($this->db, $sql);
        if (mysqli_errno($this->db)) {
          exit(mysqli_error($this->db));
        }
      } else {
        return NULL;
      }
    }
  }
?>