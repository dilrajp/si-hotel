
<!----><div id="modal-detail" class="modal fade" role="dialog" style="display: none;">
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
                        <td><span ng-bind="room.nama_kamar"></span></td>
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
                        <td align="center"><p class="center"> <img src="<?php echo base_url("uploads/")?>{{room.room_pict}}" width=50% height=50% style="text-align: center" id="image_from_url"></p></td>
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
          <div id="myModal" class="modal" style="margin-top: 15%">            
            <img class="modal-content" id="img01">
            <div id="caption"></div>
          </div>

          <style>
            #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }
            #image_from_url:hover {cursor: zoom-in;}
            #img01:hover {cursor: zoom-out;}
            /* Modal Content (image) */
            .modal-content {
                margin: auto;
                display: block;                
                max-width: 700px;
            }
            /* Caption of Modal Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }
            /* Add Animation */
            .modal-content, #caption{
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }
            @-webkit-keyframes zoom {
                from {-webkit-transform:scale(0)} 
                to {-webkit-transform:scale(1)}
            }
            @keyframes zoom {
                from {transform:scale(0)} 
                to {transform:scale(1)}
            }
            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                    height: 100%;
                }
            }
          </style>
          <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('image_from_url');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on <span> (x), close the modal
            img01.onclick = function() { 
                modal.style.display = "none";
            }
          </script>