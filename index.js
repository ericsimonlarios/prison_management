document.getElementById('register').addEventListener("click", slideLeft);

function slideLeft(){
    document.getElementById('login-form').style.right="-100%";
    document.getElementById('register-form').style.right="0%";
}

document.getElementById('login').addEventListener("click", slideRight);

function slideRight(){
    document.getElementById('register-form').style.right="-100%";
    document.getElementById('login-form').style.right="0%";
}     