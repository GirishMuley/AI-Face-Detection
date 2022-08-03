<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

if($_GET['action']='del')
{
$postid=intval($_GET['pid']);
$query=mysqli_query($con,"delete from report where r_no='$postid'");
if($query)
{
$msg="Post deleted ";
}
else{
$msg="Something went wrong . Please try again.";    
} 
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | AI Face Detection</title>
    <meta name="author" content="David Grzyb" />
    <meta name="description" content="" />

    <!-- Tailwind -->
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
    
    <style>
      @import url("https://fonts.googleapis.com/css?family=Karla:400,700&display=swap");
      .font-family-karla {
        font-family: karla;
      }
      .bg-sidebar {
        background: #3d68ff;
      }
      .cta-btn {
        color: #3d68ff;
      }
      .upgrade-btn {
        background: #1947ee;
      }
      .upgrade-btn:hover {
        background: #0038fd;
      }
      .active-nav-link {
        background: #1947ee;
      }
      .nav-item:hover {
        background: #1947ee;
      }
      .account-link:hover {
        background: #3d68ff;
      }
    </style>
  </head>

  <body class="bg-gray-100 font-family-karla flex">
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
      <div class="p-6">
        <a
          href="admin.php"
          class="text-white text-3xl font-semibold uppercase hover:text-gray-300"
          >Admin</a
        >
      </div>
      <nav class="text-white text-base font-semibold pt-3">
        <a
          href="admin.php"
          class="flex items-center active-nav-link text-white py-4 pl-6 nav-item"
        >
          <i class="fas fa-tachometer-alt mr-3"></i>
          Dashboard
        </a>

        <a
          href="tables.php"
          class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
        >
          <i class="fas fa-table mr-3"></i>
          Contact
        </a>
        <a href="email.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email
            </a>
            <a href="attachment.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email two
            </a>
        <a
          href="calendar.php"
          class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item"
        >
          <i class="fas fa-calendar mr-3"></i>
          Calendar
        </a>
      </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
      <!-- Desktop Header -->
      <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
        <div class="w-1/2"></div>
        <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
          <button
            @click="isOpen = !isOpen"
            class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none"
          >
            <img src="./images/22711031_2033701353531580_66558966452191232_n-removebg-preview.jpg" />
          </button>
          <button
            x-show="isOpen"
            @click="isOpen = false"
            class="h-full w-full fixed inset-0 cursor-default"
          ></button>
          <div
            x-show="isOpen"
            class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16"
          >
           
            <a href="logout.php" class="block px-4 py-2 account-link hover:text-white"
              >Sign Out</a
            >
          </div>
        </div>
      </header>

      <!-- Mobile Header & Nav -->
      <header
        x-data="{ isOpen: false }"
        class="w-full bg-sidebar py-5 px-6 sm:hidden"
      >
        <div class="flex items-center justify-between">
          <a
            href="admin.php"
            class="text-white text-3xl font-semibold uppercase hover:text-gray-300"
            >Admin</a
          >
          <button
            @click="isOpen = !isOpen"
            class="text-white text-3xl focus:outline-none"
          >
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
          </button>
        </div>

        <!-- Dropdown Nav -->
        <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
          <a
            href="admin.php"
            class="flex items-center active-nav-link text-white py-2 pl-4 nav-item"
          >
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
          </a>

          <a
            href="tables.php"
            class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
          >
            <i class="fas fa-table mr-3"></i>
            Contact
          </a>
          <a
            href="email.php"
            class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
          >
            <i class="fas fa-table mr-3"></i>
            Email
          </a>
            <a href="attachment.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Email two
            </a>
          <a
            href="calendar.php"
            class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
          >
            <i class="fas fa-calendar mr-3"></i>
            Calendar
          </a>

          <a
            href="logout.php"
            class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
          >
            <i class="fas fa-sign-out-alt mr-3"></i>
            Sign Out
          </a>
        </nav>
        <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
      </header>

      <div class="w-full overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
          <h1 class="text-3xl text-black pb-6">Dashboard</h1>

          <div class="w-full mt-12">
            <p class="text-xl pb-3 flex items-center">
              <i class="fas fa-list mr-3"></i> Latest Reports
            </p>
            <div class="bg-white overflow-auto">
              <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                  <tr>
                    <th
                      class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      id
                    </th>
                    <th
                      class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      name
                    </th>
                    <th
                      class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      email
                    </th>
                    <th
                      class="text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      Message
                    </th>
                    <th
                      class="text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      Time
                    </th>
                    <th
                      class="text-left py-3 px-4 uppercase font-semibold text-sm"
                    >
                      Action
                    </th>
                  </tr>
                </thead>
                <?php 
                $query=mysqli_query($con,"select * from report");
                while($row=mysqli_fetch_array($query))
                {
                ?>
                
                
                <tbody class="text-gray-700">
                  <tr>
                    <td class="w-1/3 text-left py-3 px-4"><?php echo htmlentities($row['r_no']);?></td>
                    <td class="w-1/3 text-left py-3 px-4"><?php echo htmlentities($row['r_name']);?></td>
                    <td class="w-1/3 text-left py-3 px-4"><?php echo htmlentities($row['r_email']);?></td>
                    <td class="text-left py-3 px-4">
                      <a class="hover:text-blue-500" href="#"
                        ><?php echo htmlentities($row['r_message']);?></a
                      >
                    </td>
                    <td class="text-left py-3 px-4">
                      <a
                        class="hover:text-blue-500"
                        href="#"
                        ><?php echo htmlentities($row['r_time']);?></a
                      >
                    </td>
                    <td><a href="admin.php?pid=<?php echo htmlentities($row['r_no']);?>&&action=del" onclick="return confirm('Do you realy want to delete ?')"> <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg></a></td>
                  </tr>
                  </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
        </main>

        <footer class="w-full bg-white text-right p-4">
          Built by
          <a target="_blank" href="https://davidgrzyb.com" class="underline"
            >Girish Muley</a
          >.
        </footer>
      </div>
    </div>

    <!-- AlpineJS -->
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <!-- Font Awesome -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
      integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs="
      crossorigin="anonymous"
    ></script>
    <!-- ChartJS -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI="
      crossorigin="anonymous"
    ></script>


  </body>
  
</html>
<?php } ?>