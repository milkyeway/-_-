<?php
require __DIR__ . '/__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名',
    'post' => $_POST,
];

# 如果沒有輸入必要欄位, 就離開
if (empty($_POST['wine'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

/*
$sql = sprintf("INSERT INTO `address_book`(
            `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
            ) VALUES (%s, %s, %s, %s, %s, NOW())",
    $pdo->quote($_POST['name']),
    $pdo->quote($_POST['email']),
    $pdo->quote($_POST['mobile']),
    $pdo->quote($_POST['birthday']),
    $pdo->quote($_POST['address'])
);
echo $sql;
$stmt = $pdo->query($sql);
*/

$sql = "INSERT INTO `wine_goods`(
            `wine`, `kind`, `producing_countries`, `brand`, `Production_area`, `years`, `capacity`, `concentration`, `price`, `Product_brief`, `Brand_story`) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)";

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
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);