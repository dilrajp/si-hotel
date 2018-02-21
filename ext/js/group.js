app.controller("detailController", function ($scope) {
  $scope.detail = json(baseurl + "api/detail/group/" + hash());
});

app.controller("groupController", function ($scope) {
  $scope.isUpdating = hash() !== "group";

  $scope.detail = [];

  if ($scope.isUpdating) {
    $scope.detail = json(baseurl + "api/detail/group/" + hash());
  }

  $scope.formurl = baseurl + "api/" + ($scope.isUpdating ? "update" : "insert") + "/group";
});
