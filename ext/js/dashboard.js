app.controller("dashboardController", function ($scope) {

  $scope.categories  = json(baseurl + "api/get/category");
  $scope.category    = $scope.categories[0];
  $scope.category_id = $scope.categories[0].category_id;
  $scope.dateFilter  = moment().format("DD MMM YYYY");
  $scope.planType    = "guest";

  var room = json(baseurl + "api/detail/room/" + hash());
  $scope.room    = [];

  $scope.detailRoom = function (room_id) {
    $scope.room = json(baseurl + "api/detail/room-number/" + room_id);

    $("#modal-detail").modal("show");
  };


  $scope.dashboardType = function () {
    var index = 0;
    $.each($scope.categories, function (i, each) {
      if (each.category_id == $scope.category_id) index = i;
    });
    $scope.category = $scope.categories[index];

    $scope.data     = json(baseurl + "api/get/dashboard", {type: $scope.category_id, date: $scope.dateFilter, planType: $scope.planType});

    //$scope.total_vc = json(baseurl + "api/detail/total-room-status/VC", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_ea = json(baseurl + "api/detail/total-room-status/EA", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_od = json(baseurl + "api/detail/total-room-status/ED", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_ed = json(baseurl + "api/detail/total-room-status/OD", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_vd = json(baseurl + "api/detail/total-room-status/VD", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
  };

  $scope.initHeader = function () {
    var tanggal = new Date($scope.dateFilter);

    $scope.header = [
      moment(tanggal).add(0, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(1, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(2, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(3, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(4, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(5, "day").format("DD/MM/YYYY"),
      moment(tanggal).add(6, "day").format("DD/MM/YYYY")
    ];

  };

  $scope.toggleDate = function () {
    $scope.data = json(baseurl + "api/get/dashboard", {type: $scope.category_id, date: $scope.dateFilter, planType: $scope.planType});
    $scope.initHeader();
    //$scope.total_vc = json(baseurl + "api/detail/total-room-status/VC", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_ea = json(baseurl + "api/detail/total-room-status/EA", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_od = json(baseurl + "api/detail/total-room-status/ED", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_ed = json(baseurl + "api/detail/total-room-status/OD", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
    //$scope.total_vd = json(baseurl + "api/detail/total-room-status/VD", {category_id: $scope.category_id, date: $scope.dateFilter}).count;
  };

  $scope.dashboardType();
  $scope.initHeader();
});

$(document).ready(function () {
  $("#date-filter").datepicker({
    autoclose  : true,
    format     : "dd M yyyy",
    orientation: "bottom left"
  });
});
