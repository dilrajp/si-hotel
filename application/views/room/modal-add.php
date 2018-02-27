<!-- -->
<div id="modal-add" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style=" background: rgb(100, 176, 242); color:white;">
        Manage Room for this <strong>{{detail.category_name}}</strong>
      </div>
      <div class="modal-body">
        <form class="reloadform" action="{{formurl}}" method="post">
          <input type="hidden" name="category_id" value="{{detail.category_id}}"/>

          <table class="table table-bordered">
            <tr>
              <td width="160">Room Number</td>
              <td>
                <input type="text" name="room_number" class="form-control" placeholder="Room Number" required/>
              </td>
            </tr>
            <tr>
              <td>Floor</td>
              <td>
                <input type="text" name="room_floor" class="form-control" placeholder="Room Floor" required/>
              </td>
            </tr>
            <tr>
              <td>Wing</td>
              <td>
                <input type="text" name="room_wing" class="form-control" placeholder="Room Wing" required/>
              </td>
            </tr>
            <tr>
              <td>Bed Type</td>
              <td>
                <input type="text" name="room_bedtype" class="form-control" placeholder="Bed Type" required/>
              </td>
            </tr>
            <tr>
              <td># of Adult</td>
              <td>
                <input type="text" name="room_adult" class="form-control" placeholder="# of adult" required/>
              </td>
            </tr>
            <tr>
              <td># of Children</td>
              <td>
                <input type="text" name="room_children" class="form-control" placeholder="# of children" required/>
              </td>
            </tr>
            <tr>
              <td>Description</td>
              <td>
                <textarea name="room_description" class="form-control" placeholder="Description"></textarea>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <input type="submit" class="btn btn-sm btn-primary" value="Save"/>
                <input type="button" class="btn btn-sm btn-warning" value="Close" data-dismiss="modal"/>
              </td>
            </tr>
          </table>

        </form>
      </div>
    </div>
  </div>
</div>
