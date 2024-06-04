
document.addEventListener('DOMContentLoaded', function () {
    // tab switch
    let btn_tab = document.querySelectorAll('.btn_tab');
    let mebrik_signup_form = document.querySelector('.mebrik_signup_form');
    let mebrik_login_form = document.querySelector('.mebrik_login_form');
    let click_here_create = document.querySelector('.click_here_create');

    if (click_here_create) {
        click_here_create.addEventListener('click', function () {
            mebrik_signup_form.classList.add('active_form');
            mebrik_login_form.classList.remove('active_form');

            if (btn_tab) {
                btn_tab.forEach(function (btn) {
                    btn.classList.remove('active_btn');
                });
                btn_tab[0].classList.add('active_btn');
            }
        });
    }

    btn_tab.forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn_tab.forEach(function (btn) {
                btn.classList.remove('active_btn');
            });
            if (btn.classList.contains('btn_new_customer')) {
                mebrik_login_form.classList.remove('active_form');
                mebrik_signup_form.classList.add('active_form');
            } else {
                mebrik_login_form.classList.add('active_form');
                mebrik_signup_form.classList.remove('active_form');
            }

            btn.classList.add('active_btn');
        });
    });

    // Ajax request
    jQuery(document).ready(function ($) {
        $('#signup-form').on('submit', function (e) {
            e.preventDefault();

            let hiddenApi = document.querySelector('.mebrik_signup_form');
            let api = hiddenApi.getAttribute('data-api');

            let signup_message = document.getElementById('signup_message');
            let signup_success_message = document.getElementById('signup_success_message');

            let formData = $('#signup-form').serialize();

            $.ajax({
                url: api,
                type: 'POST',
                data: formData,
                success: function (data) {
                    signup_success_message.innerHTML = data.message;
                    signup_message.innerHTML = '';
                    let hiddenApi = document.querySelector('.mebrik_login_form');
                    let loginApi = hiddenApi.getAttribute('data-login');
                    $.ajax({
                        url: loginApi,
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            if (data == true) {
                                // window.location.reload();
                                window.location.href = '/';
                            }
                        },
                        error: function (err) {
                            console.log('Login Erro While regester', err);
                        }
                    })

                },
                error: function (err) {
                    let parseError = JSON.parse(err.responseText);
                    signup_message.innerHTML = parseError['message'];
                    signup_success_message.innerHTML = '';
                }
            })
        });

        $('#login-form').on('submit', function (e) {
            e.preventDefault();
            let hiddenApi = document.querySelector('.mebrik_login_form');
            let loginApi = hiddenApi.getAttribute('data-login');

            let signin_message = document.getElementById('signin_message');
            let signin_success_message = document.getElementById('signin_success_message');

            let formData = $('#login-form').serialize();
            $.ajax({
                url: loginApi,
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    // signin_success_message.innerHTML= data.message;
                    signin_message.innerHTML = '';
                    if (data == true) {
                        // window.location.reload();
                        window.location.href = '/';
                    }
                },
                error: function (err) {
                    console.log('Error', err);
                    let parseError = JSON.parse(err.responseText);
                    console.log(parseError);
                    signin_message.innerHTML = parseError['message']['error'];
                    signin_success_message.innerHTML = '';
                }
            })
        });

    });
});





