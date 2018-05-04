<?php
  namespace widget;
/*
  include_once 'select.php';
  include_once 'update.php';
  include_once 'insert.php';
  include_once 'truncate.php';
  include_once 'delete.php';
  use Widget\Delete as Delete;
   use Widget\Select as Select;
    use Widget\Update as Update;
     use Widget\Insert as Insert;
      use Widget\Truncate as Truncate;*/
  spl_autoload_register(function ($class) {
    include_once "$class.php";
  });
  /*function _autoload($class){
    echo $class;
    include_once "widget/$class.php";
  }*/
  $table='news';
  $value = 'news_id';
  $query = new Delete();
  return  $query
                ->table($table)
                ->order_by([['news_id','ASC'],['news_subject','DESC']])
                ->limit('5')
                ->start();
  /*$query = new Insert();
  return  $query->low_priority()
                ->table($table)
                ->value([['news_id','5']])
                ->start();
  $query = new Select();
  return  $query->value([$value])
                ->from($table)
                ->l_join('events','news_id','events_id')
                ->where_and(['news_id' => '23'])
                ->group_by([['news_subject','ASC']])
                ->order_by([['news_id','ASC'],['news_subject','DESC']])
                ->limit('5')
                ->start();*/
                

?>