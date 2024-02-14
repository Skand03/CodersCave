<?php
session_start();

include 'dbconn.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] != true ){
  header('Location: index.php');
  exit();
 }

 $username =  $_SESSION['username'];
 $user_id = $_SESSION['globle_id'];

//  if($_SESSION["chat_$fri_id"] != 'on' ){

if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["chat"]) ){

    $fri_id = $_POST['fri_id_for_chat'];
    $fri_name = $_POST['fri_name_for_chat'];

  // $_SESSION["chat_$fri_id"] = 'on';
  // $_SESSION["chat_name_$fri_id"] = $fri_name;
  // $_SESSION["chat_id_$fri_id"] = $fri_id;

  $get_fri_data_sql = "SELECT * FROM `users` WHERE `id` LIKE '$fri_id'";
  $get_fri_data_conn = mysqli_query($conn,$get_fri_data_sql);
  $get_fri_data_assoc = mysqli_fetch_assoc($get_fri_data_conn);

  $_SESSION['fri_name_for_chat'] = $fri_name; 


}
  //  }
  //  else{
    //   $fri_name = $_SESSION["chat_name_$fri_id"];
//   $fri_id = $_SESSION["chat_id_$fri_id"];
//  }



    // echo $_SESSION["chat_id_$fri_id"];
    // echo $_SESSION["chat_name_$fri_id"];
    // echo $_SESSION["chat_$fri_id"];
    

?>

<?php 
 
 if (isset($_POST["chat"])){

  
  $fri_id = $_POST['fri_id'];
  $fri_name = $_POST['fri_name'];
  $user_id = $_SESSION['globle_id'];
  $user_naame = $_POST['username'];
  $msg = $_POST['msg'];

  date_default_timezone_set("Asia/Kolkata");

  $time = date('Y-m-d H:i:s');




//   $time1 = strtotime($time);

//   $time2 = date('Y-m-d', $time1);

// // $time2 store in sql query.............   




$insert_msg_sql_1 = "INSERT INTO `table_id_$user_id` (`send_msg_to`, `send_msg`, `all_time`) VALUES ('$fri_name', '$msg', '$time')";
// $insert_msg_conn_1 = mysqli_query($conn2,$insert_msg_sql_1);
$insert_msg_sql_2 = "INSERT INTO `table_id_$fri_id` (`recived_msg_from`, `recived_msg`, `all_time`) VALUES ('$user_naame', '$msg', '$time' )";
// $insert_msg_conn_2 = mysqli_query($conn2,$insert_msg_sql_2);


  if( $insert_msg_conn_1 = mysqli_query($conn2,$insert_msg_sql_1) && $insert_msg_conn_2 = mysqli_query($conn2,$insert_msg_sql_2) ){
      
    $get_fri_data_sql = "SELECT * FROM `users` WHERE `id` LIKE '$fri_id'";
    $get_fri_data_conn = mysqli_query($conn,$get_fri_data_sql);
    $get_fri_data_assoc = mysqli_fetch_assoc($get_fri_data_conn);

    $_SESSION['fri_name_for_chat'] = $fri_name;

  }
  
 }
 
?>








<?php



$show_chat_data_sql = "SELECT * FROM `table_id_$user_id` WHERE `send_msg_to` LIKE '$fri_name'  OR `recived_msg_from` LIKE '$fri_name' ";
$show_chat_data_conn = mysqli_query($conn2,$show_chat_data_sql);
$show_chat_data_nums = mysqli_num_rows($show_chat_data_conn);
// $show_chat_data_assoc = mysqli_fetch_assoc($show_chat_data_conn);

?>









<!DOCTYPE html>
<html lang="en">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


<!-- Mirrored from social.webestica.com/messaging.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 May 2023 13:58:51 GMT -->
<head>
	<title>Social Bliss - Chat</title>

  <style>
    /* body{
      overflow: hidden;
    } */
  </style>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Bootstrap 5 based Social Media Network and Community Theme">
	<link rel="icon" type="image/x-icon" href="assets/images/only-logo.png">

	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')
 
		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					}) 
				})

			}
		})
		
	</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://www.tutorialspoint.com/jquery/jquery-3.6.0.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>



<script>
      $(document).ready(function(){
        setInterval(function(){
          $("#message_live").load("live_refresh.php");
          refresh();
        },1000);
      });
    </script>




	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/OverlayScrollbars-master/css/OverlayScrollbars.min.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	 
