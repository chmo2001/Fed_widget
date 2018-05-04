<?php
  namespace widget;
	class SQL {
		protected $db;
    protected $base;
    
		public function __construct($read) {
      $this->base = $read;
			$this->db = mysqli_connect('localhost', 'root', '');
			if (mysqli_connect_errno()) {
				exit(mysqli_connect_error());
			}
			mysqli_select_db($this->db, $this->base);
			mysqli_set_charset($this->db, $this->base);
		}
	}
?>