<?php
  require_once 'classes/Student.php';
  $item = "id";
  $value = $_GET['idStudent'];
  $updateStudent = new Student();
  $student = $updateStudent->getStudentInfo($item,$value);
?>

<div class="clearfix"></div>
	
<div class="content-wrapper">
  <div class="container-fluid">
   <div class="row pt-2 pb-2">
     <div class="col-sm-12">
  	    <h1 class="page-title" style="font-size: 2em;text-align: center;color:cyan;">EDIT STUDENT</h1>
     </div>
   </div>

    <div class="row">
      <div class="col-lg-12">
        <form role="form" method="POST" autocomplete="nope">
          <div class="card">
            <div class="card-body">
              <div class="row">

                <input type="hidden" id="numId" name="numId" value="<?php echo $student['id'];?>">

                <input type="hidden" name="student_id" id="student_id" required>

                <div class="col-sm-5 form-group">
                    <label for="txtLname" style="font-size: 1.5em;">Lastname</label>
                    <input type="text" style="font-size: 2em;" class="form-control" id="txtLname" name="txtLname" value="<?php echo $student['lname'];?>" autocomplete="nope" required>
                </div>

                <div class="col-sm-5 form-group">
                    <label for="txtFname" style="font-size: 1.5em;">Firstname</label>
                    <input type="text" class="form-control" style="font-size: 2em;color:red;" name="txtFname" id="txtFname" value="<?php echo $student['fname'];?>" required>
                </div>

                <div class="col-sm-2 form-group">
                    <label for="txtMi" style="font-size: 1.5em;">MI</label>
                    <input type="text" class="form-control" style="font-size: 2em;color:red;" name="txtMi" id="txtMi" value="<?php echo $student['mi'];?>" required>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="txtAddress" style="font-size: 1.5em;">Address</label>
                    <input type="text" style="font-size: 2em;" class="form-control" id="txtAddress" name="txtAddress" value="<?php echo $student['address'];?>" autocomplete="nope">
                </div>

                <div class="col-sm-3 form-group">
                    <label for="txtProgcode" style="font-size: 1.5em;">Acad Program</label>
                    <input type="text" class="form-control" style="font-size: 2em;color:red;" name="txtProgcode" id="txtProgcode" value="<?php echo $student['progcode'];?>" required>
                </div>
              </div>                                               
            </div>

            <div class="card-footer">
              <div class="row">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-9">
                  <div class="float-sm-right">
                     <button type="submit" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="saverecord" onclick="document.getElementById('student_id').value=document.getElementById('numId').value"><i class="fa fa-floppy"></i>&nbsp;&nbsp;Save</button>

                     <button type="button" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="clear" onclick="clearForm()"><i class="fa fa-list"></i>&nbsp;&nbsp;Clear</button> 
 
                     <button type="button" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="search" data-toggle="modal" data-target="#student_search"><i class="fa fa-search"></i>&nbsp;&nbsp;Find</button> 

                     <button type="submit" style="font-size: 1.2em;" class="btn btn-light btn-round px-5" name="Delete"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete</button>
                  </div>
                </div>
              </div>
            </div>  <!-- footer -->

          </div>    <!-- card -->
        </form>
          <?php
            $processUpdate = $updateStudent->editStudent();
            if ($processUpdate == "ok"){
              echo '<script>window.location="studentadd";</script>';
            }

            $processDelete = $updateStudent->deleteStudent();
            if ($processDelete == "ok"){
              echo '<script>window.location="studentadd";</script>';
            }
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

            <input type="text" style="font-size: 1.5em;" class="form-control" id="search_text" name="search_text" placeholder="Enter Student Detail" autocomplete="nope" onkeyup="filterSearch()">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive table-bordered" style="overflow-y: auto; max-height: 300px;min-height: 300px;">
                <table class="table mx-auto w-auto search-table" tabindex='0' id="studentListing">
                  <thead>
                    <tr>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:275px;">Surname</th>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:275px;">First Name</th>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:30px;">MI</th>
                      <th class="table_head_left_fixed" style="border: 1px solid white;background-color: #323333;width:150px;">Program</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $students = (new Student)->showStudentList();
                        foreach ($students as $key => $value){
                          echo '<tr idStudent='.$value["id"].'>
                                  <td>'.$value["lname"].'</td>
                                  <td>'.$value["fname"].'</td>
                                  <td>'.$value["mi"].'</td>
                                  <td>'.$value["progcode"].'</td>
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
