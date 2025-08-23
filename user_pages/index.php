<?php
session_start();
include("../assets/db/db.php");
session_destroy();
$platform = $conn->prepare('SELECT * FROM platforms');
$platform->execute();

$platform = $platform->get_result();

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
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap");

    body {
      font-family: "Inter", sans-serif;
    }

    :where([class^="ri-"])::before {
      content: "\f3c2";
    }

    .masonry-grid {
      column-count: 4;
      column-gap: 1.5rem;
      column-fill: balance;
    }

    @media (max-width: 1024px) {
      .masonry-grid {
        column-count: 3;
      }
    }

    @media (max-width: 768px) {
      .masonry-grid {
        column-count: 2;
      }
    }

    @media (max-width: 640px) {
      .masonry-grid {
        column-count: 1;
      }
    }

    .masonry-item {
      break-inside: avoid;
      margin-bottom: 1.5rem;
    }

    .hover-button {
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s ease;
    }

    .card:hover .hover-button {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
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
            <span class="text-sm font-medium text-gray-700">XAF: 100,000</span>
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
                  <h3 class="font-semibold text-gray-900">John Doe</h3>
                  <p class="text-sm text-gray-500">john.doe@example.com</p>
                </div>
              </div>
            </div>

            <!-- Balance Section -->
            <div class="p-4 border-b border-gray-100">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm text-gray-500">Current Balance</p>
                  <p class="text-lg font-semibold text-gray-900">
                    XAF 100,000
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
              <a href="#"
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
                <?php } elseif ($platform_result['id'] === 6) { ?> <i class="ri-twitter-x-fill mr-2"></i>
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
  <?php
  $num = 6;
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
    <div class="masonry-grid">
      <!-- WhatsApp Account Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Professional%20WhatsApp%20business%20account%20interface%20with%20green%20theme%2C%20clean%20modern%20design%2C%20mobile%20phone%20mockup%20showing%20chat%20conversations%20and%20business%20features%2C%20minimalist%20background&amp;width=300&amp;height=200&amp;seq=1&amp;orientation=landscape"
              alt="WhatsApp Business Account" class="w-full h-48 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
              <i class="ri-whatsapp-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Verified</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">@TechSupport_Pro</h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>12.5K contacts
                </span>
                <span class="flex items-center">
                  <i class="ri-star-fill text-yellow-400 mr-1"></i>4.9
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$2,499</span>
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

      <!-- YouTube Channel Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=YouTube%20gaming%20channel%20banner%20with%20modern%20gaming%20setup%2C%20RGB%20lighting%2C%20multiple%20monitors%2C%20professional%20streaming%20equipment%2C%20dark%20gaming%20room%20atmosphere%20with%20neon%20accents&amp;width=300&amp;height=180&amp;seq=2&amp;orientation=landscape"
              alt="Gaming YouTube Channel" class="w-full h-44 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
              <i class="ri-youtube-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Monetized</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">GameMaster Elite</h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>85K subs
                </span>
                <span class="flex items-center">
                  <i class="ri-play-line mr-1"></i>2.1M views
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Gaming</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Reviews</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$8,750</span>
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

      <!-- Instagram Account Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Instagram%20fashion%20influencer%20profile%20with%20stylish%20lifestyle%20photos%2C%20modern%20fashion%20photography%2C%20clean%20aesthetic%20feed%20layout%2C%20bright%20natural%20lighting%2C%20minimalist%20fashion%20content&amp;width=300&amp;height=220&amp;seq=3&amp;orientation=landscape"
              alt="Fashion Instagram Account" class="w-full h-52 object-cover object-top" />
            <div
              class="absolute top-3 left-3 w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
              <i class="ri-instagram-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Influencer</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              @StyleVogue_Official
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>145K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-heart-line mr-1"></i>8.2% eng
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Fashion</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Lifestyle</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Beauty</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$5,200</span>
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

      <!-- TikTok Account Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=TikTok%20dance%20content%20creator%20studio%20with%20colorful%20LED%20lights%2C%20modern%20dance%20floor%2C%20trendy%20urban%20background%2C%20vibrant%20neon%20colors%2C%20creative%20video%20production%20setup&amp;width=300&amp;height=160&amp;seq=4&amp;orientation=landscape"
              alt="TikTok Dance Account" class="w-full h-40 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-black rounded-full flex items-center justify-center">
              <i class="ri-tiktok-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Viral</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">@DanceMoves_Pro</h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>320K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-heart-line mr-1"></i>15.7M likes
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$3,899</span>
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

      <!-- Facebook Page Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Facebook%20business%20page%20for%20food%20restaurant%20with%20delicious%20gourmet%20dishes%2C%20professional%20food%20photography%2C%20warm%20restaurant%20atmosphere%2C%20appetizing%20meals%20presentation&amp;width=300&amp;height=190&amp;seq=5&amp;orientation=landscape"
              alt="Restaurant Facebook Page" class="w-full h-46 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
              <i class="ri-facebook-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Business</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              Gourmet Bistro NYC
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>28K likes
                </span>
                <span class="flex items-center">
                  <i class="ri-map-pin-line mr-1"></i>New York
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Food</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Restaurant</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$1,850</span>
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

      <!-- LinkedIn Profile Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Professional%20LinkedIn%20profile%20for%20business%20executive%2C%20corporate%20headshot%2C%20modern%20office%20background%2C%20professional%20business%20attire%2C%20clean%20corporate%20environment&amp;width=300&amp;height=170&amp;seq=6&amp;orientation=landscape"
              alt="LinkedIn Executive Profile" class="w-full h-42 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center">
              <i class="ri-linkedin-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Premium</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              Michael Richardson
            </h3>
            <p class="text-sm text-gray-600 mb-3">
              Senior Marketing Director
            </p>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>15K connections
                </span>
                <span class="flex items-center">
                  <i class="ri-briefcase-line mr-1"></i>12 yrs exp
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$4,200</span>
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

      <!-- Twitter/X Account Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Twitter%20X%20social%20media%20account%20for%20tech%20news%20and%20cryptocurrency%2C%20modern%20tech%20workspace%2C%20multiple%20screens%20showing%20crypto%20charts%20and%20tech%20news%2C%20futuristic%20digital%20environment&amp;width=300&amp;height=200&amp;seq=7&amp;orientation=landscape"
              alt="Crypto Twitter Account" class="w-full h-48 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-black rounded-full flex items-center justify-center">
              <i class="ri-twitter-x-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Verified</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">@CryptoInsights_</h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>67K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-chat-3-line mr-1"></i>4.2K tweets
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Crypto</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Tech</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">News</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$6,500</span>
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

      <!-- Additional WhatsApp Business Card -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=WhatsApp%20business%20account%20for%20fitness%20coaching%2C%20gym%20equipment%20and%20workout%20environment%2C%20personal%20trainer%20setup%2C%20motivational%20fitness%20atmosphere%2C%20modern%20gym%20interior&amp;width=300&amp;height=180&amp;seq=8&amp;orientation=landscape"
              alt="Fitness WhatsApp Business" class="w-full h-44 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
              <i class="ri-whatsapp-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Business</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">FitCoach Premium</h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>8.9K contacts
                </span>
                <span class="flex items-center">
                  <i class="ri-star-fill text-yellow-400 mr-1"></i>4.8
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Fitness</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Coaching</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$1,950</span>
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

      <!-- Instagram Travel Account -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=Instagram%20travel%20account%20with%20stunning%20landscape%20photography%2C%20exotic%20destinations%2C%20tropical%20beaches%2C%20mountain%20views%2C%20adventure%20travel%20content%2C%20wanderlust%20inspiring%20imagery&amp;width=300&amp;height=240&amp;seq=9&amp;orientation=landscape"
              alt="Travel Instagram Account" class="w-full h-56 object-cover object-top" />
            <div
              class="absolute top-3 left-3 w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
              <i class="ri-instagram-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Travel</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              @Wanderlust_Explorer
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>92K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-camera-line mr-1"></i>1.2K posts
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Travel</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Adventure</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Photography</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$4,750</span>
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

      <!-- YouTube Tech Channel -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=YouTube%20tech%20review%20channel%20setup%20with%20latest%20gadgets%2C%20smartphones%2C%20laptops%2C%20tech%20accessories%2C%20modern%20tech%20review%20studio%2C%20clean%20white%20background%20with%20colorful%20tech%20products&amp;width=300&amp;height=160&amp;seq=10&amp;orientation=landscape"
              alt="Tech Review YouTube Channel" class="w-full h-40 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
              <i class="ri-youtube-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Tech</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              TechReview Central
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>156K subs
                </span>
                <span class="flex items-center">
                  <i class="ri-play-line mr-1"></i>8.7M views
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$12,900</span>
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

      <!-- TikTok Comedy Account -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=TikTok%20comedy%20content%20creator%20with%20funny%20props%20and%20colorful%20background%2C%20comedy%20sketch%20setup%2C%20humorous%20entertainment%20content%2C%20bright%20cheerful%20atmosphere%2C%20creative%20video%20production&amp;width=300&amp;height=200&amp;seq=11&amp;orientation=landscape"
              alt="Comedy TikTok Account" class="w-full h-48 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-black rounded-full flex items-center justify-center">
              <i class="ri-tiktok-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Comedy</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              @FunnyVibes_Daily
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>445K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-heart-line mr-1"></i>28.5M likes
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Comedy</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Entertainment</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$7,200</span>
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
      <!-- TikTok Comedy Account -->
      <div class="masonry-item">
        <div
          class="card bg-white rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
          style="transform: translateY(0px)">
          <div class="relative">
            <img
              src="https://readdy.ai/api/search-image?query=TikTok%20comedy%20content%20creator%20with%20funny%20props%20and%20colorful%20background%2C%20comedy%20sketch%20setup%2C%20humorous%20entertainment%20content%2C%20bright%20cheerful%20atmosphere%2C%20creative%20video%20production&amp;width=300&amp;height=200&amp;seq=11&amp;orientation=landscape"
              alt="Comedy TikTok Account" class="w-full h-48 object-cover object-top" />
            <div class="absolute top-3 left-3 w-8 h-8 bg-black rounded-full flex items-center justify-center">
              <i class="ri-tiktok-fill text-white text-lg"></i>
            </div>
            <div class="absolute top-3 right-3 bg-white bg-opacity-90 backdrop-blur-sm px-2 py-1 rounded-full">
              <span class="text-xs font-semibold text-gray-700">Comedy</span>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-2">
              @FunnyVibes_Daily
            </h3>
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-4 text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="ri-user-line mr-1"></i>445K followers
                </span>
                <span class="flex items-center">
                  <i class="ri-heart-line mr-1"></i>28.5M likes
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="flex flex-wrap gap-1">
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Comedy</span>
                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">Entertainment</span>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-primary">$7,200</span>
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
    </div>
  </main>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const filterButtons = document.querySelectorAll(".filter-btn");
      const dropdownMenus = document.querySelectorAll(".dropdown-menu");

      // Toggle dropdown on button click
      filterButtons.forEach((button, index) => {
        button.addEventListener("click", function (e) {
          e.stopPropagation();

          // Close all other dropdowns
          dropdownMenus.forEach((menu, menuIndex) => {
            if (menuIndex !== index) {
              menu.classList.add("hidden");
            }
          });

          // Calculate position for the dropdown
          const rect = button.getBoundingClientRect();
          const dropdown = dropdownMenus[index];

          // Position dropdown below the button
          dropdown.style.top = `${rect.bottom + 8}px`;
          dropdown.style.left = `${rect.left}px`;

          // Check if dropdown would go off screen and adjust
          const dropdownRect = dropdown.getBoundingClientRect();
          const viewportWidth = window.innerWidth;

          if (rect.left + dropdown.offsetWidth > viewportWidth) {
            dropdown.style.left = `${viewportWidth - dropdown.offsetWidth - 16
              }px`;
          }

          // Toggle current dropdown
          dropdown.classList.toggle("hidden");
        });
      });

      // Close dropdowns when clicking outside
      document.addEventListener("click", function () {
        dropdownMenus.forEach((menu) => {
          menu.classList.add("hidden");
        });
      });

      // Prevent dropdown from closing when clicking inside it
      dropdownMenus.forEach((menu) => {
        menu.addEventListener("click", function (e) {
          e.stopPropagation();
        });
      });

      // Handle country selection
      document.querySelectorAll(".dropdown-menu a").forEach((link) => {
        link.addEventListener("click", function (e) {
          e.preventDefault();
          const country = this.textContent.trim();
          const dropdown = this.closest(".dropdown-menu");

          // You can add logic here to handle the country selection
          console.log("Selected country:", country);

          // Close the dropdown
          dropdown.classList.add("hidden");

          // Optional: Update button appearance to show selection
          // button.classList.add('ring-2', 'ring-blue-500');
        });
      });

      // Handle scroll repositioning
      window.addEventListener("scroll", function () {
        dropdownMenus.forEach((menu) => {
          if (!menu.classList.contains("hidden")) {
            menu.classList.add("hidden");
          }
        });
      });

      // Handle window resize
      window.addEventListener("resize", function () {
        dropdownMenus.forEach((menu) => {
          menu.classList.add("hidden");
        });
      });
    });
  </script>
  <script>
    // Filter functionality

    // Card interactions
    document.addEventListener("DOMContentLoaded", function () {
      const cards = document.querySelectorAll(".card");

      cards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-4px)";
        });

        card.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0)";
        });
      });
    });

    // Form handling
    document.addEventListener(
      "submit",
      (event) => {
        event.preventDefault();
      },
      true
    );

    // Toggle dropdown functionality
    const profileButton = document.getElementById("profileButton");
    const profileDropdown = document.getElementById("profileDropdown");
    const dropdownArrow = document.getElementById("dropdownArrow");

    let isDropdownOpen = false;

    function toggleDropdown() {
      isDropdownOpen = !isDropdownOpen;

      if (isDropdownOpen) {
        profileDropdown.classList.remove(
          "opacity-0",
          "invisible",
          "translate-y-1"
        );
        profileDropdown.classList.add(
          "opacity-100",
          "visible",
          "translate-y-0"
        );
        dropdownArrow.style.transform = "rotate(180deg)";
      } else {
        profileDropdown.classList.add(
          "opacity-0",
          "invisible",
          "translate-y-1"
        );
        profileDropdown.classList.remove(
          "opacity-100",
          "visible",
          "translate-y-0"
        );
        dropdownArrow.style.transform = "rotate(0deg)";
      }
    }

    // Toggle dropdown when profile button is clicked
    profileButton.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleDropdown();
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
      if (
        !profileButton.contains(e.target) &&
        !profileDropdown.contains(e.target)
      ) {
        if (isDropdownOpen) {
          toggleDropdown();
        }
      }
    });

    // Close dropdown when pressing Escape key
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && isDropdownOpen) {
        toggleDropdown();
      }
    });

    // Prevent dropdown from closing when clicking inside it
    profileDropdown.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  </script>
</body>

</html>