<?php

exit; // 開關

require __DIR__. '/__connect_db.php';

for($i=1; $i<100; $i++){
    $s = "INSERT INTO `address_book`
            (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`)
             VALUES
              ('陳小華{$i}', 'jhdsj@gmail.com', '0912777888', '1991-02-02', '台中市', '2019-08-20 12:00:00') ";
//    echo $s;
//    break;
    $pdo->query($s);
}



