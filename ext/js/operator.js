app.controller("operatorController", function ($scope) {
  $scope.isUpdating = hash() !== "operator";

  $scope.detail = [];

  if ($scope.isUpdating) {
    $scope.detail = json(baseurl + "api/detail/operator/" + hash());
  }

  $scope.formurl = baseurl + "api/" + ($scope.isUpdating ? "update" : "insert") + "/operator";
});
