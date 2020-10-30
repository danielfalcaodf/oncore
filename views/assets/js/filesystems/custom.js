$("#filesystem .filepath").click(function (e) {
  e.preventDefault();
  var url = $(this).attr("href");

  $.ajax({
    type: "get",
    url,
    dataType: "json",
    success: function (response) {
      console.log(response);
    },
  });
});
