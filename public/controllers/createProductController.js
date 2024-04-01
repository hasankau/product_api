$(document).ready(function () {
    $('#productForm').submit(function (event) {
        event.preventDefault();

        var formData = new FormData($('#productForm')[0]);
        var token = getCookieAuth();
        if (token != null) {
            $.ajax({
                type: 'POST',
                url: '/api/createProduct',
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                },
                success: function (response) {
                    $('#productForm')[0].reset();
                    alert(response.message);
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 401) {
                        window.location.href = '/login';
                    } else {
                        $('#message').text(xhr.responseJSON.error);
                    }
                }
            });
        } else {
            window.location.href = '/login';
        }
    });

});