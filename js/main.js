function openRegisterModal() {
    showRegisterForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}


function showRegisterForm() {
    $('.loginBox').fadeOut('fast', function () {
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast', function () {
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    });
    $('.error').removeClass('alert alert-danger').html('');

}

function RegistrationAjax(e) {
    $.post("registration.php", function () {
        var userName = $('#registrationName').val();
        var password = $('#registrationPassword').val();
        var re_password = $('#registrationPassword_confirmation').val();

        if (!userName == "") {
            if (!password == "") {
                if (!re_password == "") {
                    if (!(password == re_password)) {
                        shakeModal("password didn't match");
                    } else {
                        $.post('registration.php', { postName: userName, postPassword: password },
                            function (data) {
                                if (data == 1) {
                                    registrationComplete();
                                }
                                if (data == 2) {
                                    shakeModal("username has been taken");
                                }
                                if (data == 3) {
                                    alert("please try again");
                                }
                            });
                    }

                } else {
                    shakeModal("password confirmation cannot be empty");
                }
            } else {
                shakeModal("password cannot be empty");
            }
        } else {
            shakeModal("username cannot be empty");
        }
    });
    e.preventDefault();

}


function openLoginModal() {
    showLoginForm();
    setTimeout(function () {
        $('#loginModal').modal('show');
    }, 230);

}

function showLoginForm() {
    $('#loginModal .registerBox').fadeOut('fast', function () {
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast', function () {
            $('.login-footer').fadeIn('fast');
        });

        $('.modal-title').html('Login with');
    });
    $('.error').removeClass('alert alert-danger').html('');
}

function loginAjax(check) {
    $.post("index.php", function () {
        var userName = $('#userName').val();
        var password = $('#password').val();

        if (userName == "" || password == "") {
            shakeModal("Username or Password cannot be empty");
        } else {
            $.post('logIn.php', { postName: userName, postPassword: password },
                function (data) {
                    if (data.split(",")[0] == 1) {
                        localStorage.setItem('user', data.split(",")[1]);
                        window.location.replace("adminpage.php");
                    } else if (data.split(",")[0] == 2) {
                        localStorage.setItem('user', data.split(",")[1]);
                        location.reload();
                    } else {
                        shakeModal("Wrong Username or Password");
                    }
                });
        }
    });
}

function shakeModal(error) {
    $('#loginModal .modal-dialog').addClass('shake');
    $('.error').addClass('alert alert-danger').html(error);
    $('input[type="password"]').val('');
    $('input[type="text"]').val('');
    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('shake');
    }, 1000);
}

function registrationComplete() {
    $('#loginModal .modal-dialog').addClass('');
    $('.error').addClass('alert successfully-submit').html("Registration Complete,Please LogIn");
    $('input[type="password"]').val('');
    $('input[type="text"]').val('');

    setTimeout(function () {
        $('#loginModal .modal-dialog').removeClass('');
    }, 1000);
}

function logout() {
    localStorage.removeItem('user');
}