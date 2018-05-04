<?php
  namespace widget;
  include_once 'sql.php';
  class Insert extends Sql {
    private $table;
    private $col_name;
    private $value;
    
    public function low_priority() {
      $this->table.= " LOW_PRIORITY ";
      return $this;
    }
    public function delayed() {
      $this->table.= " DELAYED ";
      return $this;
    }
    public function ignore() {
      $this->table.=  " IGNORE ";
      return $this;
    }    

    public function table($table) {
      $this->table.= ' INTO ';
      $this->table.= $table;
      return $this;
    }
    public function value(array $data = []) {
        $this->col_name.= " (";
        $this->value.= " (";
      foreach ($data as $col => $item) {
        $this->col_name.= " $item[0] ,";
        $this->value.= " $item[1] ,";
        }
      $this->value = rtrim($this->value, ',');
      $this->col_name = rtrim($this->col_name, ',');
        $this->col_name.= ") ";
        $this->value.= ") ";
      return $this;
    }

    public function start() {
      if ($this->table) {
        $sql = '
          INSERT   '  . $this->table .    '
          '  . $this->col_name .   '
          VALUES'  . $this->value .    ';
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