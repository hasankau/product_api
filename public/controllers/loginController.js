$(document).ready(function(){
    $('#loginForm').submit(function(event) {
      event.preventDefault();
  
      var formData = {
        email: $('#email').val(),
        password: $('#password').val()
      };
  
      $.ajax({
        type: 'POST',
        url: '/api/login',
        data: formData,
        cache: false,
        dataType: 'json',
        success: function(response) {
          localStorage.setItem('token', response.token);
          setCookie('token', response.token, 1);
          window.location.href = '/';
        },
        error: function(xhr, status, error) {
          $('#message').text(xhr.responseJSON.error);
        }
      });
    });
  });

