$(document).ready(function () {
    $('.form-exeption').hide();
    $('.add-task').click(function () {
        if (!$('#input-name').val() && !$('#input-email').val() && !$('#input-body').val()) {
            $('.form-exeption').text('Please check the data. Fields cannot be empty');
            $('.form-exeption').show();
        } else if (validationEmail($('#input-email').val()) == false) {
            $('.form-exeption').text('Email is not valid. Please check the email');
            $('.form-exeption').show();
        } else {

            $.ajax({
                type: "POST", //Метод отправки
                url:  $('.TaskForm').attr('action'), //путь до php фаила отправителя
                data: {
                    'name': $('#input-name').val(),
                    'email': $('#input-email').val(),
                    'body':  $('#input-body').val()
                },
                success: function () {
                    $('.msg').text('Your task was added');
                    $('.msg').show();
                    $("#modalScrollable").modal('hide')
                    setTimeout(function () {
                        document.location.href = "/";
                    }, 1000);

                }
            });


        }
    });

    $('.make-done').click(function () {
        if ('@Session["authenticated"]' != null) {
            $.ajax({
                type: "post",
                url: "/task/update",
                dataType: 'json',
                data: {
                    'id': $(this).attr('data-id'),
                    'status': 1
                },

            });
              location.reload();

        }
    });


    function validationEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        } else {
            return true;
        }
    }
});


