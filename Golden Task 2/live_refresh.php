<?php
session_start();

include '../dbconn.php';

$user_id = $_SESSION['globle_id'];
$fri_name = $_SESSION['fri_name_for_chat'];



$show_chat_data_sql = "SELECT * FROM `table_id_$user_id` WHERE `send_msg_to` LIKE '$fri_name'  OR `recived_msg_from` LIKE '$fri_name' ORDER BY `table_id_$user_id`.`timeline` DESC ";
$show_chat_data_conn = mysqli_query($conn2,$show_chat_data_sql);
$show_chat_data_nums = mysqli_num_rows($show_chat_data_conn);
// $show_chat_data_assoc = mysqli_fetch_assoc($show_chat_data_conn);

$get_fri_photo_sql = "SELECT * FROM `users` WHERE `name` LIKE '$fri_name'";
$get_fri_photo_conn = mysqli_query($conn,$get_fri_photo_sql);
$get_fri_photo_assoc  =  mysqli_fetch_assoc($get_fri_photo_conn);




?>


<?php
          
          while($show_chat_data_assoc = mysqli_fetch_assoc($show_chat_data_conn)){
            if( $show_chat_data_nums && $show_chat_data_assoc['send_msg_to'] != NULL){

                $time  =  $show_chat_data_assoc['all_time'];
                
              echo '
              
              <div class="d-flex justify-content-end text-end mb-1">
                    <div class="w-100">
                      <div class="d-flex flex-column align-items-end">
                        <div class="bg-primary text-white p-2 px-3 rounded-2">'.$show_chat_data_assoc['send_msg'].'</div>
                        <div class="d-flex my-2">
                          <div class="small text-secondary">'.date('g.i a', strtotime($time)).'</div>
                          <!-- <div class="small ms-2"><i class="fa-solid fa-check-double text-info"></i></div> -->
                        </div>
                      </div>
                    </div>
                  </div>  
              
              ';

            }else{

                $time  =  $show_chat_data_assoc['all_time'];
              echo '
              
              
              <!-- Chat message left -->
                  <div class="d-flex mb-1">
                    <div class="flex-shrink-0 avatar avatar-xs me-2">
                      <img class="avatar-img rounded-circle" src="'.$get_fri_photo_assoc['profile_photo'].'" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <div class="w-100">
                        <div class="d-flex flex-column align-items-start">
                          <div class="bg-light text-secondary p-2 px-3 rounded-2">'.$show_chat_data_assoc['recived_msg'].'</div>
                          <!-- Files START -->
                          <!-- Files END -->
                          <div class="small my-2">'.date('H.i A', strtotime($time)).'</div>
                        </div>
                      </div>
                    </div>
                  </div>
                          
              ';
            }
          }


          
          ?>