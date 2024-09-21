--TEST--
swoole_orm::delete($table, $where)

--FILE--
<?php

$where = array('username' => 'smallhow');
$ret = swoole_orm::delete("user_info_test", $where);

var_dump($ret);

--EXPECT--
array(2) {
  ["sql"]=>
  string(50) "DELETE FROM `user_info_test`  WHERE `username` = ?"
  ["bind_value"]=>
  array(1) {
    [0]=>
    string(8) "smallhow"
  }
}