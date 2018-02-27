
<!-- --><div ng-controller="detailController">
          <div class="row">
            <div class="col-sm-12">
              <div class="pull-right m-t-15">
                <a href="{{baseurl}}page/manage/room/{{detail.category_id}}" class="btn btn-primary">Manage</a>
                <button ng-click="addRoom()" class="btn btn-primary">Add Room</button>
              </div>
              <h4 class="page-title">Room Detail</h4>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-5">
              <div class="card">

                <!--  -->
                <div class="card-block">
                  <h4 class="card-title" ng-bind="detail.category_name"/>
                </div>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item">

                    <table width="100%">
                      <!-- Room Rate -->
                      <tr>
                        <td align="left">Weekday (FIT / Group)</td>
                        <td align="right">
                          <label class="label label-success"><span ng-bind="detail.price_fitweekday | rupiah"></span></label>
                          /
                          <label class="label label-info"><span ng-bind="detail.price_groupweekday | rupiah"></span></label>
                        </td>
                      </tr>
                      <tr>
                        <td align="left">Weekend (FIT / Group)</td>
                        <td align="right">
                          <label class="label label-success"><span ng-bind="detail.price_fitweekend | rupiah"></span></label>
                          /
                          <label class="label label-info"><span ng-bind="detail.price_groupweekend | rupiah"></span></label>
                        </td>
                      </tr>

                      <!-- Extrabed -->
                      <tr>
                        <td align="left">Extrabed</td>
                        <td align="right">
                          <label class="label label-danger"   ng-if="detail.category_extrabed == 'No'"  ng-bind="detail.category_extrabed"></label>
                          <label class="label label-success"  ng-if="detail.category_extrabed == 'Yes'" ng-bind="detail.price_extrabed | rupiah"></label>
                        </td>
                      </tr>

                      <!-- Extrabed -->
                      <tr>
                        <td colspan="2"><hr/></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <p ng-bind="detail.category_note"></p>
                        </td>
                      </tr>
                    </table>

                  </li>
                </ul>
              </div>
            </div>

            <div class="col-sm-7">
              <div class="card">
                <div class="card-box">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Room Number</th>
                        <th>Floor</th>
                        <th>Wing</th>
                        <th>Bed Type</th>
                        <th>Adult</th>
                        <th>Children</th>
                        <th width="64"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="each in data">
                        <td><a href="" ng-bind="each.room_number" ng-click="detailRoom(each.room_id);" onclick="return false;"></a></td>
                        <td><span ng-bind="each.room_floor"/></td>
                        <td><span ng-bind="each.room_wing"/></td>
                        <td><span ng-bind="each.room_bedtype"/></td>
                        <td><span ng-bind="each.room_adult"/></td>
                        <td><span ng-bind="each.room_children"/></td>
                        <td align="center">
                          <button ng-click="manageRoom(each.room_id)" class="btn btn-sm btn-primary">Edit</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <?php $this->load->view("room/modal-add");?>
          <?php $this->load->view("room/modal-detail");?>
          <?php $this->load->view("room/modal-manage");?>

        </div>