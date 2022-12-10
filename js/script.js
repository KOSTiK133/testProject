$(document).ready(function(){
    var nameFunction = JSON.stringify({button:"load"});
    $.ajax({
        url: 'php/load.php',         /* Куда отправить запрос */
        method: 'post',             /* Метод запроса (post или get) */
        dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
        data:{dataform:nameFunction} , /* Данные передаваемые в массиве */
        success: function(data){
            $('#footer').css('visibility','visible');
            $('#nameAuth').text("Hello "+data['nameUser']);
            $("#form").css("visibility","hidden");
            /* функция которая будет выполнена после успешного запроса.  */
        },
        error: function (xhr) {
            console.log('Ошибка: ' + xhr.status + ' ' + xhr.statusText);
        }

    });
});
$('#exit').on('click',function () {
    var nameFunction = JSON.stringify({button:"exit"});
    $.ajax({
        url: 'php/load.php',         /* Куда отправить запрос */
        method: 'post',             /* Метод запроса (post или get) */
        dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
        data:{dataform:nameFunction} , /* Данные передаваемые в массиве */
        success: function(data){
            $('#footer').css('visibility','hidden');
            $("#form").css("visibility","visible");
            $('#nameAuth').text("");
        },
        error: function (xhr) {
            console.log('Ошибка: ' + xhr.status + ' ' + xhr.statusText);
        }

    });
});
$('#auth').on('click',function () {
    var password = $('#pass').val();
    var login = $('#login').val();

    var nameFunction = JSON.stringify({login:login,pass:password,button:"auth"});
    $.ajax({
        url: 'php/load.php',         /* Куда отправить запрос */
        method: 'post',             /* Метод запроса (post или get) */
        dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
        data:{dataform:nameFunction} , /* Данные передаваемые в массиве */
        success: function(data){
            if (typeof data['erorAuth'] !== 'undefined') {
                $('#errorAuth').text(data['erorAuth']);
            }
            if (typeof data['nameUser'] !== 'undefined') {
                $('#footer').css('visibility', 'visible');
                $('#nameAuth').text("Hello " + data['nameUser']);
                $("#form").css("visibility", "hidden");
            }
            else{
                $('#errorAuth').text("Пользователь не существует");
            }

        },
        error: function (xhr) {
            console.log('Ошибка: ' + xhr.status + ' ' + xhr.statusText);
        }

    });
});

$("#test").on('click',function () {
    var name = $('#name').val();
    var passConfirm = $('#confirm').val();
    var login = $('#login').val();
    var pass = $('#pass').val();
    var email = $('#email').val();
    if(name!="" && login!="" && pass!="" && email!="" && pass==passConfirm) {
        var dataForm = {name: name, login: login, pass: pass, email: email, button: "reg"};
        var dataFormJson = JSON.stringify(dataForm);
        $.ajax({
            url: 'php/load.php',         /* Куда отправить запрос */
            method: 'post',             /* Метод запроса (post или get) */
            dataType: 'json',          /* Тип данных в ответе (xml, json, script, html). */
            data: {dataform: dataFormJson}, /* Данные передаваемые в массиве */
            success: function (data) {
                console.log(data)
                $("#errorRegLogin").text(data['regLogin']);
                $("#errorLogin").text(data['login']);
                $("#errorPassword").text(data['password']);
                $("#errorEmail").text(data['email']);
                $("#errorName").text(data['name']);
                /* функция которая будет выполнена после успешного запроса.  */
            },
            error: function (xhr) {
                console.log('Ошибка: ' + xhr.status + ' ' + xhr.statusText);
                window.location.href = '../index.html';
            }

        });
    }
    else{
        $("#errorRegLogin").text("Заполните все поля");
    }
});

$('#confirm').on('change',function () {
    var pass = $('#pass').val();
    var passConfirm = $('#confirm').val();
    if(pass==passConfirm){
        $("#errorConfirm").text("");
    }
    else
    {
        $("#errorConfirm").text("Пароли не совпадают");
    }
});