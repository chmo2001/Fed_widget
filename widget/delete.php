<?php
  namespace widget;
  include_once 'sql.php';
  class Delete extends Sql {
    private $table;
    private $col_name;
    private $where;
    private $order_by;
    private $value;
    private $limit;
    
    
    public function low_priority() {
      $this->table.= " LOW_PRIORITY ";
      return $this;
    }
    public function quick() {
      $this->table.= " QUICK ";
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
    public function order_by(array $data= []) {
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

    public function start() {
      if ($this->table) {
        $sql = '
          DELETE   '  . $this->table .    '
          WHERE 1  '  . $this->where .    '
          ORDER BY '  . $this->order_by . '
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