--TEST--
swoole_orm::update($table, $data, $where)

--FILE--
<?php

$data = array('height' => 185,'age' => 32);
$where = array('username' => 'smallhow');
$ret = swoole_orm::update("user_info_test", $data, $where);

var_dump($ret);

--EXPECT--
array(2) {
  ["sql"]=>
  string(71) "UPDATE `user_info_test` SET `height` = ?,`age` = ? WHERE `username` = ?"
  ["bind_value"]=>
  array(3) {
    [0]=>
    int(185)
    [1]=>
    int(32)
    [2]=>
    string(8) "smallhow"
  }
}