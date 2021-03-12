<?php
include "Config.php";

$product = null;
if (isset($_GET['id'])) {
    $where = array(
        "id" => $_GET['id']
    );
    $product = $dataOperation->get('urunler', $where);
}
if (isset($_SESSION["user"])){
    if (isset($_POST['buyThis'])){
        $product = array();
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $productPrice = doubleval($_POST['productPrice']);
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $interval = strtotime($endDate) - strtotime($startDate);
        $dayDiff = $interval == 0 ? 1 : floor($interval / (60 * 60 * 24));;
        $totalPrice = $productPrice * $dayDiff;
        $data = array(
            "userId" => $_SESSION['user']['id'],
            "productId" => $productId,
            "productName" => $productName,
            "productPrice" => $productPrice,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "totalPrice" => $totalPrice,
        );
        if($dataOperation->add('satin_alinan_urunler',$data)){
            header("location:Products.php?kategori=konaklama&msg=Satın alma işlemi başarılı. Tanımlı kartınızdan ödeme alındı.");
        }else{
            header("location:Products.php?kategori=konaklama&msg=Satın alma işlemi esnasında bir hata oluştu. Lütfen bizimle iletişime geçin.");
        }
    }
}
?>
<!doctype html>
<html lang="tr">
<?php include "inc/head.php"; ?>
<body>
<?php include "inc/header.php"; ?>
<div class="content">
    <div class="content_inner">
        <div class="top_container">
            <h2 id='kategori_baslik'>Satın Al</h2>
            <?php
            if (isset($_SESSION["user"])) {
                echo "<div class='top_right'><h2 id='username_baslik'><a href='Summary.php' id='username_a'>" . $_SESSION["user"]["name"] . "</a></h2>";
                echo "<a href='index.php?logout=out' id='top_cikis' class='cikis_bt' type='button'>Çıkış Yap</a></div>";
            } ?>
        </div>
        <div class="products">
            <?php if (isset($_SESSION["user"])) {
                if (isset($product)) { ?>
                    <div class="product">
                        <div class="product_left">
                            <img id="shopping_img" class="product_img" src="<?php echo $product['img']; ?>"
                                 onclick="window.open(this.src)" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="product_right">
                            <h2 class="prodcut_header"><?php echo $product['name']; ?></h2>
                            <p class="product_description"><?php echo $product['description']; ?></p>
                            <h3 class="product_price" id="shopping_product_price">Ücret: <?php echo $product['price']; ?>TL</h3>
                            <div class="shopping_buy_container">
                                <form action="Shopping.php" class="shopping_shop" method="post">
                                    <input type="text" style="display: none" name="productId" value="<?php echo $product['id'];?>">
                                    <input type="text" style="display: none" name="productName" value="<?php echo $product['name'];?>">
                                    <input type="text" style="display: none" name="productPrice" value="<?php echo $product['price'];?>">
                                    <table class="my_form">
                                        <tr>
                                            <td>Check-in tarihi:</td>
                                            <td><input style="width: 100%" id="start" type="date" name="startDate" required></td>
                                        </tr>
                                        <tr>
                                            <td>Check-out tarihi:</td>
                                            <td><input style="width: 100%" id="end" type="date" name="endDate" required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type="submit" class="giris_yap" name="buyThis" value="Satın Al"></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else {
                    header("location:Products.php?kategori=konaklama");
                }
            } else { ?>
                <h2>Lütfen üye olun yada giriş yapın.</h2>
                <div id="login_box" class="my_form_container" align="center">
                    <form action="index.php" method="post">
                        <table class="my_form">
                            <tr>
                                <td>Kullanıcı Adı:</td>
                                <td><input type="text" name="username" required pattern=".{3,30}"></td>
                            </tr>
                            <tr>
                                <td>Şifre:</td>
                                <td><input type="password" name="password" required pattern=".{3,30}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="giris_yap" type="submit" name="login" value="Giriş Yap"></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="20px"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Henüz üye değil misiniz?
                                    <button type="button" class="my_bt" onclick="showOrHide()">Üye Ol</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="sing_up_box" class="my_form_container" align="center" style="display: none">
                    <form action="index.php" method="post">
                        <table class="my_form">
                            <tr>
                                <td>İsim:</td>
                                <td><input type="text" name="name" required pattern=".{3,30}"></td>
                            </tr>
                            <tr>
                                <td>Kullanıcı Adı:</td>
                                <td><input type="text" name="username" required pattern=".{3,30}"></td>
                            </tr>
                            <tr>
                                <td>Şifre:</td>
                                <td><input type="password" name="password" required pattern=".{3,30}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="uye_ol" type="submit" name="singup" value="Üye Ol"></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="20px"></td>
                            </tr>
                            <tr>
                                <td colspan="2">Zaten üye misiniz?
                                    <button type="button" class="my_bt" onclick="showOrHide()">Giriş Yap</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
<script>
    var start = document.getElementById('start');
    var end = document.getElementById('end');

    start.addEventListener('change', function() {
        if (start.value)
            end.min = start.value;
    }, false);
    end.addEventListener('change', function() {
        if (end.value)
            start.max = end.value;
    }, false);

</script>
</body>
</html>
