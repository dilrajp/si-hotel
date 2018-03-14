//Controller
app.controller("listController", function ($scope) {
  $scope.data = json(baseurl + "api/get/reservation", {type: "Ongoing"});
});

app.controller("detailController", function ($scope) {
  $scope.checkout_url    = baseurl + "api/update/checkout";
  $scope.deposit_url     = baseurl + "api/insert/deposit";
  $scope.transaction_url = baseurl + "api/insert/registration";
  $scope.detail          = json(baseurl + "api/detail/registration/" + hash());
  $scope.deposit         = $scope.detail.deposit_list;
  $scope.balance         = $scope.detail.balance;

  $scope.addDeposit = function (reservation_id) {
    var reservation = json(baseurl + "api/detail/reservation-for-deposit/" + reservation_id);

    $scope.reservation_id = reservation_id;
    $scope.deposit_amount = reservation.amount;

    $("#modal-deposit").modal('show');
  };

  $scope.addCorrection = function (reservation_id) {
    var reservation = json(baseurl + "api/detail/reservation-for-deposit/" + reservation_id);

    $scope.reservation_id = reservation_id;
    $scope.deposit_amount = reservation.amount;

    $("#modal-correction").modal('show');
  };


  $scope.chargeRoom = function (reservation_id) {
    var reservation = json(baseurl + "api/detail/reservation-for-deposit/" + reservation_id);
    $scope.jml_kamar = json(baseurl + "api/detail/room-charge/" + reservation_id);

    $scope.reservation_id = reservation_id;
    $scope.deposit_amount = reservation.amount;

    $("#modal-room").modal('show');
  };


  $scope.addTransaction = function (reservation_id) {
    var reservation = json(baseurl + "api/detail/reservation-for-registration/" + reservation_id);

    $scope.reservation_id = reservation_id;
    $scope.billing_amount = reservation.amount;

    $("#modal-transaction").modal('show');
  };

  $scope.checkOut = function () {
    $("#modal").modal("show");
  };

  $scope.getSubtotal = function () {
    var subTotal = 0;
    $.each($scope.detail.detail, function (index, each) {
      subTotal += each.formatted_marker_date === $scope.detail.reservation_dateout ? 0 : parseInt(each.marker_roomrate);
    });

    return subTotal;
  };

  $scope.getTotal = function () {
    var subtotal = parseInt($scope.getSubtotal());
    subtotal -= (subtotal * (parseInt($scope.detail.company_discount) + parseInt($scope.detail.payment_discount))) / 100;

    return subtotal;
  };

  $scope.parseInt = function (source) {
    return parseInt(source, 10);
  };

  
});
