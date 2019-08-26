<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位
if (empty($_POST['wine']) or empty($_POST['sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]

$sql = "UPDATE `wine_goods` SET
 `wine`=?,
 `kind`=?,
 `producing_countries`=?,
 `brand`=?,
 `Production_area`=?,
 `years`=?,
 `capacity`=?,
 `concentration`=?,
 `price`=?,
 `Product_brief`=?,
 `Brand_story`=?
  WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['wine'],
    $_POST['kind'],
    $_POST['producing_countries'],
    $_POST['brand'],
    $_POST['Production_area'],
    $_POST['years'],
    $_POST['capacity'],
    $_POST['concentration'],
    $_POST['price'],
    $_POST['Product_brief'],
    $_POST['Brand_story'],
    $_POST['sid'],
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
