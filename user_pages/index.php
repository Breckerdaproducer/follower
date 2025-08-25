<?php
session_start();
include("../assets/db/db.php");
if (!isset($_SESSION['luxin_user'])) {
  header('location: ../auth/login');
}
// select platform from database
$platform = $conn->prepare('SELECT * FROM platforms');
$platform->execute();
$platform = $platform->get_result();
// select user from database
$select_user = $conn->prepare('SELECT * FROM users WHERE user_id = ?');
$select_user->bind_param('i', $_SESSION['luxin_user']);
$select_user->execute();
$select_user = $select_user->get_result();
$user = $select_user->fetch_assoc();
// select accounts from database
$accounts = $conn->prepare('SELECT * FROM accounts');
$accounts->execute();
$accounts = $accounts->get_result();
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Luxin Boost - Premium Social Media Accounts</title>
  <link rel="shortcut icon" href="../assets/images/logo/favicon.ico" type="image/x-icon" />
  <script src="../assets/tailwind.js"></script>

  <link href="../assets/RemixIcon_Fonts_v4.6.0/fonts/remixicon.css" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#3B82F6",
            secondary: "#60A5FA",
          },
          borderRadius: {
            none: "0px",
            sm: "4px",
            DEFAULT: "8px",
            md: "12px",
            lg: "16px",
            xl: "20px",
            "2xl": "24px",
            "3xl": "32px",
            full: "9999px",
            button: "8px",
          },
        },
      },
    };
  </script>
  <link rel="stylesheet" href=" assets/style.css" />
</head>

