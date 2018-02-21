
<!-----><div class="row">
          <div class="col-sm-12">
            <div class="pull-right m-t-15">
              <a href="{{baseurl}}page/manage/group" class="btn btn-primary">New Group</a>
            </div>
            <h4 class="page-title">Group</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>Group Code</th>
                      <th>Group Name</th>
                      <th>Group Contact</th>
                      <th>Group Address</th>
                      <th>PIC</th>
                      <th>PIC Contact</th>
                      <th>Discount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <td>
                        <a ng-href="{{baseurl + 'page/detail/group/' + each.company_id}}"><strong ng-bind="each.company_code"></strong></a>
                      </td>

                      <td><span ng-bind="each.company_name"></span></td>
                      <td><span ng-bind="each.company_contact | phone"></span></td>
                      <td><span ng-bind="each.company_address"></span></td>
                      <td><span ng-bind="each.company_pic"></span></td>
                      <td><span ng-bind="each.company_piccontact | phone"></span></td>
                      <td align="right"><span ng-bind="each.company_discount + '%'"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
