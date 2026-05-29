<?php
session_start();
include 'db.php';
// Check authorization
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Session timeout check (30 minutes)
$timeout = 1800; // 1800 seconds = 30 minutes
if (time() - $_SESSION['login_time'] > $timeout) {
    session_destroy();
    header("Location: login.php?msg=Session timeout");
    exit();
}


$username = $_SESSION['username'];
$query = "SELECT profile_image FROM user WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$profile_image = $user['profile_image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Neuromorphic UI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  
  <style>
    :root {
      --neu-bg-primary: #e6e9ef;
      --neu-bg-secondary: #d1d5db;
      --neu-shadow-dark: #b8bcc2;
      --neu-shadow-light: #ffffff;
      --neu-primary: #7c3aed;
    }
    .dark {
      --neu-bg-primary: #374151;
      --neu-bg-secondary: #1f2937;
      --neu-shadow-dark: #111827;
      --neu-shadow-light: #4b5563;
    }
    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: linear-gradient(145deg, var(--neu-bg-primary), var(--neu-bg-secondary));
      min-height: 100vh;
    }
    .neu-raised {
      background: linear-gradient(145deg, var(--neu-bg-primary), var(--neu-bg-secondary));
      box-shadow: 8px 8px 16px var(--neu-shadow-dark), -8px -8px 16px var(--neu-shadow-light);
    }
    .neu-inset {
      background: linear-gradient(145deg, var(--neu-bg-secondary), var(--neu-bg-primary));
      box-shadow: inset 6px 6px 12px var(--neu-shadow-dark), inset -6px -6px 12px var(--neu-shadow-light);
    }
    .neu-btn {
      transition: all 0.2s ease;
    }
    .neu-btn:hover {
      transform: translateY(-3px);
    }
  </style>
</head>
<body class="text-gray-700 dark:text-gray-200">

  <!-- Top Navigation -->
  <nav class="neu-raised border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <span class="iconify text-3xl text-purple-600" data-icon="lucide:brain"></span>
        <h1 class="text-2xl font-semibold tracking-tight">Neuromorphic</h1>
      </div>
      
      <div class="flex items-center gap-6">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 rounded-2xl neu-inset flex items-center justify-center">
            <?php if (!empty($profile_image) && file_exists($profile_image)): ?>
              <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="w-full h-full object-cover rounded-full">
            <?php else: ?>
              <div class="w-full h-full bg-purple-100 flex items-center justify-center rounded-full">
                <span class="iconify text-purple-600 text-2xl" data-icon="lucide:user"></span>
              </div>
            <?php endif; ?>
          </div>
          <div>
            <p class="font-medium"><?= htmlspecialchars($_SESSION['username']) ?></p>
            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
          </div>
        </div>
        
        <a href="logout.php" 
           class="neu-btn px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl font-medium flex items-center gap-2">
          <span class="iconify" data-icon="lucide:log-out"></span>
          Logout
        </a>
      </div>
    </div>
  </nav>

  <div class="max-w-5xl mx-auto px-6 py-12">
    
    <!-- Welcome Header -->
    <div class="text-center mb-12">
      <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl neu-inset mb-6 rounded-full">
       <?php if (!empty($profile_image) && file_exists($profile_image)): ?>
              <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="w-full h-full object-cover rounded-full">
            <?php else: ?>
              <div class="w-full h-full bg-purple-100 flex items-center justify-center rounded-full">
                <span class="iconify text-purple-600 text-2xl" data-icon="lucide:user"></span>
              </div>
            <?php endif; ?>
      </div>
      <h1 class="text-5xl font-semibold tracking-tight mb-3">
        Welcome back, <span class="text-purple-600"><?= htmlspecialchars($_SESSION['username']) ?></span>!
      </h1>
      <p class="text-xl text-gray-500 dark:text-gray-400">You're successfully logged in</p>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Username Card -->
      <div class="neu-raised rounded-3xl p-8">
        <div class="flex items-center gap-4 mb-6">
          <span class="iconify text-4xl text-purple-500" data-icon="lucide:user"></span>
          <div>
            <p class="text-sm text-gray-500">Username</p>
            <p class="text-2xl font-semibold"><?= htmlspecialchars($_SESSION['username']) ?></p>
          </div>
        </div>
      </div>

      <!-- Email Card -->
      <div class="neu-raised rounded-3xl p-8">
        <div class="flex items-center gap-4 mb-6">
          <span class="iconify text-4xl text-purple-500 flex-shrink-0" 
                data-icon="lucide:mail" 
                data-width="40"></span>
          <div class="min-w-0 flex-1">
            <p class="text-sm text-gray-500">Email Address</p>
            <p class="text-xl font-semibold break-all text-gray-800 dark:text-gray-100">
               <?= htmlspecialchars($_SESSION['email']) ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Login Time Card -->
      <div class="neu-raised rounded-3xl p-8">
        <div class="flex items-center gap-4 mb-6">
          <span class="iconify text-4xl text-purple-500" data-icon="lucide:clock"></span>
          <div>
            <p class="text-sm text-gray-500">Login Time</p>
            <p class="text-xl font-medium">
              <?= date('d M, Y • h:i A', $_SESSION['login_time']) ?>
            </p>
          </div>
        </div>
      </div>

    </div>

    <!-- Additional Info / Actions -->
    <div class="mt-12 neu-raised rounded-3xl p-10">
      <h2 class="text-2xl font-semibold mb-6">What would you like to do?</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <button onclick="alert('Profile settings coming soon!')" 
                class="neu-btn neu-raised p-6 rounded-2xl text-left hover:ring-2 hover:ring-purple-400 transition-all">
          <span class="iconify text-3xl mb-3 text-purple-600" data-icon="lucide:user-cog"></span>
          <p class="font-semibold">Edit Profile</p>
          <p class="text-sm text-gray-500">Update your information</p>
        </button>
        
        <button onclick="alert('Settings panel coming soon!')" 
                class="neu-btn neu-raised p-6 rounded-2xl text-left hover:ring-2 hover:ring-purple-400 transition-all">
          <span class="iconify text-3xl mb-3 text-purple-600" data-icon="lucide:settings"></span>
          <p class="font-semibold">Settings</p>
          <p class="text-sm text-gray-500">Application preferences</p>
        </button>
      </div>
    </div>

  </div>

  <script>
    // Dark mode support
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
</body>
</html>