<?php
    include "Config.php";

    if (isset($_GET["logout"])){
        session_destroy();
        header("location:index.php");
    } elseif (isset($_POST["login"])){
        $where = array(
            "username" => $_POST["username"],
            "password" => $_POST["password"]
        );
        $user = $dataOperation->get("kullanicilar",$where);
        if ($user){
            $_SESSION["user"] = $user;
        }else{
            header("location:index.php?msg=Kullanıcı Adı Veya Şifre Hatalı");
        }
    } elseif(isset($_POST["singup"])){
        //böylee bir kullanıcı var mı diye kontrol edilir
        $where = array(
            "username" => $_POST["username"]
        );
        $user = $dataOperation->get("kullanicilar", $where);
        if ($user){ //kullanıcı adı kulllanımdaysa hata
            header("location:index.php?msg=Kullanıcı adı kullanımda. Lütfen farklı bir kullanıcı adı deneyin.");
        }else { //kullanıcı yoksa oluştur.
            $data = array(
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "name" => $_POST["name"]
            );
            if ($dataOperation->add("kullanicilar", $data)){
                header("location:index.php?msg=Üyelik kaydınız alındı. Giriş yapabilirsiniz.");
            }else{
                header("location:index.php?msg=Bir hata oluştu. Daha sonra tekrar deneyin.");
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
        <h1>Hoş Geldiniz</h1>
        <?php
            if (isset($_SESSION["user"])){
                echo "<h2>".$_SESSION["user"]["name"]."</h2>";
                echo "<div align='center'><a href='Summary.php' class='summary_bt'>Hesap Özeti</a>
                      <a href='index.php?logout=out' id='cikis' class='cikis_bt' type='button'>Çıkış Yap</a></div> ";
            }else {
                ?>
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
                <?php
            }
        ?>
        <div class="main_img">
            <a href="Products.php?kategori=konaklama"> <img src="public/img/main.jpg" alt=""> </a>
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