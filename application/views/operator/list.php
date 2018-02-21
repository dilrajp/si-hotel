
<!-----><div class="row">
          <div class="col-sm-12">
            <div class="pull-right m-t-15">
              <a href="{{baseurl}}page/manage/operator" class="btn btn-primary">New Operator</a>
            </div>
            <h4 class="page-title">Operator</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Role</th>
                      <th>Last Active</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <td>
                        <a href="{{baseurl+'page/manage/operator/'+each.operator_username}}" ng-bind="each.operator_username"></a>
                      </td>
                      <td><span ng-bind="each.operator_name"></span></td>
                      <td><span ng-bind="each.operator_contact | phone"></span></td>
                      <td align="center"><label class="label label-{{labelClass(each.operator_role)}}" ng-bind="each.operator_role"></label></td>
                      <td><span ng-bind="each.operator_lastactive"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
