
function showOrHide() {
    var loginBox = document.getElementById("login_box");
    if (loginBox.style.display === "none")
        loginBox.style.display = "block";
    else
        loginBox.style.display = "none";

    var singUpBox = document.getElementById("sing_up_box");
    if (singUpBox.style.display === "none")
        singUpBox.style.display = "block";
    else
        singUpBox.style.display = "none";
}
