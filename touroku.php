<!DOCTYPE html>
<html lang="jan">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
</head>
<body>
    <h1>登録ページ</h1>
    <nav>
        <a href="index.php">登録一覧ページへ</a>
    </nav>
    <form action="write.php" method="post" enctype="multipart/form-data">
        名前：<input type="text" name="name"><br>
        Email:<input type="text" name="email"><br>
        所属会社:<input type="text" name="company"><br>
        役職:<input type="text" name="position"><br>
        備考:<textarea name="memo" cols="30" rows="10"></textarea><br>
        写真:<input type="file" name="photo" accept="image/*" capture="user"><br>
        <button type="submit">登録</button>
    </form>
</body>
</html>