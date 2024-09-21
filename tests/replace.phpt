--TEST--
swoole_orm::replace($table, $data)

--FILE--
<?php

$replace_data = array();
$replace_data['user_id'] = 111111;
$replace_data['appid'] = 'wx8bd51923ccbd5200';
$replace_data['union'] = NULL;
$replace_data['session_key'] = true;
$replace_data['nickname'] = false;
$replace_data['province'] = 3.18;
$replace_data['gender'] = 1;

$ret = swoole_orm::replace("userinfo", $replace_data);

var_dump($ret);

--EXPECT--
array(2) {
  ["sql"]=>
  string(122) "REPLACE INTO `userinfo` (`user_id`,`appid`,`union`,`session_key`,`nickname`,`province`,`gender`) values (?,?,NULL,1,0,?,?)"
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
