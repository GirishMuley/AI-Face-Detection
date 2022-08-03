<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Sending email</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="admin.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="admin.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            
            <a href="tables.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Contact
            </a>
             <a href="email.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email
            </a>
            <a href="attachment.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email two
            </a>
            <a href="calendar.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
            </a>
        </nav>
        
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                  <img src="./images/22711031_2033701353531580_66558966452191232_n-removebg-preview.jpg" />
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    
                    <a href="logout.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="admin.hbs" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="admin.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="tables.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Contact
                </a>
                <a
            href="email.php"
            class="flex items-center active-nav-link text-white py-2 pl-4 nav-item"
          >
            <i class="fas fa-table mr-3"></i>
            Email
          </a>
          <a href="attachment.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email two
            </a>
                <a href="calendar.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Calendar
                </a>
               
                <a href="logout.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
               
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>
<?php

include('includes/config.php');
 

// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// Load Composer's autoloader
require 'PHPMailer-master/src/OAuth.php';


if(isset($_POST['submit']))
{
 
/*$to_id = $_POST['toid'];*/

$email = $_POST['email'];
$subject =  $_POST['subject'];
$message = $_POST['message'];
//$image = $_FILES['image']['tmp_name'];
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '********';//Enter email here 
$mail->Password = '********';//Enter password here
$mail->SMTPSecure = 'tls';  
$mail->Port = 587;
$mail->setFrom('girish.muley007@gmail.com', 'AI Face Detection');
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->Body = $message;

//$mail->addAttachment($image,".pdf.png");       // Add attachments
    
if(!$mail->send())
{

$error = "Mailer Error: " .$mail->ErrorInfo;

echo "<div class=display> '.$error.'  </div>";

}
else
{

echo " <div class=display> Message Sent </div>";

}


}

else

{

}

?>    

    <form action="email.php" method="post" enctype="multipart/form-data">
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="w-full text-3xl text-black pb-6">Email</h1>

                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
                        <p class="text-xl pb-6 flex items-center">
                            <i class="fas fa-list mr-3"></i> Sending responce to user
                        </p>
                        <div class="leading-loose">
                            <form class="p-10 bg-white rounded shadow-xl">
                                
                                <div class="mt-2">
                                   <!-- This is an example component -->
                        <div class="relative inline-flex">
                            <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                            
                            <select name="email" class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                     <option>Choose a Email</option>
                            <?php
                            $query=mysqli_query($con,"select r_email from report");
                            while($row=mysqli_fetch_array($query))
                            {
                            ?>
                                     <option><?php echo htmlentities($row['r_email']);?></option>
                            <?php } ?>
                                     
    
                                </select>
                                
                        </div>
                        <div class="" >
                                    <label class="block text-sm text-gray-600" for="cus_name">Subject</label>
                                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="cus_name" name="subject" type="text" required="" placeholder="Subject" aria-label="Name">
                                </div>
                                </div>
                                <div class="mt-2">
                                    <label class=" block text-sm text-gray-600" for="message">Message</label>
                                    <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="message" name="message" rows="6" required="" placeholder="Your inquiry.." aria-label="Email"></textarea>
                                </div>
                              <!--  <div class="">
                                    <input type="file" class="form-control" class="file" id="postimage" name="image"  >
                                </div>-->
                                <div class="mt-6">
                                    <input class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" name="submit" type="submit"></button>
                                </div>
                            </form>
                        </div>
                    </div>
             </main>
    
            <footer class="w-full bg-white text-right p-4">
                Built by <a target="_blank" href="https://davidgrzyb.com" class="underline">Girish Muley</a>.
            </footer>
        </div>
        
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

                            
</body>
</html>
