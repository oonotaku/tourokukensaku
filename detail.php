<?php
require 'db.php'; // データベース接続ファイル

// GETパラメータから'name'を取得
$name = htmlspecialchars($_GET['name'] ?? '', ENT_QUOTES, 'UTF-8');

// データベースからデータを取得
$sql = "SELECT * FROM registrations WHERE name = :name";
$stmt = $pdo->prepare($sql);
$stmt->execute([':name' => $name]);
$details = $stmt->fetch(PDO::FETCH_ASSOC);

if ($details): 
    // データが見つかった場合
    ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($details['name']); ?> の詳細</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            img {
                max-width: 100%;
                border-radius: 8px;
            }
            h1 {
                color: #007BFF;
                text-align: center;
            }
            p {
                font-size: 1rem;
                margin: 10px 0;
            }
            nav a {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                color: #007BFF;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1><?php echo htmlspecialchars($details['name']); ?> の詳細</h1>
            <?php if (!empty($details['photo_path'])): ?>
                <img src="<?php echo htmlspecialchars($details['photo_path']); ?>" alt="<?php echo htmlspecialchars($details['name']); ?>">
            <?php endif; ?>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($details['email']); ?></p>
            <p><strong>所属会社:</strong> <?php echo htmlspecialchars($details['company']); ?></p>
            <p><strong>役職:</strong> <?php echo htmlspecialchars($details['position']); ?></p>
            <p><strong>備考:</strong> <?php echo nl2br(htmlspecialchars($details['memo'])); ?></p>
            <nav>
                <a href="index.php">← 登録一覧に戻る</a>
            </nav>
        </div>
    </body>
    </html>
<?php
else:
    // データが見つからない場合
    ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>データが見つかりません</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                text-align: center;
                background-color: #f8d7da;
                color: #721c24;
            }
            .container {
                margin-top: 50px;
            }
            a {
                text-decoration: none;
                color: #007BFF;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>該当するデータが見つかりません。</h1>
            <nav>
                <a href="index.php">← 登録一覧に戻る</a>
            </nav>
        </div>
    </body>
    </html>
<?php
endif;
?>
