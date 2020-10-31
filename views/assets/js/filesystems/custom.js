$(document).ready(function () {
  filepath();
});
filepath = () => {
  $("#filesystem .filepath").click(function (e) {
    e.preventDefault();
    var url = $(this).attr("href");

    $.ajax({
      type: "get",
      url,
      dataType: "json",
      success: function (response) {
        if (response.message.type == "error") {
          // toast("asdasd");
          toast(response.message.type, response.message.message, 3000);
          return;
        }
        var view = "";

        $.each(response.listing, function (indexInArray, valueOfElement) {
          view += `
                  <tr>
                    <td>
                        <input type="checkbox" name="" id="" autocomplete="off">
                    </td>
  
                    <td>
  
                        <div class="filename">
                            <a name="" id="" class="btn btn-outline-gray filepath" href="${valueOfElement.href}" role="button">
                                <i class="${valueOfElement.img}"></i>
                                ${valueOfElement.name}
                            </a>
                        </div>
                    </td>
                    <td>
                    ${valueOfElement.typeSize}
                    </td>
                    <td>${valueOfElement.lastDate}</td>
                    <td class="text-nowrap">
                        <a href="#" data-toggle="tooltip" data-original-title="Edit" aria-describedby="tooltip769723"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                        <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fas fa-times text-danger"></i> </a>
                    </td>
                  </tr>
                `;
        });

        $("#filetbody").html(view);
        filepath();
        console.log(response);
      },
    });
  });
};
