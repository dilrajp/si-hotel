var app = angular.module("angular", []);

app.controller("dataController", function ($scope) {
  $scope.baseurl = baseurl;
  $scope.section = section;

  if (section !== "dashboard" && section !== "reservation") $scope.data = section === "" ? [] : json(baseurl + "api/get/" + section);

  $scope.labelClass = function (source) {
    if (source === "Student" || source === "VC" || source === "Waiting" || source === "Yes") {
      return "success";
    } else if (source === "EA" || source === "OD" || source === "Ongoing" || source === "Operator") {
      return "primary";
    } else if (source === "Admin" || source === "Cancelled" || source === "ED" || source === "VD") {
      return "danger";
    }

    return "warning";
  };
});

app.filter("number", function () {
  return function (source) {
    if (source) {
      var value = "";

      var count = 0;
      for (var i = source.toString().length; i >= 0; i--) {
        value = source.toString().charAt(i) + value;

        if (count % 3 === 0) {
          value = "." + value;
        }

        count++;
      }

      return value.substring((value.charAt(0) === "." ? 1 : 0), value.length - 1);
    }

    return "";
  }
});

app.filter("phone", function () {
  return function (source) {
    return source ? source.substring(0, 4) + "-" + source.substring(4, 8) + "-" + source.substring(8) : "";
  }
});

app.filter("rupiah", function () {
  return function (source) {
    if (source) {
      var value = "";

      var count = 0;
      for (var i = source.toString().length; i >= 0; i--) {
        value = source.toString().charAt(i) + value;

        if (count % 3 === 0) {
          value = "," + value;
        }

        count++;
      }

      return value.substring((value.charAt(0) === "," ? 1 : 0), value.length - 1).replace("-,", "-");
      //return "Rp " + value.substring((value.charAt(0) === "," ? 1 : 0), value.length - 1) + ".00";
    }

    return "";
  }
});
