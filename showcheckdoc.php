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

      <a href="searchdocument.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white" style="background-color:#ffffff;">
        <i class='fas fa-clipboard-check'></i>
        <font size="3">&nbsp;ตรวจสอบเอกสารการขอกู้ยืม</font>
      </a>
      <a href="showbooking.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วัน-เวลาจองคิวยื่นเอกสารคำขอกู้</font>
      </a>
      <a href="showuploaddate.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วันเปิด-ปิดระบบอัพโหลดเอกสาร</font>
      </a>
      <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-sign-out-alt'></i>
        <font size="3">&nbsp;ออกจากระบบ</font>
      </a>
      <!-- <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Services</a> 
    <a href="#designers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Designers</a> 
    <a href="#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Packages</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a> -->
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
    $ID = $_POST['number_id'];
    $student_id = $_POST['student_id'];
    $name = $_POST['student_name'];
    $year = $_POST['year'];
    $school_of = $_POST['lmName1'];
    $type_scholarship = $_POST['lmName2'];
    $type_of_document = $_POST['lmName3'];

    if ($type_of_document == '') {
      $strSQL = "SELECT tb1.ID,tbname.student_id,tbname.student_prefix ,tbname.student_name ,
    tbname.year,tbname.student_school_of,
    tb1.`type_of_document_id` as type1 ,tb1.`upload_document_status` as doc1 
    ,tb2.`type_of_document_id`as type2 ,tb2.`upload_document_status` as doc2,
    tb3.type_of_document_id as type3 , tb3.upload_document_status as doc3,
    tb4.type_of_document_id as type4 , tb4.upload_document_status as doc4,
    tb5.type_of_document_id as type5 , tb5.upload_document_status as doc5,
    tb6.type_of_document_id as type6 , tb6.upload_document_status as doc6,
    tb7.type_of_document_id as type7 , tb7.upload_document_status as doc7,
    tb8.type_of_document_id as type8 , tb8.upload_document_status as doc8,
    tb9.type_of_document_id as type9 , tb9.upload_document_status as doc9,
    tb10.type_of_document_id as type10 , tb10.upload_document_status as doc10,
    tb11.type_of_document_id as type11 , tb11.upload_document_status as doc11,
    tb12.type_of_document_id as type12 , tb12.upload_document_status as doc12,
    tb13.type_of_document_id as type13 , tb13.upload_document_status as doc13,
    tbsc.school_of_name
    
    FROM `tb_upload_document` as tb1 
    LEFT JOIN tb_upload_document as tb2 ON tb1.ID = tb2.ID AND tb1.semester_name = tb2.semester_name
    LEFT JOIN tb_upload_document as tb3 ON tb2.ID = tb3.ID AND tb2.semester_name = tb3.semester_name
    LEFT JOIN tb_upload_document as tb4 ON tb3.ID = tb4.ID AND tb3.semester_name = tb4.semester_name
    LEFT JOIN tb_upload_document as tb5 ON tb4.ID = tb5.ID AND tb4.semester_name = tb5.semester_name
    LEFT JOIN tb_upload_document as tb6 ON tb5.ID = tb6.ID AND tb5.semester_name = tb6.semester_name
    LEFT JOIN tb_upload_document as tb7 ON tb6.ID = tb7.ID AND tb6.semester_name = tb7.semester_name
    LEFT JOIN tb_upload_document as tb8 ON tb7.ID = tb8.ID AND tb7.semester_name = tb8.semester_name
    LEFT JOIN tb_upload_document as tb9 ON tb8.ID = tb9.ID AND tb8.semester_name = tb9.semester_name
    LEFT JOIN tb_upload_document as tb10 ON tb9.ID = tb10.ID AND tb9.semester_name = tb10.semester_name
    LEFT JOIN tb_upload_document as tb11 ON tb10.ID = tb11.ID AND tb10.semester_name = tb11.semester_name
    LEFT JOIN tb_upload_document as tb12 ON tb11.ID = tb12.ID AND tb11.semester_name = tb12.semester_name
    LEFT JOIN tb_upload_document as tb13 ON tb12.ID = tb13.ID AND tb12.semester_name = tb13.semester_name
    LEFT JOIN tb_student as tbname ON tb13.ID = tbname.ID 
    LEFT JOIN tb_school_of as tbsc ON tbname.student_school_of = tbsc.school_of_id
    
    WHERE tb1.`type_of_document_id` ='1' AND tb2.type_of_document_id = '2' 
    AND tb3.type_of_document_id = '3' AND tb4.type_of_document_id = '4' AND 
    tb5.type_of_document_id = '5' AND tb6.type_of_document_id = '6'
    AND tb7.type_of_document_id = '7' AND tb8.type_of_document_id = '8'
    AND tb9.type_of_document_id = '9' AND tb10.type_of_document_id = '10'
    AND tb11.type_of_document_id = '11' AND tb12.type_of_document_id = '12'
    AND tb13.type_of_document_id = '13'";
     $search = array();
     if ($ID != '') {
       $search[] = "tb1.`ID` ='" . $ID . "'";
     }
     if ($student_id != '') {
       $search[] = "tbname.student_id ='" . $student_id . "'";
     }
     if ($year != '') {
       $search[] = "tbname.year ='" . $year . "'";
     }
     if ($school_of != '') {
       $search[] = "tbname.student_school_of ='" . $school_of . "'";
     }
     if ($type_scholarship != '') {
       $search[] = "tbname.type_scholarship = '" . $type_scholarship . "'";
     }
     $strSQL .= " AND " . implode(" AND ", $search);

     echo $strSQL;
    } else {
      $strSQL = "SELECT tb1.ID,tbname.student_id,tbname.student_prefix ,tbname.student_name ,
    tbname.year,tbname.student_school_of,tbname.type_scholarship,tbsc.school_of_name,
    tb1.`type_of_document_id` as type1 ,tb1.`upload_document_status` as doc1 
    FROM `tb_upload_document` as tb1 
    LEFT JOIN tb_student as tbname ON tb1.ID = tbname.ID
    LEFT JOIN tb_school_of as tbsc ON tbname.student_school_of = tbsc.school_of_id";
      $search = array();
      if ($ID != '') {
        $search[] = "tb1.`ID` ='" . $ID . "'";
      }
      if ($student_id != '') {
        $search[] = "tbname.student_id ='" . $student_id . "'";
      }
      if ($year != '') {
        $search[] = "tbname.year ='" . $year . "'";
      }
      if ($school_of != '') {
        $search[] = "tbname.student_school_of ='" . $school_of . "'";
      }
      if ($type_scholarship != '') {
        $search[] = "tbname.type_scholarship = '" . $type_scholarship . "'";
      }
      if ($type_of_document != '') {
        $search[] = "tb1.`type_of_document_id` = '" . $type_of_document . "'";
      }

      $strSQL .= " WHERE " . implode(" AND ", $search);

      echo $strSQL;
    }
    $objQuery = mysqli_query($conn, $strSQL);
    ?>
    <!-- Header -->
    <div class="w3-container" style="margin-top:80px;" id="showcase">
      <h3><b>ตรวจสอบเอกสารคำขอกู้ยืม</b></h3>
      <div class="table-responsive">

        <?php if ($type_of_document == '') {
        ?>
          <table class="table table-striped" style="width:400%;background-color:#fff;">
            <thead>
              <tr>
                <th>
                  <div align="center">เลือกรายการ</div>
                </th>
                <th>
                  <div align="center">เลขบัตรประชาชน</div>
                </th>
                <th>
                  <div align="center">รหัสนักศึกษา</div>
                </th>
                <th>
                  <div align="center">ชื่อ-นามสกุล</div>
                </th>
                <th>
                  <div align="center">ชั้นปีที่</div>
                </th>
                <th>
                  <div align="center">สาขาวิชา</div>
                </th>
                <th>
                  <div align="center">แบบคำขอกู้ยืมเงิน</div>
                </th>
                <th>
                  <div align="center">หนังสือยอมรับ</div>
                </th>
                <th>
                  <div align="center">หนังสือความคิดเห็นจากอาจารย์</div>
                </th>
                <th>
                  <div align="center">แบบคำขอกู้ 101</div>
                </th>
                <th>
                  <div align="center">หนังสือรับรองรายได้ + เอกสารประกอบ</div>
                </th>
                <th>
                  <div align="center">หนังสือรับรองสภาพครอบครัว + บัตรผู้รับรอง</div>
                </th>
                <th>
                  <div align="center">แผนผังที่อยู่อาศัย + รูปภาพที่อยู่อาศัย</div>
                </th>
                <th>
                  <div align="center">บัตรประชาชน + ทะเบียนบ้านผู้กู้</div>
                </th>
                <th>
                  <div align="center">บัตรประชาชน + ทะเบียนบ้านบิดา</div>
                </th>
                <th>
                  <div align="center">บัตรประชาชน + ทะเบียนบ้านมารดา</div>
                </th>
                <th>
                  <div align="center">บัตรประชาชน + ทะเบียนบ้านผู้ปกครอง</div>
                </th>
                <th>
                  <div align="center">สำเนาผลการศึกษา</div>
                </th>
                <th>
                  <div align="center">กิจกรรมจิตอาสา</div>
                </th>
              </tr>
            <?php
          } else {

            if (!$conn) {
              echo $conn->connect_error;
              exit();
            }
            $strSQLtype = "SELECT*FROM tb_type_of_document WHERE type_of_document_id = '" . $type_of_document . "'";
            $objQuerytype = mysqli_query($conn, $strSQLtype);
            $resulttype = mysqli_fetch_array($objQuerytype, MYSQLI_ASSOC)
            ?>
              <table class="table table-striped" style="width:170%;background-color:#fff;">
                <thead>
                  <tr>
                    <th>
                      <div align="center">เลือกรายการ</div>
                    </th>
                    <th>
                      <div align="center">เลขบัตรประชาชน</div>
                    </th>
                    <th>
                      <div align="center">รหัสนักศึกษา</div>
                    </th>
                    <th>
                      <div align="center">ชื่อ-นามสกุล</div>
                    </th>
                    <th>
                      <div align="center">ชั้นปีที่</div>
                    </th>
                    <th>
                      <div align="center">สาขาวิชา</div>
                    </th>
                    <th>
                      <div align="center"><?php echo $resulttype['type_of_document_name']; ?></div>
                    </th>
                  </tr>
                <?php } ?>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
                  ?>
                    <tr>
                      <td>
                        <div align="center" style="margin-top:-15px;">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" <?php echo "value=\" .$i.\""; ?> />
                            </label>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div align="center"><?php echo $result['ID']; ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $result['student_id']; ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $result['student_prefix'] . $result['student_name']; ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $result['year']; ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $result['school_of_name']; ?></div>
                      </td>
                      <?php if ($result['doc1'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type1'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc1"] . "</div></td>";
                      ?>
                      <?php if ($result['doc2'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type2'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc2"] . "</div></td>";
                      ?>
                      <?php if ($result['doc3'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type3'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc3"] . "</div></td>";
                      ?>
                      <?php if ($result['doc4'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type4'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc4"] . "</div></td>";
                      ?>
                      <?php if ($result['doc5'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type5'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc5"] . "</div></td>";
                      ?>
                      <?php if ($result['doc6'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type6'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc6"] . "</div></td>";
                      ?>
                      <?php if ($result['doc7'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type7'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc7"] . "</div></td>";
                      ?>
                      <?php if ($result['doc8'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type8'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc8"] . "</div></td>";
                      ?>
                      <?php if ($result['doc9'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type9'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc9"] . "</div></td>";
                      ?>
                      <?php if ($result['doc10'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type10'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc10"] . "</div></td>";
                      ?>
                      <?php if ($result['doc11'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type11'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc11"] . "</div></td>";
                      ?>
                      <?php if ($result['doc12'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type12'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc12"] . "</div></td>";
                      ?>
                      <?php if ($result['doc13'] == 'รอตรวจสอบข้อมูล')
                        echo "<td><div align =\"center\"><button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"check(" . $result['ID'] . " ," . $result['type13'] . " ," . $result['semester_name'] . ")\">LINK</button></div></td>";
                      else
                        echo "<td><div align =\"center\">" . $result["doc13"] . "</div></td>";
                      ?>
                    </tr>

                  <?php
                    $i = $i + 1;
                  }
                  ?>
                </tbody>

              </table>
      </div>
      <!-- The Modal -->

      <div class="modal fade" id="editModal" style="height:100%">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><b>ตรวจสอบเอกสารคำขอกู้</b></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" id="user_form2">

                <label for="name" style="margin-top:15px;margin-left:60px;">
                  <p id="check_name" name="check_name"></p>
                  <p id="check_name2" name="check_name2"></p>
                  <p id="check_type" name="check_type"></p>

                </label>
                <iframe id="show_doc" name="show_doc" frameborder="0" height="100%" width="100%">
                </iframe>
                <label for="name" style="margin-top:15px;margin-left:60px;">
                  <p id="check_name" name="check_name"></p>


                </label>
              </form>
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

  <!-- W3.CSS Container -->

  <script>
    // Script to open and close sidebar
    function check(id, type, semester) {
      window.open(
        'http://localhost/StudentLoan/fetchdocument.php?ID=' + id + '&Type=' + type,
        '_blank' // <- This is what makes it open in a new window.
      );
      // $.ajax({
      //   url: "fetchdocument.php?ID=" + id + "&Type=" + type,
      //   method: "GET",
      //   data: {
      //     id: id,
      //     type: type,

      //   },
      //   dataType: "json",
      //   success: function(data) {
      //     var url = "http://192.168.43.144:3001/" + data.upload_document_url
      //     document.getElementById("check_name").innerHTML = "ชื่อเอกสาร : " + data.upload_document_name
      //     document.getElementById("check_type").innerHTML = "ประเภทเอกสาร : " + data.type_of_document_name
      //     $('#show_doc').attr('src', url)
      //     // $('#check_semester').val(data.upload_document_name);
      //     $('#editModal').modal('show');
      //   },
      //   error: function() {
      //     swal({
      //       title: "ไม่สำเร็จ!",
      //       text: "เกิดข้อผิดพลาดขณะทำการลบข้อมูล",
      //       icon: "error"
      //     });
      //   }
      // })
    }

    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }
  </script>

</body>

</html>