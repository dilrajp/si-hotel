var jcrop;
var maxRoomSelection = 0;

$(document).ready(function () {

  submit(".reloadform", function (response) {
    location.reload();
  });

  $(".datatable").DataTable();

  $(".select2").each(function () {
    $(this).select2({
      placeholder: $(this).attr("title")
    });
  });
});

function hash() {
  return location.href.split('/').pop();
}

function limit(source) {
  if ($("input.limit-checkbox:checked").length > maxRoomSelection) $(source).prop("checked", false);
}

function url() {
  return location.href;
}

function validatePrice(source) {
  var val = $(source).val();

  if (!val) val = 0;

  $(source).val(parseInt(val));
}
