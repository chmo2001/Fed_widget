<?php
  namespace widget;
  include_once 'sql.php';
  class Truncate extends Sql {
    private $table;
    

    public function table($table) {
      $this->table.= $table;
      return $this;
    }

    public function start() {
      if ($this->table) {
        $sql = '
          TRUNCATE TABLE   '  . $this->table .    ';
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