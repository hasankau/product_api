$(document).ready(function () {
    var token = getCookieAuth();
    if (token != null) {
        $.ajax({
            type: 'GET',
            url: '/api/getProducts',
            data: '',
            cache: false,
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            },
            dataType: 'json',
            success: function (response) {
                response.forEach(function (item) {
                    var tbody = document.getElementById('products_table_body');
                    var tr = document.createElement('tr');

                    var attributesHtml = '';

                    item.attributes.forEach(function (attribute) {
                        attributesHtml += attribute.attribute_name + '<br>';
                    });

                    tr.innerHTML = `
                      <td><img src="/storage/${item.image}" alt="Product Image" width="50"></td>
                      <td>${item.id}</td>
                      <td>${item.name}</td>
                      <td>${item.description}</td>
                      <td>${item.code}</td>
                      <td>${item.category}</td>
                      <td>${item.sellingPrice}</td>
                      <td>${item.specialPrice}</td>
                      <td>${item.status}</td>
                      <td>${item.isDeliveryAvailable}</td>
                      <td>${attributesHtml}</td>
                      <td><a href="edit_product/${item.id}">Edit</a></td>
                      <td></td>
                    `;
                    tbody.appendChild(tr);
                });
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