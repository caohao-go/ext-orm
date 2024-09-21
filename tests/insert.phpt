--TEST--
swoole_orm::insert($table, $data)

--FILE--
<?php

$insert_data = array();
$insert_data['user_id'] = 111111;
$insert_data['appid'] = 'wx8bd51923ccbd5200';
$insert_data['union'] = NULL;
$insert_data['session_key'] = true;
$insert_data['nickname'] = false;
$insert_data['province'] = 3.18;
$insert_data['gender'] = 1;

$ret = swoole_orm::insert("userinfo", $insert_data);

var_dump($ret);

--EXPECT--
array(2) {
  ["sql"]=>
  string(121) "INSERT INTO `userinfo` (`user_id`,`appid`,`union`,`session_key`,`nickname`,`province`,`gender`) values (?,?,NULL,1,0,?,?)"
  ["bind_value"]=>
  array(4) {
    [0]=>
    int(111111)
    [1]=>
    string(18) "wx8bd51923ccbd5200"
    [2]=>
    float(3.18)
    [3]=>
    int(1)
  }
}