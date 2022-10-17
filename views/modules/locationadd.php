<?php require_once 'classes/Location.php'; ?>

<div class="clearfix"></div>
	
<div class="content-wrapper">
  <div class="container-fluid">
   <div class="row pt-2 pb-2">
     <div class="col-sm-12">
  	    <h1 class="page-title" style="font-size: 2em;text-align: center;color:cyan;">ADD COORDINATES</h1>
     </div>
   </div>

    <div class="row">
      <div class="col-lg-12">
        <form role="form" method="POST" autocomplete="nope">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-5 form-group">
                    <label for="txtLname" style="font-size: 1.5em;">Longitude</label>
                    <input type="text" style="font-size: 2em;" class="form-control" id="coordLong" name="coordLong" value="" autocomplete="nope" required>
                </div>

                <div class="col-sm-5 form-group">
                    <label for="txtFname" style="font-size: 1.5em;">Latitude</label>
                    <input type="text" class="form-control" style="font-size: 2em;color:red;" name="coordLat" id="coordLat" required>
                </div>
              </div>                                               
            </div>

            <div class="card-footer">
              <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-9">
                  <div class="float-sm-right">
                     <button type="submit" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="saverecord"><i class="fa fa-floppy"></i>&nbsp;&nbsp;Save</button>   
                     <button type="button" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="clear" onclick="clearForm()"><i class="fa fa-list"></i>&nbsp;&nbsp;Clear</button> 

                     <button type="button" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="search" data-toggle="modal" data-target="#student_search"><i class="fa fa-search"></i>&nbsp;&nbsp;Find</button> 
                  </div>
                </div>
              </div>
            </div>  <!-- footer -->

          </div>    <!-- card -->
        </form>
        <?php
          $addCoords = new Location();
          $addCoords -> addCoordinates();
        ?>
      </div>
    </div><!--End Row-->

  <div class="overlay toggle-menu"></div>
  </div>    <!-- container-fluid -->
</div>      <!-- content-wrapper -->

<div class="col-lg-4">
    <div class="modal fade" id="student_search">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">

            <input type="text" style="font-size: 1.5em;" class="form-control" id="search_text" name="search_text" placeholder="Enter Coordinates" autocomplete="nope" onkeyup="filterSearch()">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive table-bordered" style="overflow-y: auto; max-height: 300px;min-height: 300px;">
                <table class="table mx-auto w-auto search-table" tabindex='0' id="coordListing">
                  <thead>
                    <tr>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:275px;">Longitude</th>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:275px;">Latitude</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $coords = (new Location)->showCoordList();
                        foreach ($coords as $key => $value){
                          echo '<tr idStudent='.$value["id"].'>
                                  <td>'.$value["coordLong"].'</td>
                                  <td>'.$value["coordLat"].'</td>
                                </tr>';
                        }
                    ?>
                  </tbody>
                </table>
            </div>
          </div>

          <div class="modal-footer">
          </div>

        </div>
      </div>
    </div>
</div>