
<!-----><div class="row">
          <div class="col-sm-12">
            <div class="pull-right m-t-15">
              <a href="{{baseurl}}page/manage/travel-agent" class="btn btn-primary">New Travel Agent</a>
            </div>
            <h4 class="page-title">Travel Agent</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-box">
                <table class="table table-bordered table-striped datatable">
                  <thead>
                    <tr>
                      <th>Travel Agent Name</th>
                      <th>Travel Agent Contact</th>
                      <th>Travel Agent Website</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="each in data">
                      <td><span ng-bind="each.travelagent_name"></span></td>
                      <td><span ng-bind="each.travelagent_contact | phone"></span></td>
                      <td><span ng-bind="each.travelagent_website"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
