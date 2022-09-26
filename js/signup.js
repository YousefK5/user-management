let emailInput=document.getElementById('email');
let phoneInput=document.getElementById('phone');
let nameInput=document.getElementById('name');
let passwordInput=document.getElementById('password');
let cPasswordInput=document.getElementById('cPassword');
let dateInput=document.getElementById('date');

let emailRegex=/^[A-Z]+\s[A-Z]+\s[A-Z]+\s[A-Z]+$/i;
let pre=document.createElement('p');
let isName;

let passwordRegex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
let pre2=document.createElement('p');
let isPass;

let pre3=document.createElement('p');
let isCPass;

let pre4=document.createElement('p');
let isPhone;

let pre5=document.createElement('p');
let isAge;

nameInput.onblur = function() {
    isName = emailRegex.test(nameInput.value.trim());
    if (!isName) {
        pre.style.cssText = "color:red";
        pre.innerHTML='Full Name Must Be 4 Sections (Seperate It by Spaces)<br> Ex: Yousef Khaled Yousef Suleiman ' ;
        nameInput.after(pre);
    }
    else {
        pre.remove();
    }
}

passwordInput.onblur = function() {
    isPass=passwordRegex.test(passwordInput.value.trim());
    isPass= isPass ? !/\s/.test(passwordInput.value.trim()) : false;
    console.log(isPass);
    if (!isPass) {
        pre2.style.cssText = "color:red";
        pre2.innerHTML='Password Must Be Contain (UpperCase , LowerCase , number , Special Charachter) and Spaces Are Not Allowed' ;
        passwordInput.after(pre2);
    }
    else {
        pre2.remove();
    }
}

cPasswordInput.onblur = function() { 
    isCPass = passwordInput.value.trim() === cPasswordInput.value.trim();
    if (!isCPass) {
        pre3.style.cssText = "color:red";
        pre3.innerHTML='Confirm Password Must Be Equal Password' ;
        cPasswordInput.after(pre3);
    }
    else {
        pre3.remove();
    }
}

phoneInput.onblur = function() { 
    isPhone= phoneInput.value.length==14;
    if (!isPhone) {
        pre4.style.cssText = "color:red";
        pre4.innerHTML='Phone Must Be 14 Digit' ;
        phoneInput.after(pre4);
    }
    else {
        pre4.remove();
    }
}

let nowDate = new Date();
nowDate=nowDate.toISOString().split('T')[0];

dateInput.onblur =function() {
    let age=parseInt(nowDate)-parseInt(dateInput.value);
    isAge=age>=16;
    if (!isAge) {
        pre5.style.cssText = "color:red";
        pre5.innerHTML='Age Must Be Above 16 years' ;
        dateInput.after(pre5);
    }
    else {
        pre5.remove();
    }
}


document.forms[0].onsubmit = function (e) {
    e.preventDefault();
    if(isName && isPass && isCPass && isPhone && isAge) {
        let params=`email=${emailInput.value.trim()}&phone=${phoneInput.value}&name=${nameInput.value.trim()}&pass=${passwordInput.value.trim()}&birthDate=${dateInput.value}`;
        const xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //     document.forms[0].after(this.responseText);
        //     }
        // };
        xhttp.open("POST", "../Task3/php/signup.php");
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(params);

        window.location.href = 'php/welcome.php';
    }
}