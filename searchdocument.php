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

        .card {
            border-radius: 10px;
            margin-top: 1.25rem;
            width: 600px;
            height: 720px;
            margin-bottom: 1.25rem;
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
        $strSQL = "";
        $objQuery = mysqli_query($conn, $strSQL);
        ?>
        <!-- Header -->
        <div class="w3-container" style="margin-top:80px;" id="showcase">
            <h3><b>ตรวจสอบเอกสารคำขอกู้ยืม</b></h3>
            <center>
                <div class="card">
                    <br>
                    <div class="card-body" style="background-color:#fff;">
                        <form method="post" id="user_form" action="showcheckdoc.php">
                            <label for="name" style="margin-top:2px;margin-left:-320px;">
                                <font style="font-family: ff;"><b>เลขบัตรประชาชน</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input id="number_id" name="number_id" class="form-control" style="margin-left:60px;" />
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-340px;">
                                <font style="font-family: ff;"><b>รหัสนักศึกษา</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input id="student_id" name="student_id" class="form-control" style="margin-left:60px;" />
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-360px;">
                                <font style="font-family: ff;"><b>ชื่อ-สกุล</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input id="student_name" name="student_name" class="form-control" style="margin-left:60px;" />
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-380px;">
                                <font style="font-family: ff;"><b>ชั้นปี</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input id="year" name="year" class="form-control" style="margin-left:60px;" />
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-360px;">
                                <font style="font-family: ff;"><b>สาขาวิชา</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <select class="form-control" name="lmName1" style="margin-top:2px;margin-left:60px;width:410px;">
                                        <option value="">
                                            <-- สาขาวิชา -->
                                        </option>
                                        <?php
                                        if (!$conn) {
                                            echo $conn->connect_error;
                                            exit();
                                        }
                                        $strSQL = "SELECT * FROM tb_school_of ";
                                        $objQuery = mysqli_query($conn, $strSQL);
                                        while ($objResuut = mysqli_fetch_array($objQuery)) {
                                        ?>
                                            <option value="<?php echo $objResuut["school_of_id"]; ?>"><?php echo $objResuut["school_of_name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-340px;">
                                <font style="font-family: ff;"><b>ประเภทการกู้</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select class="form-control" name="lmName2" style="margin-top:2px;margin-left:60px;width:410px;">
                                        <option value="">
                                            <-- ประเภทการกู้ -->
                                        </option>
                                        <?php
                                        if (!$conn) {
                                            echo $conn->connect_error;
                                            exit();
                                        }
                                        $strSQL = "SELECT DISTINCT `type_scholarship` FROM tb_student ORDER BY type_scholarship ASC";
                                        $objQuery = mysqli_query($conn, $strSQL);
                                        while ($objResuut = mysqli_fetch_array($objQuery)) {
                                        ?>
                                            <option value="<?php echo $objResuut["type_scholarship"]; ?>"><?php echo $objResuut["type_scholarship"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <label for="name" style="margin-top:2px;margin-left:-320px;">
                                <font style="font-family: ff;"><b>ประเภทเอกสาร</b></font>
                            </label>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <select class="form-control" name="lmName3" style="margin-top:2px;margin-left:60px;width:410px;">
                                        <option value="">
                                            <-- ประเภทเอกสาร -->
                                        </option>
                                        <?php
                                        if (!$conn) {
                                            echo $conn->connect_error;
                                            exit();
                                        }
                                        $strSQL = "SELECT DISTINCT `type_of_document_id`,`type_of_document_name` FROM tb_type_of_document";
                                        $objQuery = mysqli_query($conn, $strSQL);
                                        while ($objResuut = mysqli_fetch_array($objQuery)) {
                                        ?>
                                            <option value="<?php echo $objResuut["type_of_document_id"]; ?>"><?php echo $objResuut["type_of_document_name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" name="insert" id="insert" class="btn btn-success" value="บันทึก" style="margin-bottom:15px;margin-top:15px;width:90px;" />

                        </form>
                    </div>
                </div>
            </center>
            <!-- The Modal -->



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