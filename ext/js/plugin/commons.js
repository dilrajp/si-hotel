function ajax(source, event, callback) {
  event.preventDefault();

  var form      = $(source);
  var form_data = new FormData($(source)[0]);

  $.ajax({
    url        : form.attr("action"),
    type       : form.attr("method"),
    data       : form_data,
    dataType   : "json",
    async      : false,
    contentType: false,
    processData: false,
    success    : function (json) {
      callback(json);
    }
  });
}

function json(url, data) {
  var response = null;

  $.ajax({
    url     : url,
    type    : "post",
    data    : (data ? data : {}),
    async   : false,
    dataType: "json",
    success : function (json) {
      response = json;
    }
  });

  return response;
}

function submit(source, callback) {
  $(source).submit(function (event) {
    event.preventDefault();

    var form = $(this);
    ajax(form, event, function (response) {
      toastr[response.status](response.message);
      if (response.status === "success") {
        setTimeout(function () {
          callback(response);
        }, 1000);
      }
    });
  });
}
