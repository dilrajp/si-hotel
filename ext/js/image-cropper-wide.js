var holder_width;
$(document).ready(function () {

  holder_width = $("#image-preview").width();

  $("#image-picker").change(function () {

    if (typeof jcrop !== 'undefined') {
      jcrop.destroy();
    }

    $("#image-preview").removeAttr("style");
    $("#image-preview").hide();
    $("#image-preview").attr("src", "");

    var reader    = new FileReader();
    reader.onload = function (e) {
      $("#image-preview").attr('src', e.target.result);
    }
    reader.readAsDataURL($(this)[0].files[0]);

    setTimeout(function () {
      $("#image-preview").show();

      var realWidth  = $("#image-preview")[0].naturalWidth;
      var realHeight = $("#image-preview")[0].naturalHeight;

      var displayWidth  = holder_width;
      var displayHeight = (displayWidth * realHeight) / realWidth;

      var selection = displayHeight > displayWidth ? displayWidth : displayHeight;
      selection++;

      jcrop = $.Jcrop("#image-preview", {
        allowSelect: false,
        aspectRatio: 16 / 9,
        boxHeight  : displayHeight,
        boxWidth   : displayWidth,
        minSize    : [160, 90],
        onChange   : cropCallback,
        onSelect   : cropCallback,
        bgFade     : true,
        bgOpacity  : .2
      });
      jcrop.setImage($("#image-preview").attr("src"));

      jcrop.animateTo([0, 0, selection, selection]);

      //$.notify("Silahkan crop foto anda", "info");
    }, 1000);
  });

});

function cropCallback(e) {
  $("#image-param").val(parseInt(e.x) + "," + parseInt(e.y) + "," + parseInt(e.x2) + "," + parseInt(e.y2));
}
