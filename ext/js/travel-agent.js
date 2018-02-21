app.controller("travelagentController", function ($scope) {
  $scope.isUpdating = hash() !== "travel-agent";

  $scope.detail = [];

  if ($scope.isUpdating) {
    $scope.detail = json(baseurl + "api/detail/travel-agent/" + hash());
  }

  $scope.formurl = baseurl + "api/" + ($scope.isUpdating ? "update" : "insert") + "/travel-agent";
});
