<?php
include "Config.php";

$kategori = $_GET["kategori"] ?? null;
$where = array();
if ($kategori == "konaklama") {
    $baslik = "<h2 id='kategori_baslik'>Konaklama</h2>";
    $where["type"] = 0;
} elseif ($kategori == "tur"){
    $baslik = "<h2 id='kategori_baslik'>Turlar</h2>";
    $where["type"] = 1;
} elseif ($kategori == "arabaKira"){
    $baslik = "<h2 id='kategori_baslik'>Araba Kiralama</h2>";
    $where["type"] = 2;
} else {
    $baslik = "<h2 id='kategori_baslik'>Hizmetler</h2>";
}
$searchString = '';
if (isset($_GET["searchString"])){
    $searchString = $_GET["searchString"];
    $where["like"] = "name LIKE '%".$searchString."%'";
}

$products = $dataOperation->getList('urunler',$where);
if (!isset($products)){
    echo "Ürünler getirilirken hata oluştu.";
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
            <?php
            echo $baslik;
            if (isset($_SESSION["user"])) {
                echo "<div class='top_right'><h2 id='username_baslik'><a href='Summary.php' id='username_a'>" . $_SESSION["user"]["name"] . "</a></h2>";
                echo "<a href='index.php?logout=out' id='top_cikis' class='cikis_bt' type='button'>Çıkış Yap</a></div>";
            }
            ?>
        </div>
        <div class="bottom_container">
            <div class="left_container">
                <div class="search_container" align="center">
                    <form action="Products.php" method="get">
                        <input type="search" name="kategori" value="<?php echo $kategori; ?>" style="display: none">
                        <table class="my_form" id="search_form">
                            <tr>
                                <td><span id="hizmetAdi">Hizmet Adı:</span><input type="search" name="searchString" id="search_input" value="<?php echo $searchString;?>"></td>
                            </tr>
                            <tr>
                                <td><input class="giris_yap" type="submit" value="Ara"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="right_container">
                <div class="products">
                    <?php
                        foreach ($products as $product){
                    ?>
                    <div class="product">
                        <div class="product_left">
                            <img class="product_img" src="<?php echo $product['img']; ?>" onclick="window.open(this.src)" alt="<?php echo $product['name']; ?>">
                        </div>
                        <div class="product_right">
                            <h2 class="prodcut_header"><?php echo $product['name']; ?></h2>
                            <p class="product_description"><?php echo $product['description'];?></p>
                            <div class="product_shopping">
                                <h3 class="product_price">Ücret: <?php echo $product['price'];?>TL</h3>
                                <a href="Shopping.php?id=<?php echo $product['id'];?>" class="product_button">Satın Al</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include "inc/footer.php"; ?>
</body>
</html>
<?php
if (isset($_GET["msg"])){ ?>
    <script>
        window.onload = function(){
            alert("<?php echo $_GET["msg"]; ?>");
        };
    </script>
    <?php
} ?>