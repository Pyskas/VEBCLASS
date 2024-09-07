<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="regist.css">
    <title>Registration</title>
</head>

<body>
<header class="container">
        <article class="sec_one">
            <section class="logo_left">
                <p class="r70038">VEBCLASS</p>
            </section>
            <section class="center_sec">
                <a class="head_link" href="index.php">Главная</a>
                <div class='head_link'>
                    <?php
                    if(isset($_COOKIE['idUser'])){
                        echo "<a class='head_link' href='/account.php'>Профиль</a>";
                    }else{
                        echo "<a class='head_link' href='/autorization.php'>Авторизация</a>";
                    }
                    ?>
                </div>
                <a class="head_link" href="reg.php">Регистрация</a>
                <a class="head_link" href="lookmore.php">Курсы</a>
            </section>
            <section class="right_sec">
                <div class="d1">
                    <form>
                        <input type="text">
                        <button type="submit"><img class="search" src="/img/Search_Icon.svg" alt="search"></button>
                    </form>
                </div>
                <button class="cart_btn">
                    <img src="/img/Cart_Icon.svg" alt="cart">
                    <a class="cart" href="#demo-2-bottom" id="demo-2-top">Курсы</a>
                </button>
            </section>
        </article>
    </header>

    <main class="container">
        <section class="height">
        <article class="fomrs">
            <form action="connect.php" name="autoreg" method="post">

                    <p class="regost">Регистрация</p>

               <div class="hern">

                    <p class="fname">Аватарка</з>
                    <input type="file" accept="img/png, image/jpg" name="image" placeholder="">

                    <p class="fname">ФИО</з>
                    <input type="text" id="validinp" minlength="5" maxlength="50" name="full_name" class="flname" required placeholder="Введите ФИО">
        
                    <p class="fname">Логин</з>
                    <input type="text" id="validinp" minlength="5" maxlength="50" name="login" pattern="^[a-zA-Z]+$" class="flname" required placeholder="Введите Логин">

                    <p class="fname">E-mail</з>
                    <input type="email" id="validinp" name="email" class="flname" required placeholder="Введите почту">

                    <p class="fname">Пароль</з>
                    <input type="password" id="validinp" minlength="5" maxlength="50" name="password" class="flname" required placeholder="Введите пароль">

 

                </div>
                
                <button type="submit" id="submit" class="next_button">Заргеистрироваться</button>
                    

            </form>
        </article>
        </section>
                </main>

    <script>
        //const keyBox = document.autoreg.login;
//const keyBox1 = document.autoreg.full_name;
//const keyBox2 = document.autoreg.email;
//const keyBox3 = document.autoreg.password;

//function onblur(e) {
    //const text = keyBox.value.trim();
    //const text1 = keyBox1.value.trim();
    //const text2 = keyBox2.value.trim();
    //const text3 = keyBox3.value.trim();
    
   // if (text === "" || text1 === "" || text2 === "" || text3 === "") {
      //  keyBox.style.borderColor = "red";
      //  keyBox1.style.borderColor = "red";
      //  keyBox2.style.borderColor = "red";
       // keyBox3.style.borderColor = "red";
    //} else {
       // keyBox.style.borderColor = "green";
       // keyBox1.style.borderColor = "green";
        //keyBox2.style.borderColor = "green";
       // keyBox3.style.borderColor = "green";
    //}
//}

// keyBox.addEventListener("blur", onblur);
// keyBox1.addEventListener("blur", onblur);
// keyBox2.addEventListener("blur", onblur);
// keyBox3.addEventListener("blur", onblur);


const anketaform = document.autoreg;
const inputList = anketaform.getElementsByTagName("input");
const submit1 = document.getElementById("submit");

function onblur(e){
    const input = e.target;
    if(input.value.trim() === ""){
        input.style.borderColor = "red";
    } else {
        input.style.borderColor = "green";
    }
}

for (let i of inputList){
   i.addEventListener("blur", onblur);
}

const autoreg = document.autoreg;
const submit = autoreg.submit;
submit.addEventListener("click", validate);

function validate(){
    if(autoreg.value === "admin"){
        autoreg.setCustomValidity("Недопустимое имя пользователя");
    }
    if (autoreg.getelementbyid(validinp).validity.valueMissing){    
        autoreg.getelementbyid(validinp).setCustomValidity("Необходимо заполнить поле");
    }
    if (autoreg.getelementbyid(validinp).validity.tooLong){
        autoreg.getelementbyid(validinp).setCustomValidity("Это поле не должно превышать 20 символов");
    }
    if (autoreg.getelementbyid(validinp).validity.tooShort){
        autoreg.getelementbyid(validinp).setCustomValidity("Это поле не должно быть меньше 5 символов");
    }
}
    </script>

</body>

</html>