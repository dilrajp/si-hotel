app.factory("holder", function () {
  return {};
});

//Controller
app.controller("listController", function ($scope) {
  $scope.data           = json(baseurl + "api/get/reservation", {type: hash()});
  $scope.reservation_id = "";

  $scope.getBalance = function (deposit, billing) {
    return parseInt(deposit) - parseInt(billing);
  }

  $scope.hasBalance = function (deposit, billing) {
    return (parseInt(deposit) - parseInt(billing)) < 0;
  }

  $scope.isChecked = function (type) {
    return hash() === type;
  };

  $scope.reservationType = function (type) {
    location.href = baseurl + "page/reservation/" + type;
  };
});

app.controller("detailController", function ($scope) {
  $scope.checkin_url = baseurl + "api/update/checkin";
  $scope.deposit_url = baseurl + "api/insert/deposit";
  $scope.detail      = json(baseurl + "api/detail/reservation/" + hash());

  $scope.addDeposit = function (reservation_id) {
    var reservation = json(baseurl + "api/detail/reservation-for-deposit/" + reservation_id);

    $scope.reservation_id = reservation.reservation_id;
    $scope.deposit        = reservation.amount;

    $("#modal-deposit").modal('show');
  };

  $scope.checkIn = function () {
    $scope.formurl = baseurl + "api/update/checkin";
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

app.controller("baseController", function ($scope) {
  $scope.isUpdating = hash() !== "reservation";
  $scope.detail     = $scope.isUpdating ? json(baseurl + "api/detail/reservation/" + hash()) : [];
  $scope.formurl    = baseurl + "api/" + ($scope.isUpdating ? "update" : "insert") + "/reservation";
});

app.controller("periodController", function ($scope, holder) {
  $scope.period = {
    categories: json(baseurl + "api/get/period-categories"),
    category  : [],
    fitTotal  : 0,
    groupTotal: 0,
    last_date : ''
  };

  $scope.baseTotalPrice = function () {
    if (holder.period !== undefined && holder.period.room_info !== null) {
      holder.period.fitTotal   = 0;
      holder.period.groupTotal = 0;
      $.each(holder.period.room_info, function (index, each) {
        holder.period.fitTotal += (index === holder.period.room_info.length - 1 ? 0 : parseInt(each.price_fit));
        holder.period.groupTotal += (index === holder.period.room_info.length - 1 ? 0 : parseInt(each.price_group));
      });
    }
  };

  $scope.listRoom = function ($event, category_id) {
    if ($scope.period.date_in !== "" && $scope.period.date_out !== "") {

      if ($event && category_id) {
        holder.payment.room_list = [];

        if ($event.target.checked) {
          $scope.period.category.push(category_id);
        } else {
          var index = $scope.period.category.indexOf(category_id);
          if (index != -1) $scope.period.category.splice(index, 1);
          holder.reservation.room_list     = [];
          holder.reservation.selected_room = [];
        }
      }

      if ($scope.period.category.length === 0) {
        $scope.period.fitTotal   = "";
        $scope.period.groupTotal = "";
      }

      var date_in  = moment($scope.period.date_in, 'DD MMM YYYY');
      var date_out = moment($scope.period.date_out, 'DD MMM YYYY');
      var data     = $.param({categories: $scope.period.category}) + "&" + $.param({guest_type: holder.guest.guest_type, datein: $scope.period.date_in, dateout: $scope.period.date_out});

      $scope.period.duration       = date_out.diff(date_in, 'days');
      $scope.period.baseTotalPrice = 0;
      $scope.period.room_info      = json(baseurl + "api/get/period-roominfo", data);

      holder.reservation.room_list = $scope.period.room_info ? json(baseurl + "api/get/reservation-roomlist", data) : [];
    }
  }

  holder.period = $scope.period;
});

app.controller("reservationController", function ($scope, holder) {
  $scope.reservation = {
    by            : "Walk In",
    extra_bed     : "No",
    room_available: false,
    room_list     : [],
    selected_room : [],
    total         : 10000
  };

  $scope.addRoom = function ($event, room_number) {

    if ($event && room_number) {
      holder.payment.total = 0;
      if ($event.target.checked) {
        $scope.reservation.selected_room.push(room_number);
      } else {
        var index = $scope.reservation.selected_room.indexOf(room_number);
        if (index != -1) $scope.reservation.selected_room.splice(index, 1);
      }
    }
    $scope.reservation.selected_room.sort();

    holder.payment.room_list = json(baseurl + "api/get/payment-roomlist", $.param({room_number: holder.reservation.selected_room, guest_type: holder.guest.type, datein: holder.period.date_in, dateout: holder.period.date_out}));
  };

  $scope.setPrice = function ($event) {
    $scope.extrabed_price = $event.target.checked ? $scope.reservation.extra_bed : 0;
  };

  holder.reservation = $scope.reservation;
});

app.controller("guestController", function ($scope, holder) {
  $scope.guest         = {
    companies: json(baseurl + "api/get/company"),
    type     : "FIT",
    title    : "Mr.",
    lastname : ""
  };
  $scope.guest.company = $scope.guest.companies[0];

  $scope.getCompany = function () {
    var i = 0;
    $.each($scope.guest.companies, function (index, each) {
      if (each.company_id === $("select[name='company_id'] option:selected").val()) i = index;
    });
    $scope.guest.company  = $scope.guest.companies[i];
    $scope.guest.discount = parseInt($scope.guest.company.company_discount);

    var discount   = parseInt(holder.guest.type === 'Group' ? holder.guest.company.company_discount : 0) + parseInt(holder.payment.discount);
    var room_price = 0;

    $.each(holder.payment.room_list, function (index, each) {
      room_price += parseInt(each.room_rate);
    });

    holder.payment.total = room_price - ((room_price * discount) / 100);
  };

  $scope.paymentReview = function () {
    holder.payment.room_list = json(baseurl + "api/get/payment-roomlist", $.param({room_number: holder.reservation.selected_room, guest_type: holder.guest.type, datein: holder.period.date_in, dateout: holder.period.date_out}));
  };

  $scope.sameAsGuest = function ($event) {
    if ($event.target.checked) {
      $scope.guest.reserver_name    = $scope.guest.firstname + " " + $scope.guest.lastname;
      $scope.guest.reserver_contact = $scope.guest.contact;

      $scope.guest.lock_reserver = true;
    } else {
      $scope.guest.reserver_name    = "";
      $scope.guest.reserver_contact = "";

      $scope.guest.lock_reserver = false;
    }
  }


  holder.guest = $scope.guest;
});

app.controller("paymentController", function ($scope, holder) {
  $scope.payment              = {
    by              : "Cash",
    deposit         : 0,
    discount        : 0,
    total           : 0,
    travel_agents   : json(baseurl + "api/get/travel-agent"),
    type            : "Personal",
    with_travelagent: "No"
  };
  $scope.payment.travel_agent = $scope.payment.travel_agents[0];

  $scope.getRoomRateDetail = function (date, room_rate, ifLastValue) {
    return date === holder.period.last_date ? ifLastValue : room_rate;
  };

  $scope.payment.getTotal = function () {
    var discount   = parseInt(holder.guest.type === 'Group' ? holder.guest.company.company_discount : 0) + parseInt(holder.payment.discount);
    var room_price = 0;

    $.each(holder.payment.room_list, function (index, each) {
      room_price += each.date === holder.period.last_date ? 0 : parseInt(each.room_rate);
    });
    $scope.payment.total = room_price - ((room_price * discount) / 100);
  };

  $scope.payment.getTravelAgent = function () {
    var i = 0;
    $.each($scope.payment.travel_agents, function (index, each) {
      if (each.travelagent_id === $("select[name='travelagent_id'] option:selected").val()) i = index;
    });
    $scope.payment.travel_agent = $scope.payment.travel_agents[i];
  };

  $scope.isLastDay = function (date) {
    return date === holder.period.last_date;
  };

  $scope.guest = holder.guest;

  holder.payment = $scope.payment;
});

app.controller("overviewController", function ($scope, holder) {
  $scope.period      = holder.period;
  $scope.reservation = holder.reservation;
  $scope.guest       = holder.guest;
  $scope.payment     = holder.payment;

  $scope.isLastDay = function (date) {
    return date === holder.period.last_date;
  };
});

//jQuery
$(document).ready(function () {
  $("#date-from").datepicker({
     autoclose  : true,
     format     : "dd MM yyyy",
     orientation: "bottom left",
     startDate  : new Date(moment())
   })
   .on("changeDate", function () {
     initDateTo();
   });

  function initDateTo() {
    $("#date-to").val("");
    $("#date-to").datepicker("destroy");
    $("#date-to").datepicker({
      autoclose  : true,
      format     : "dd MM yyyy",
      orientation: "bottom eight",
      startDate  : new Date(moment($("#date-from").val(), "DD MMM YYYY").add(1, "day"))
    });
  }
});

function validateDiscount(source) {
  var val = $(source).val();

  if (!val) val = 0;
  if (val > 50) val = 50;

  $(source).val(parseInt(val));
}
