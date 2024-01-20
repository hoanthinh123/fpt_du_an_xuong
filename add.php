<?php
        require_once 'connect.php';
        $sql = "select * from loai_do_uong";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $frice = $_POST['frice'];
            $douong = $_POST['douong'];

            $img = $_FILES['image'];
            $attr_lir = "img/";
            $attr_file = $attr_lir.basename($img['name']);
            move_uploaded_file($img['tmp_name'], $attr_file);
            $sql = "INSERT INTO do_uong VALUES ('','$name','$attr_file','$frice','$douong')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header("location:index.php");

        }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Thêm sản phẩm</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        Đồ uống: <input type="text" name="name" id=""><br>
       Ảnh: <input type="file" name="image" id=""><br>
       giá: <input type="text" name="frice" id=""><br>
        Đồ uống: <select name="douong" id="">
                <option value="" hidden></option>
                <?php foreach($result as $a){ ?>
                    <option value="<?= $a['loai_do_uong_id']?>">
                    <?= $a['loai_do_uong_name']?>
                </option>
                    <?php }?> 
        </select><br>
        <input type="submit" name="submit" value="Thêm" id="">

    </form>
</body>
</html>