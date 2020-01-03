<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Loan@SUT</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
    @font-face {
      font-family: ff;
      /*a name to be used later*/
      src: url(font/Kanit-Light.ttf);
      /*URL to font*/
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
      font-family: "ff"
    }

    body {
      font-size: 16px;
    }

    .w3-half img {
      margin-bottom: -6px;
      margin-top: 16px;
      opacity: 0.8;
      cursor: pointer
    }

    .w3-half img:hover {
      opacity: 1
    }
  </style>
</head>

<body style="background-color:#fff2a9;">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;background-color:#ffb347;" id="mySidebar">
    <br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
    <div class="w3-container">
      <center>
        <img src="./img/slfLogo.png" height="100" width="100" style="border-radius: 10px;margin-top:20px;margin-bottom:-40px;">
        <h5 class="w3-padding-64"><b>ระบบกองทุนกู้ยืมเพื่อการศึกษา<br>(Student Loan@SUT)</b></h4>
      </center>

    </div>
    <div class="w3-bar-block" style="margin-top:-40px;margin-left:-15px;">

      <a href="searchdocument.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clipboard-check'></i>
        <font size="3">&nbsp;ตรวจสอบเอกสารการขอกู้ยืม</font>
      </a>
      <a href="showbooking.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วัน-เวลาจองคิวยื่นเอกสารคำขอกู้</font>
      </a>
      <a href="showuploaddate.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white" style="background-color:#ffffff;">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วันเปิด-ปิดระบบอัพโหลดเอกสาร</font>
      </a>
      <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-sign-out-alt'></i>
        <font size="3">&nbsp;ออกจากระบบ</font>
      </a>

    </div>
  </nav>

  <!-- Top menu on small screens -->
  <header class="w3-container w3-top w3-hide-large w3-xlarge w3-padding" style="background-color:#ffb347;">
    <a href="javascript:void(0)" class="w3-button w3-margin-right" style="background-color:#ffb347;" onclick="w3_open()">☰</a>
    <!-- <span>Company Name</span> -->
  </header>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:340px;margin-right:40px">

    <?php
    if (!$conn) {
      echo $conn->connect_error;
      exit();
    }
    $strSQL = "SELECT * FROM `tb_define_upload_date`";
    $objQuery = mysqli_query($conn, $strSQL);
    ?>
    <!-- Body -->
    <div class="w3-container" style="margin-top:80px;" id="showcase">
      <h3><b>วันเปิด-ปิดระบบอัพโหลดเอกสารคำขอกู้</b></h3>
      <div class="form-group row">
        <div class="col-md-11">
          <button type="button" class="btn btn-success" style="margin-left:100%;" data-toggle="modal" data-target="#myModal">เพิ่มข้อมูล</button>
        </div>
      </div>
      <table id="example" class="table table-striped " style="width:100%;background-color:#fff;">
        <thead>
          <tr>
            <th>
              <div align="center">ภาคการศึกษา</div>
            </th>
            <th>
              <div align="center">วันเปิดระบบ</div>
            </th>
            <th>
              <div align="center">วันปิดระบบ</div>
            </th>
            <th>
              <div align="center">สถานะ</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
          ?>
            <tr>
              <td>
                <div align="center"><?php echo $result["semester_name"]; ?></div>
              </td>
              <td>
                <div align="center"><?php echo date_format(date_create($result["define_upload_date_start"]), "d/M/Y"); ?></div>
              </td>
              <td>
                <div align="center"><?php echo date_format(date_create($result["define_upload_date_end"]), "d/M/Y"); ?></div>
              </td>
              <td>
                <div align="center"><?php echo $result["define_upload_date_status"]; ?></div>
              </td>
              <td>
                <div align="center"><?php echo "<button type=\"button\" class=\"btn btn-primary \" style=\"margin-top:-5px;\" onclick=\"edit(" . $result["define_upload_date_id"] . ")\">แก้ไข</button>" ?>

                </div>
              </td>
              <td>
                <div align="center"><?php echo "<button type=\"submit\" class=\"btn btn-danger\" style=\"margin-top:-5px;\" onclick=\"del(" . $result["define_upload_date_id"] . ")\">ลบข้อมูล</button>" ?></div>
              </td>
            </tr>

          <?php
          }
          ?>
        </tbody>
        <!-- <tfoot>
          <tr>
            <th>
              <div align="center">ภาคการศึกษา</div>
            </th>
            <th>
              <div align="center">วันเปิดระบบ</div>
            </th>
            <th>
              <div align="center">วันปิดระบบ</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
          </tr>
        </tfoot> -->
      </table>
      <?php
      mysqli_close($conn);
      ?>
    </div>
  </div>
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title"><b>เพิ่มวันเปิด-ปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" id="user_form">
            <div class="card-body">
              <label for="name">
                <font style="font-family: ff;"><b>ภาคการศึกษาที่</b></font>
              </label>
              <div class="form-group row">
                <div class="col-md-9">
                  <input id="semester-name" name="semester-name" width="250" class="form-control" required />
                </div>
              </div>
              <label for="open" style="margin-top:-15px;">
                <font style="font-family: ff;"><b>วันเปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></font>
              </label>
              <input id="open-upload-date" name="open-upload-date" width="315" onchange="SetDateOpenFormat()" required />
              <script>
                $('#open-upload-date').datepicker({
                  uiLibrary: 'bootstrap4'
                });
              </script>
              <label for="close" style="margin-top:15px;">
                <font style="font-family: ff;"><b>วันปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></font>
              </label>
              <input id="close-upload-date" width="315" onchange="SetDateCloseFormat()" required />
              <script>
                $('#close-upload-date').datepicker({
                  uiLibrary: 'bootstrap4'
                });
              </script>
              <label for="name" style="margin-top:15px;">
                <font style="font-family: ff;"><b>สถานะ</b></font>
              </label>
              <div class="form-group row">
                <div class="col-md-9">
                  <input id="define_upload_date_status" name="define_upload_date_status" width="250" class="form-control" required />
                </div>
              </div>
            </div>
        </div>
        <div align="center">
          <input type="submit" name="insert" id="insert" class="btn btn-success" value="บันทึก" style="margin-left:10px;margin-top:20px;width:90px;" />
        </div>
        <br>
        <input id="format-open-upload-date" name="format-open-upload-date" style="display:none;"></input>
        <input id="format-close-upload-date" name="format-close-upload-date" style="display:none;"></input>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title"><b>แก้ไขวันเปิด-ปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" id="user_form2">
            <div class="card-body">
              <label for="name">
                <font style="font-family: ff;"><b>ภาคการศึกษาที่</b></font>
              </label>
              <div class="form-group row">
                <div class="col-md-9">
                  <input id="edit-id" name="edit-id" width="250" class="form-control" style="display:none;" required />
                  <input id="edit-semester-name" name="edit-semester-name" width="250" class="form-control" required />
                </div>
              </div>
              <label for="open" style="margin-top:-15px;">
                <font style="font-family: ff;"><b>วันเปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></font>
              </label>
              <input id="edit-open-upload-date" name="edit-open-upload-date" width="315" onchange="SetDateEditOpenFormat()" required />
              <script>
                $('#edit-open-upload-date').datepicker({
                  uiLibrary: 'bootstrap4'
                });
              </script>
              <label for="close" style="margin-top:15px;">
                <font style="font-family: ff;"><b>วันปิดระบบอัพโหลดเอกสารการขอกู้ยืม</b></font>
              </label>
              <input id="edit-close-upload-date" width="315" onchange="SetDateEditOpenFormat()" required />
              <script>
                $('#edit-close-upload-date').datepicker({
                  uiLibrary: 'bootstrap4'
                });
              </script>
              <label for="name" style="margin-top:15px;">
                <font style="font-family: ff;"><b>สถานะ</b></font>
              </label>
              <div class="form-group row">
                <div class="col-md-9">
                  <input id="edit-define_upload_date_status" name="edit-define_upload_date_status" width="250" class="form-control" required />
                </div>
              </div>
            </div>
            
        </div>
        <div align="center">
          <input type="submit" name="insert_edit" id="insert_edit" class="btn btn-success" value="บันทึก" style="margin-left:10px;margin-top:20px;width:90px;" />
        </div>
        <br>
        <input id="edit-format-open-upload-date" name="edit-format-open-upload-date" style="display:none;"></input>
        <input id="edit-format-close-upload-date" name="edit-format-close-upload-date" style="display:none;"></input>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal footer -->
  <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" >Close</button>
            </div> -->

  </div>
  </div>
  </div>
  </div>

  </div>
  <script>
    // Script to open and close sidebar
    $(document).ready(function() {
      $('#example').DataTable();
    });

    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }

    function add() {
      location.href = "defineuploaddate.php";
    }

    function del(define_upload_id) {
      swal({
          title: "ต้องการลบข้อมูลนี้ใช่หรือไม่ ?",
          text: "หากทำการลบข้อมูลแล้ว จะไม่สามารถเรียกคืนข้อมูลได้อีกครั้ง",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "deleteuploaddate.php?define_upload_id=" + define_upload_id,
              method: "GET",
              success: function() {
                location.reload();
              },
              error: function() {
                swal({
                  title: "ลบข้อมูลไม่สำเร็จ!",
                  text: "เกิดข้อผิดพลาดขณะทำการลบข้อมูล",
                  icon: "error"
                });
              }
            })
          }
        });

    }

    function edit(define_upload_id) {
      $.ajax({
        url: "fetchuploaddate.php?define_upload_id=" + define_upload_id,
        method: "GET",
        data: {
          define_upload_id: define_upload_id
        },
        dataType: "json",
        success: function(data) {
          var opendate = data.define_upload_date_start.split('-')
          var closedate = data.define_upload_date_end.split('-')
          $('#edit-id').val(data.define_upload_date_id);
          $('#edit-semester-name').val(data.semester_name);
          $('#edit-define_upload_date_status').val(data.define_upload_date_status);
          $('#edit-open-upload-date').val(opendate[1] + '/' + opendate[2] + '/' + opendate[0]);
          $('#edit-close-upload-date').val(closedate[1] + '/' + closedate[2] + '/' + closedate[0]);
          $('#edit-format-open-upload-date').val(data.define_upload_date_start);
          $('#edit-format-close-upload-date').val(data.define_upload_date_end);
          $('#editModal').modal('show');
        },
        error: function() {
          swal({
            title: "ไม่สำเร็จ!",
            text: "เกิดข้อผิดพลาดขณะทำการลบข้อมูล",
            icon: "error"
          });
        }
      })
    }

    function SetDateOpenFormat() {
      var open_date = $('#open-upload-date').val().split('/');
      $("#format-open-upload-date").val(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
      $("#format-open-upload-date").html(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
    }

    function SetDateCloseFormat() {
      var close_date = $('#close-upload-date').val().split('/');
      $("#format-close-upload-date").val(close_date[2] + "-" + close_date[0] + "-" + close_date[1]);
      $("#format-close-upload-date").html(close_date[2] + "-" + close_date[0] + "-" + close_date[1]);
    }

    function SetDateEditOpenFormat() {
      var open_date = $('#edit-open-upload-date').val().split('/');
      $("#edit-format-open-upload-date").val(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
      $("#edit-format-open-upload-date").html(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
    }

    function SetDateEditCloseFormat() {
      var close_date = $('#edit-close-upload-date').val().split('/');
      $("#edit-format-close-upload-date").val(close_date[2] + "-" + close_date[0] + "-" + close_date[1]);
      $("#edit-format-close-upload-date").html(close_date[2] + "-" + close_date[0] + "-" + close_date[1]);
    }

    $(document).ready(function() {
      $('#user_form').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        swal({
            title: "ต้องการบันทึกข้อมูลนี้ใช่หรือไม่ ?",
            text: "กรุณากดปุ่ม OK เพื่อทำการบันทึกข้อมูล",
            icon: "info",
            buttons: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "insertuploaddate.php",
                method: "POST",
                data: form_data,
                success: function() {
                  location.reload()
                },
                error: function() {
                  swal({
                    title: "บันทึกไม่สำเร็จ!",
                    text: "ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลอีกครั้ง",
                    icon: "error"
                  });
                }
              })
            }
          });
      });
    });

    $(document).ready(function() {
      $('#user_form2').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        swal({
            title: "ต้องการบันทึกข้อมูลนี้ใช่หรือไม่ ?",
            text: "กรุณากดปุ่ม OK เพื่อทำการบันทึกข้อมูล",
            icon: "info",
            buttons: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "edituploaddate.php",
                method: "POST",
                data: form_data,
                success: function() {
                  location.reload()
                },
                error: function() {
                  swal({
                    title: "บันทึกไม่สำเร็จ!",
                    text: "ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลอีกครั้ง",
                    icon: "error"
                  });
                }
              })
            }
          });
      });
    });
  </script>

</body>

</html>