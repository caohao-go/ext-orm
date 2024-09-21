--TEST--
swoole_orm::select($table, $join, $column, $where)

--FILE--
<?php

$table = "userinfo(a)";

$join = [
  "[>]T_AAA(a1)" => "id",
  "[<]T_BBB" => ["E1", "E2", "E3"],
  "[>]T_CCC(c1)" => [ "GG" => "HH", "II.KK" => "LL"]
];

$columns = ["username(u)", "age"];

$where =  [
  "user.email[!]" => ["foo@bar.com", "cat@dog.com", "admin@ycdb.in"],
  "user.uid[<]" => 11111,
  "uid[!]" => null,
  "count[!]" => [36, 57, 89],
  "int_num[!]" => 3,
  "double_num[!]" => 3.76,
  "column_a[~]" => "%aa%",
  "column_b[!~]" => ["%11%", "22%", "33%"],
  "column_c[~]" => ["OR" => ["%44", "55"]],
  "column_d[!~]" => ["OR" => ["%66%", "%77%"]],
  "age[<>]" => [15, 30],
  "AND #1" => [
    "OR #1" => [
      "user_name" => null,
      "email" => "foo@bar.com",
    ],
    "OR #2" => [
      "user_name" => "bar",
      "email" => "bar@foo.com"
    ]
  ],
  "OR" => [
    "user_name[!]" => "foo",
    "promoted[!]" => true
  ],
  'GROUP' => ['age', 'gender'],
  'HAVING' => [
    "uid.num[>]" => 111,
    "uid[!]" => null,
    "column_a[!~]" => "%red%",
  ],
  'ORDER' => [
    "user.score",
    "time" => "DESC",
  ],
  "LIMIT" => 20,
];

$ret = swoole_orm::select($table, $join, $columns, $where);

var_dump($ret);

--EXPECT--
array(3) {
  ["sql"]=>
  string(862) "SELECT username AS `u`,age FROM `userinfo` AS `a` RIGHT JOIN `T_AAA` AS `a1` USING (`id`)  LEFT JOIN `T_BBB` USING (`E1`,`E2`,`E3`)  RIGHT JOIN `T_CCC` AS `c1` ON `a`.`GG`=`c1`.`HH` AND `II`.`KK` =`c1`.`LL`  WHERE `user`.`email` NOT IN ( ?, ?, ?) AND `user`.`uid` < ? AND `uid` IS NOT NULL AND `count` NOT IN ( ?, ?, ?) AND `int_num` != ? AND `double_num` != ? AND `column_a` LIKE ? AND ( `column_b` NOT LIKE ? OR `column_b` NOT LIKE ? OR `column_b` NOT LIKE ? ) AND ( `column_c` LIKE ? OR `column_c` LIKE ? ) AND ( `column_d` NOT LIKE ? OR `column_d` NOT LIKE ? ) AND ( `age` BETWEEN ? AND ?)  AND ( ( `user_name` IS NULL OR `email` = ? ) AND ( `user_name` = ? OR `email` = ? )) AND ( `user_name` != ? OR `promoted` != ? ) GROUP BY age,gender HAVING `uid`.`num` > ? AND `uid` IS NOT NULL AND `column_a` NOT LIKE ? ORDER BY  `user`.`score` , `time` DESC LIMIT 20"
  ["bind_value"]=>
  array(26) {
    [0]=>
    string(11) "foo@bar.com"
    [1]=>
    string(11) "cat@dog.com"
    [2]=>
    string(13) "admin@ycdb.in"
    [3]=>
    int(11111)
    [4]=>
    int(36)
    [5]=>
    int(57)
    [6]=>
    int(89)
    [7]=>
    int(3)
    [8]=>
    float(3.76)
    [9]=>
    string(4) "%aa%"
    [10]=>
    string(4) "%11%"
    [11]=>
    string(3) "22%"
    [12]=>
    string(3) "33%"
    [13]=>
    string(3) "%44"
    [14]=>
    string(2) "55"
    [15]=>
    string(4) "%66%"
    [16]=>
    string(4) "%77%"
    [17]=>
    int(15)
    [18]=>
    int(30)
    [19]=>
    string(11) "foo@bar.com"
    [20]=>
    string(3) "bar"
    [21]=>
    string(11) "bar@foo.com"
    [22]=>
    string(3) "foo"
    [23]=>
    bool(true)
    [24]=>
    int(111)
    [25]=>
    string(5) "%red%"
  }
  ["is_single_column"]=>
  int(0)
}
