$("#loginform").submit(function (event) {
  event.preventDefault();

  var form = $(this);
  var action = form.attr("action");
  var data = form.serialize();

  $.ajax({
    url: action,
    data: data,
    type: "post",
    dataType: "json",
    beforeSend: function (load) {
      $(".preloader").fadeIn();
    },
    success: function (su) {
      $(".preloader").fadeOut();

      if (su.message) {
        inputAlert("#loginform input", "error");
        toast(su.message.type, su.message.message, 3000);

        return;
      }

      if (su.redirect) {
        window.location.href = su.redirect.url;
      }
    },
  });
});
function inputAlert(elem, color, time = 3000) {
  $(elem).addClass(color);
  setTimeout(function () {
    $(elem).removeClass(color);
  }, time);
}

// var form = $(this);
// 	var formData = form.serialize();
// 	var btn = form.find('[type="submit"]');
// 	btn.attr('disabled', true);
// 	btn.html('Enviando <i class="fas fa-spinner fa-pulse ml-2"></i>');

// 	$.ajax({
// 		url: './controller/login.php',
// 		type: 'POST',
// 		dataType: 'json',
// 		data: formData,
// 	}).done(function(data) {
// 		if(data.cod == '1'){
// 			location.href = './';
// 			btn.html('Entrando <i class="fas fa-check-circle ml-2"></i>');
// 		} else {
// 			inputAlert('#loginform input', 'errorLogin');
// 			btn.html('Erro <i class="fas fa-exclamation-circle ml-2"></i>');
// 			toast('warning', data.message, 3000);
// 			setTimeout(function() {
// 				btn.html('Entrar');
// 				btn.attr('disabled', false);
// 			}, 3000);
// 		}
// 	});
