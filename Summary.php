<?php
include "Config.php";

$satinAlinanlar = array();
if (!isset($_SESSION['user'])){
    header('location:index.php?msg=Önce giriş yapmalısın.');
}else{
    $where = array(
      "userId" => $_SESSION['user']['id']
    );
    $satinAlinanlar = $dataOperation->getList('satin_alinan_urunler',$where);
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
            <h2 id='kategori_baslik'>Hesap Özeti</h2>
            <?php echo "<div class='top_right'><h2 id='username_baslik'><a href='Summary.php' id='username_a'>" . $_SESSION["user"]["name"] . "</a></h2>";
            echo "<a href='index.php?logout=out' id='top_cikis' class='cikis_bt' type='button'>Çıkış Yap</a></div>"; ?>
        </div>
        <div class="products">
            <table class="my_form" id="summary_table">
                <tr>
                    <th>Ürün Id</th>
                    <th>Ürün Adı</th>
                    <th>Check-in Tarihi</th>
                    <th>Check-out Tarihi</th>
                    <th>Total Fiyat</th>
                </tr>
                <?php foreach ($satinAlinanlar as $alinan){
                      ?>
                    <tr>
                        <td><?php echo $alinan['productId']; ?></td>
                        <td><?php echo $alinan['productName']; ?></td>
                        <td><?php echo $alinan['startDate']; ?></td>
                        <td><?php echo $alinan['endDate']; ?></td>
                        <td><?php echo $alinan['totalPrice']; ?></td>
                    </tr>
                    <?php
                } ?>
            </table>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
</body>
</html>
