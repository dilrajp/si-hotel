app.controller("detailController", function ($scope) {
  var room = json(baseurl + "api/detail/room/" + hash());

  $scope.data   = room.data;
  $scope.detail = room.detail;

  $scope.formurl = baseurl + "api/insert/room";
  $scope.room    = [];

  $scope.detailRoom = function (room_id) {
    $scope.room = json(baseurl + "api/detail/room-number/" + room_id);

    $("#modal-detail").modal("show");
  };

  $scope.manageRoom = function (room_id) {

    $scope.room = [];
    $("#modal-manage form").attr("action", baseurl + "api/insert/room");
    $("#modal-manage input[type='text']").val("");

    if (room_id) {
      $scope.room = json(baseurl + "api/detail/room-number/" + room_id);
      console.log($scope.room);
      $("#modal-manage form").attr("action", baseurl + "api/update/room/" + $scope.room["room_id"]);
    }

    $("#modal-manage").modal('show');
  };
});

app.controller("categoryController", function ($scope) {
  $scope.isUpdating = hash() !== "room";

  $scope.detail = [];

  if ($scope.isUpdating) {
    $scope.detail = json(baseurl + "api/detail/room/" + hash()).detail;
  }

  $scope.formurl = baseurl + "api/" + ($scope.isUpdating ? "update" : "insert") + "/category";
});

$(document).ready(function(){
  $("#datepicker").datepicker({
    autoclose  : true,
    format     : "dd MM yyyy",
    orientation: "bottom left",
    startDate  : new Date(moment())
  });
});
