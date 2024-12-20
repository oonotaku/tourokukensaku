<?php
require 'db.php'; // DB接続ファイル

// フォームデータ取得
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$company = htmlspecialchars($_POST['company'], ENT_QUOTES, 'UTF-8');
$position = htmlspecialchars($_POST['position'], ENT_QUOTES, 'UTF-8');
$memo = htmlspecialchars($_POST['memo'], ENT_QUOTES, 'UTF-8');
$photoPath = '';

// 画像アップロード処理
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['photo']['tmp_name'];
    $fileNameCmps = explode(".", $_FILES['photo']['name']);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $_FILES['photo']['name']) . '.' . $fileExtension;
    $uploadFileDir = './uploaded_photos/';
    $dest_path = $uploadFileDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $photoPath = $dest_path;
    } else {
        die("画像の保存に失敗しました。");
    }
}

// データベースに挿入
try {
    $sql = "INSERT INTO registrations (name, email, company, position, memo, photo_path) 
            VALUES (:name, :email, :company, :position, :memo, :photo_path)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':company' => $company,
        ':position' => $position,
        ':memo' => $memo,
        ':photo_path' => $photoPath
    ]);
    echo "登録が完了しました！";
} catch (PDOException $e) {
    die("データ登録エラー: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
</head>
<body>
    <h1>登録が完了しました！</h1>
    <nav>
        <a href="index.php">登録一覧ページへ</a>
    </nav>
</body>
</html>
