<?php 
               include 'connect.php';     
               $txtname = $_POST['txtUsername'];
               $txtpass = $_POST['txtPassword'];
              ?>
              <?php
                if (!$conn) {
                echo $conn->connect_error;    
                exit();
               }  
                 $strSQL = "SELECT * FROM tb_admin WHERE username = '".$txtname."' and password = '".$txtpass."'";
                 $objQuery = mysqli_query($conn,$strSQL);
                 $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
      
                 if($txtname == ""){
                    }
                      else{
                          if($objResult =="" && $txtname != "")
                            { $txtname = "";
                              ?>
                              <script type="text/javascript">
                               swal({
                                title: "ล็อคอินไม่สำเร็จ",
                                icon: "error",
                              
                            });
                              </script>
                              <?php 
                            }
                              else
                              { 
                                session_start();
                                $_SESSION["username"] = $objResult["username"];
                                $_SESSION["admin_id"] = $objResult["admin_id"];
                                $_SESSION["password"] = $objResult["password"];
                                ?>
                                <script type="text/javascript">
                                   window.location.href= 'showcheckdoc.php' 
                                   </script>
                                <?php
                               }
                            }
                          mysqli_close($conn);
                          ?>