let emailInput=document.getElementById("email");
let passwordInput=document.getElementById("password");

let pre=document.createElement("p");
pre.style.cssText = "color:red";
pre.innerHTML ="Invalid Information";

document.forms[0].onsubmit= function(e) {
    e.preventDefault();
    let params=`email=${emailInput.value.trim()}&pass=${passwordInput.value}`;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText==0) {
                passwordInput.after(pre);
            }
            else if(this.responseText ==1) {
                location.href = "php/welcome.php";
            }
            else if(this.responseText==2) {
                location.href = "php/admin.php";
            }
        }
    };
    xhttp.open("POST", "../Task3/php/login.php");
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(params);
}