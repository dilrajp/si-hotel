
<!-------><div id="modal-detail" class="modal fade" role="dialog" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" style=" background: rgb(100, 176, 242); color:white;">
                  Room Detail
                </div>
                <div class="modal-body">
                  <form class="reloadform" method="post">

                    <table class="table table-bordered">
                      <tr>
                        <td width="160">Room Number</td>
                        <td><span ng-bind="room.room_number"></span></td>
                      </tr>
                      <tr>
                        <td>Floor</td>
                        <td><span ng-bind="room.room_floor"></span></td>
                      </tr>
                      <tr>
                        <td>Wing</td>
                        <td><span ng-bind="room.room_wing"></span></td>
                      </tr>
                      <tr>
                        <td>Bed Type</td>
                        <td><span ng-bind="room.room_bedtype"></span></td>
                      </tr>
                      <tr>
                        <td># of Adult</td>
                        <td><span ng-bind="room.room_adult"></span></td>
                      </tr>
                      <tr>
                        <td># of Children</td>
                        <td><span ng-bind="room.room_children"></span></td>
                      </tr>
                      <tr>
                        <td>Description</td>
                        <td><p ng-bind="room.room_description"></p></td>
                      </tr>
                       <tr>
                        <td>Gambar</td>
                        <td align="center"><p class="center"> <img src="<?php echo base_url("ext/img/")?>{{room.room_pict}}" width=30% height=30% style="text-align: center"></p></td>

                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <input type="button" class="btn btn-sm btn-warning" value="Close" data-dismiss="modal"/>
                        </td>
                      </tr>
                    </table>

                  </form>
                </div>
              </div>
            </div>
          </div>