</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main  >
  
  <!-- Container START -->
  <div class="container m-0 " >
		<div class="row gx-0 my_box "    >
      <!-- Sidebar START -->
      
      <!-- Sidebar START -->

      <!-- Chat conversation START -->
      <div class="col-lg-8 col-xxl-9"  >
        <div class="card card-chat rounded-start-lg-0 border-start-lg-0"  >
          <div class="card-body h-100"  >
            <div class="tab-content py-0 mb-0 h-100"  id="chatTabsContent">
              <!-- Conversation item START -->
              
                <!-- Top avatar and status START -->
                <div class="d-sm-flex justify-content-between align-items-center"   >
                  <div class="d-flex mb-2 mb-sm-0" style="z-index: 1; " >
                    <div class="flex-shrink-0 avatar me-2">
                      <img class="avatar-img rounded-circle" src="<?php echo $get_fri_data_assoc['profile_photo'] ?>" alt="">
                    </div>
                    <div class="d-block flex-grow-1"  >
                      <h6 class="mb-0 mt-1"> &#160; <?php echo $get_fri_data_assoc['name']; ?></h6>
                      <div class="small text-secondary"> &#160; <?php echo $get_fri_data_assoc['profession'] ?> </div>
                      <!-- <div class="small text-secondary"><i class="fa-solid fa-circle text-success me-1"></i>Online</div> -->
                    </div>
                    <div class="d-block flex-grow-1"  >
                      <a href="profile-friend.php">
                    <button type="button" class="btn btn-primary ms-3 "> Go Back </button>
                    </a>
                  </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <!-- Call button -->
                    <!-- <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Audio call"><i class="bi bi-telephone-fill"></i></a>
                    <a href="#!" class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Video call"><i class="bi bi-camera-video-fill"></i></a> -->
                    <!-- Card action START -->
                    <!-- <div class="dropdown">
                      <a class="icon-md rounded-circle btn btn-primary-soft me-2 px-2" href="#" id="chatcoversationDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>               
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chatcoversationDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-check-lg me-2 fw-icon"></i>Mark as read</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-mic-mute me-2 fw-icon"></i>Mute conversation</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-check me-2 fw-icon"></i>View profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2 fw-icon"></i>Delete chat</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-archive me-2 fw-icon"></i>Archive chat</a></li>
                      </ul>
                    </div> -->
                    <!-- Card action END -->
                  </div>
                  </div>
              
                <!-- Top avatar and status END -->
                <hr>
                <!-- Chat conversation START -->
                <div class="chat-conversation-content custom-scrollbar">
                  <!-- Chat time -->
                  <!-- <div class="text-center small my-2">Jul 16, 2022, 06:15 am</div> -->
                  <!-- Chat message left -->
                  <!-- Chat message right -->

                  <div class="card-footer" style="position: fixed;" >
            <div class="d-sm-flex align-items-end">
                <form action="" method="post">


                    <input type="hidden" name="fri_id" value="<?php echo $fri_id; ?>" >
                    <input type="hidden" name="chat" value="on" >
                    <input type="hidden" name="fri_name" value="<?php echo $fri_name; ?>" >
                    <input type="hidden" name="username" value="<?php echo $username; ?>" >
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" >
              <textarea name="msg" required class="form-control mb-sm-0 mb-3" data-autoresize placeholder="Type a message" rows="1"></textarea>
              <!-- <button class="btn btn-sm btn-danger-soft ms-sm-2"><i class="fa-solid fa-face-smile fs-6"></i></button>
              <button class="btn btn-sm btn-secondary-soft ms-2"><i class="fa-solid fa-paperclip fs-6"></i></button> -->
              <br>
              <button class="btn btn-sm btn-primary ms-2" type="submit" ><i class="fa-solid fa-paper-plane fs-6"></i></button>
                </form>
            </div>
          </div>
          
          <div class="mt-5">.</div>
          <div class="mt-5" >.</div>
          <div class="mt-5"></div>

                <div id="message_live">

                </div>       <!-- Chat message right -->
                  




                  





                <!-- Chat conversation END -->
              </div>
              <!-- Conversation item END -->
            </div>
          </div>
          
        </div>
      </div>
      <!-- Chat conversation END -->
    </div> <!-- Row END -->
    <!-- =======================
    Chat END -->

	</div>
  <!-- Container END -->

  </div>

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Chat START -->
<div class="position-fixed bottom-0 end-0 p-3">

  <!-- Chat toast START -->
  <div id="chatToast" class="toast bg-mode" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
    <div class="toast-header bg-mode d-flex justify-content-between">
      <!-- Title -->
      <h6 class="mb-0">New message</h6>
      <button class="btn btn-secondary-soft-hover py-1 px-2" data-bs-dismiss="toast" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <!-- Top avatar and status END -->
    <div class="toast-body collapse show" id="collapseChat">
      <!-- Chat conversation START -->
      <!-- Form -->
      <form>
        <div class="input-group mb-3">
          <span class="input-group-text border-0">To</span>
          <input class="form-control" type="text" placeholder="Type a name or multiple names">
        </div>
      </form>         
      <!-- Chat conversation END -->
      <!-- Extra space -->
      <div class="h-200px"></div>
      <!-- Button  -->
      <div class="d-sm-flex align-items-end">
        <textarea class="form-control mb-sm-0 mb-3" placeholder="Type a message" rows="1" spellcheck="false"></textarea>
        <button class="btn btn-sm btn-danger-soft ms-sm-2"><i class="fa-solid fa-face-smile fs-6"></i></button>
        <button class="btn btn-sm btn-secondary-soft ms-2"><i class="fa-solid fa-paperclip fs-6"></i></button>
        <button class="btn btn-sm btn-primary ms-2"><i class="fa-solid fa-paper-plane fs-6"></i></button>
      </div>
    </div>
  </div>
  <!-- Chat toast END -->

</div>
<!-- Chat END -->

<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/OverlayScrollbars-master/js/OverlayScrollbars.min.js"></script>

<!-- Theme Functions -->
<script src="assets/js/functions.js"></script>




<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


<script>
  AOS.init();	
</script>



</body>




<!-- Mirrored from social.webestica.com/messaging.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 May 2023 13:58:52 GMT -->
</html>
















