$(document).ready(function () {
    loadProduct();
});

function loadProduct() {
    var path = window.location.pathname;
    var parts = path.split('/');
    var id = parts[parts.length - 1];
    var token = getCookieAuth();
    if (token != null) {
        $.ajax({
            type: 'GET',
            url: '/api/getProduct/' + id,
            data: '',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            },
            dataType: 'json',
            success: function (response) {

                var product = response[0];
                $('#id').val(product.id);
                $('#name').val(product.name);
                $('#description').val(product.description);
                $('#code').val(product.code);
                $('#category').val(product.category);
                $('#imagePrev').attr('src', "/storage/" + product.image);
                $('#sellingPrice').val(product.sellingPrice);
                $('#specialPrice').val(product.specialPrice);
                $('#status').val(product.status);
                $('#isDeliveryAvailable').prop('checked', product.isDeliveryAvailable);

                var attributes = product.attributes;

                var attributesSelect = $('#attributes');
                attributesSelect.empty();

                attributes.forEach(function (attribute) {
                    var option = new Option(attribute.attribute_name, attribute.attribute_name, false, false);
                    attributesSelect.append(option);
                });

                attributesSelect.select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                });

                var selectedValues = attributes.map(function (attribute) {
                    return attribute.attribute_name.toString();
                });
                attributesSelect.val(selectedValues).trigger('change');

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
}

$(document).ready(function () {
    $('#productEditForm').submit(function (event) {
        event.preventDefault();

        var formData = new FormData($('#productEditForm')[0]);
        var token = getCookieAuth();
        if (token != null) {
            $.ajax({
                type: 'POST',
                url: '/api/editProduct',
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
                    loadProduct();
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


$(document).ready(function () {
    $('#delete').click(function (event) {
        event.preventDefault();

        var confirmDelete = confirm("Are you sure you want to delete this product?");
        var formData = new FormData($('#productEditForm')[0]);
        if (confirmDelete) {
            var token = getCookieAuth();
            if (token != null) {
                $.ajax({
                    type: 'POST',
                    url: '/api/deleteProduct',
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
                        alert(response.message);
                        window.location.href = '/';
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
        }
    });
});