<body class="bg-gray-50 min-h-screen">
  <!-- Navigation -->
  <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50 border-b border-gray-100">
    <div class="px-6 py-4">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="flex cursor-pointer items-center space-x-3" onclick="location.href='../'">
          <div class="w-8 h-8 overflow-hidden bg-primary rounded-md flex items-center justify-center">
            <img src="../assets/images/logo.webp" alt="" />
          </div>
          <span class="text-xl font-bold text-gray-900">Luxin Boost</span>
        </div>

        <!-- Desktop Search Bar -->
        <div class="flex-1 hidden lg:block max-w-2xl mx-8">
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="ri-search-line text-gray-400"></i>
            </div>
            <input type="text" placeholder="Search accounts by platform, followers, or price..."
              class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm" />
          </div>
        </div>

        <!-- User Menu -->
        <div class="relative">
          <button id="profileButton"
            class="flex items-center space-x-2 px-4 py-2 rounded-button bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
              <i class="ri-user-line text-white text-sm"></i>
            </div>
            <span class="text-sm font-medium text-gray-700">XAF:
              <?php echo htmlspecialchars(number_format($user['balance'])); ?></span>
            <i class="ri-arrow-down-s-line text-gray-500 text-sm transition-transform duration-200"
              id="dropdownArrow"></i>
          </button>

          <!-- Dropdown Menu -->
          <div id="profileDropdown"
            class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible transform translate-y-1 transition-all duration-200 ease-out">
            <!-- User Info Section -->
            <div class="p-4 border-b border-gray-100">
              <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                  <i class="ri-user-line text-white text-lg"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900">
                    <?php echo htmlspecialchars($user['user_name']); ?>
                  </h3>
                  <p class="text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
              </div>
            </div>

            <!-- Balance Section -->
            <div class="p-4 border-b border-gray-100">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-500">Current Balance</p>
                  <p class="text-lg font-semibold text-gray-900">
                    XAF: <?php echo htmlspecialchars(number_format($user['balance'])); ?>
                  </p>
                </div>
                <button
                  class="px-3 py-1.5 bg-green-500 text-white text-sm rounded-lg hover:bg-green-600 transition-colors duration-200">
                  <i class="ri-add-line mr-1"></i>
                  Deposit
                </button>
              </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="p-4 border-b border-gray-100 lg:hidden">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i class="ri-search-line text-gray-400"></i>
                </div>
                <input type="text" placeholder="Search accounts..."
                  class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm" />
              </div>
            </div>

            <!-- Menu Items -->
            <div class="py-2">
              <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <i class="ri-user-settings-line mr-3 text-gray-400"></i>
                Profile
              </a>
              <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <i class="ri-shopping-cart-line mr-3 text-gray-400"></i>
                My Orders
              </a>
              <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <i class="ri-wallet-line mr-3 text-gray-400"></i>
                Transaction History
              </a>

              <a href="#"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <i class="ri-settings-line mr-3 text-gray-400"></i>
                Settings
              </a>
            </div>

            <!-- Logout Section -->
            <div class="border-t border-gray-100 py-2">
              <a href="../auth/php/logout?logout_id=<?php echo htmlspecialchars($user['user_id']); ?>"
                onclick="return confirm('Are you sure you want to logout?')"
                class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                <i class="ri-logout-box-line mr-3"></i>
                Sign Out
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Filter Bar -->
  <div class="fixed top-20 left-0 right-0 bg-white border-b border-gray-100 z-40">
    <div class="px-6 py-4">
      <div class="flex items-center space-x-4 overflow-x-auto overflow-visible">
        <!-- All Platforms Button -->
        <div class="relative">
          <button
            class="filter-btn active px-4 py-2 bg-primary text-white rounded-full text-sm font-medium whitespace-nowrap !rounded-button flex items-center">
            All Platforms
            <i class="ri-arrow-down-s-line ml-2"></i>
          </button>
        </div>
        <?php
        if ($platform->num_rows > 0) {
          while ($platform_result = $platform->fetch_assoc()) {


            ?>
            <!-- WhatsApp Button -->
            <div class="relative">
              <button
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors whitespace-nowrap !rounded-button flex items-center">
                <?php if ($platform_result['id'] === 1) { ?> <i class="ri-whatsapp-fill mr-2"></i>
                <?php } elseif ($platform_result['id'] === 2) { ?> <i class="ri-facebook-fill mr-2"></i>
                <?php } elseif ($platform_result['id'] === 3) { ?> <i class="ri-tiktok-fill mr-2"></i>
                <?php } elseif ($platform_result['id'] === 4) { ?> <i class="ri-youtube-fill mr-2"></i>
                <?php } elseif ($platform_result['id'] === 5) { ?> <i class="ri-instagram-fill mr-2"></i>
                <?php } ?>
                <?php echo htmlspecialchars($platform_result['name']); ?>

                <i class="ri-arrow-down-s-line ml-2"></i>
              </button>
            </div>
          <?php }
        }
        ?>






      </div>
    </div>
  </div>

  <!-- Dropdown Menus - Fixed positioned outside the container -->
  <!-- All Platforms Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      All Countries
    </div>
    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">🌍 Global</a>
  </div>
  <?php
  $num = 1;
  $fetch = $conn->prepare('SELECT * FROM countries WHERE platform_id = ?');
  $fetch->bind_param('i', $num);
  $fetch->execute();
  $fetch = $fetch->get_result();


  ?>
  <!-- WhatsApp Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      Available Countries
    </div>
    <?php
    if ($fetch->num_rows > 0) {
      while ($fetch_result = $fetch->fetch_assoc()) {


        ?>
        <a href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><?php echo htmlspecialchars($fetch_result['name']); ?></a>
        <?php
      }
    }
    ?>
  </div>
  <?php
  $num = 2;
  $fetch = $conn->prepare('SELECT * FROM countries WHERE platform_id = ?');
  $fetch->bind_param('i', $num);
  $fetch->execute();
  $fetch = $fetch->get_result();


  ?>
  <!-- WhatsApp Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      Available Countries
    </div>
    <?php
    if ($fetch->num_rows > 0) {
      while ($fetch_result = $fetch->fetch_assoc()) {


        ?>
        <a href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><?php echo htmlspecialchars($fetch_result['name']); ?></a>
        <?php
      }
    }
    ?>
  </div>
  <?php
  $num = 3;
  $fetch = $conn->prepare('SELECT * FROM countries WHERE platform_id = ?');
  $fetch->bind_param('i', $num);
  $fetch->execute();
  $fetch = $fetch->get_result();


  ?>
  <!-- WhatsApp Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      Available Countries
    </div>
    <?php
    if ($fetch->num_rows > 0) {
      while ($fetch_result = $fetch->fetch_assoc()) {


        ?>
        <a href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><?php echo htmlspecialchars($fetch_result['name']); ?></a>
        <?php
      }
    }
    ?>
  </div>
  <?php
  $num = 4;
  $fetch = $conn->prepare('SELECT * FROM countries WHERE platform_id = ?');
  $fetch->bind_param('i', $num);
  $fetch->execute();
  $fetch = $fetch->get_result();


  ?>
  <!-- WhatsApp Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      Available Countries
    </div>
    <?php
    if ($fetch->num_rows > 0) {
      while ($fetch_result = $fetch->fetch_assoc()) {


        ?>
        <a href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><?php echo htmlspecialchars($fetch_result['name']); ?></a>
        <?php
      }
    }
    ?>
  </div>
  <?php
  $num = 5;
  $fetch = $conn->prepare('SELECT * FROM countries WHERE platform_id = ?');
  $fetch->bind_param('i', $num);
  $fetch->execute();
  $fetch = $fetch->get_result();


  ?>
  <!-- WhatsApp Dropdown -->
  <div class="dropdown-menu fixed bg-white border border-gray-200 rounded-lg shadow-xl py-2 min-w-48 hidden z-[9999]">
    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide border-b border-gray-100">
      Available Countries
    </div>
    <?php
    if ($fetch->num_rows > 0) {
      while ($fetch_result = $fetch->fetch_assoc()) {


        ?>
        <a href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"><?php echo htmlspecialchars($fetch_result['name']); ?></a>
        <?php
      }
    }
    ?>
  </div>
  <!-- Main Content -->
  <main class="pt-40 pb-8 px-6">
    <div class="masonry-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <?php
      if ($accounts->num_rows > 0) {
        while ($accounts_result = $accounts->fetch_assoc()) {


          ?>
          <!-- Instagram Account Card -->
          <div class="masonry-item ">
            <div
              class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
              <div class="relative">
                <img src="../assets/account_img/<?php echo htmlspecialchars($accounts_result['img']); ?>"
                  alt="Fashion Instagram Account" class="w-full h-52 object-cover object-top" />
                <div class="absolute top-3 left-3 w-8 h-8 
                                    <?php
                                    if ($accounts_result['platform'] === 'facebook') {
                                      echo 'bg-blue-600';
                                    } elseif ($accounts_result['platform'] === 'instagram') {
                                      echo 'bg-gradient-to-r from-purple-500 to-pink-500';
                                    } elseif ($accounts_result['platform'] === 'tiktok') {
                                      echo 'bg-black';
                                    } elseif ($accounts_result['platform'] === 'whatsapp') {
                                      echo 'bg-green-500';
                                    } elseif ($accounts_result['platform'] === 'youtube') {
                                      echo 'bg-red-500';
                                    }


                                    ?>
                                    
                                    rounded-full flex items-center justify-center">
                  <i class="ri-<?php echo htmlspecialchars($accounts_result['platform']); ?>-fill text-white text-lg"></i>
                </div>
                <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
                  <span
                    class="text-xs font-semibold text-gray-700"><?php echo htmlspecialchars($accounts_result['status']); ?></span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="font-semibold text-gray-900 mb-2">
                  @<?php echo htmlspecialchars($accounts_result['username']); ?>
                </h3>
                <div class="flex items-center justify-between mb-3">
                  <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                      <i class="ri-user-line mr-1"></i><?php
                      if (!function_exists('format_likes')) {
                        function format_likes($number)
                        {
                          if ($number >= 1000) {
                            $formatted_number = $number / 1000;
                            return $formatted_number . 'k';
                          } else {
                            return $number;
                          }
                        }

                      }
                      if ($accounts_result['followers'] >= 1000) {
                        $formatted_followers = format_likes($accounts_result['followers']);
                        echo htmlspecialchars($formatted_followers);
                      } else {
                        echo htmlspecialchars(number_format($accounts_result['followers']));
                      }

                      ?>
                      followers
                    </span>
                    <span class="flex items-center">
                      <i class="ri-map-pin-line mr-1"></i><?php echo htmlspecialchars($accounts_result['location']); ?>
                    </span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="flex flex-wrap gap-1">
                    <?php
                    if ($accounts_result['s_1'] !== '') {

                      ?>
                      <span
                        class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs"><?php echo htmlspecialchars($accounts_result['s_1']); ?></span>
                      <?php
                    } ?>
                    <?php
                    if ($accounts_result['s_2'] !== '') {

                      ?>

                      <span
                        class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs"><?php echo htmlspecialchars($accounts_result['s_2']); ?></span>
                      <?php
                    } ?>
                    <?php
                    if ($accounts_result['s_3'] !== '') {

                      ?>

                      <span
                        class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs"><?php echo htmlspecialchars($accounts_result['s_3']); ?></span>
                      <?php
                    } ?>
                  </div>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-2xl font-bold text-primary">
                    <?php echo htmlspecialchars(number_format($accounts_result['price'])); ?> XAF</span>
                  <div class="hover-button">
                    <button
                      class="bg-black/90 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap !rounded-button">
                      Buy Now
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </main>
  <script src="assets/script.js">

  </script>
</body>

</html>