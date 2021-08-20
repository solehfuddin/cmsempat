// Handle Form Login
$(document).ready(function() {
    $('.formLogin').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnLogin').prop('disabled', true);
                $('.btnLogin').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnLogin').prop('disabled', false);
                $('.btnLogin').html('Login');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.inputuser){
                        $('#inputuser').addClass('is-invalid');
                        $('.handlermail').html('');
                    }
                    else
                    {
                        $('#inputuser').removeClass('is-invalid');
                        $('.handlermail').html('<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>');
                    }

                    if (response.error.password){
                        $('#password').addClass('is-invalid');
                        $('.handlerpass').html('');
                    }
                    else
                    {
                        $('#password').removeClass('is-invalid');
                        $('.handlerpass').html('<span class="input-group-text"><i class="dw dw-padlock1"></i></span>');
                    }

                    if (response.error.password)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.password,
                            'error',
                        );
                    }

                    if (response.error.inputuser)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.inputuser,
                            'error',
                        );
                    }

                    if (response.error.errorauth)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.errorauth,
                            'warning',
                        );
                    }
                }
                else
                {
                    window.location = response.success.link;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    })
});