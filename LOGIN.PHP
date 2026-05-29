<?php
session_start();
include 'db.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($username)) {
        $error = "Username required!";
    } else {
        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];
            $stored_email = $row['email'];

            if ($password === $stored_password && $email === $stored_email) {
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                $_SESSION['login_time'] = time();
                $_SESSION['email'] = $email;

                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password or email!";
            }
        } else {
            $error = "User not found!";   // 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Neuromorphic UI</title>
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
      box-shadow: inset 4px 4px 8px var(--neu-shadow-dark), inset -4px -4px 8px var(--neu-shadow-light);
    }
    .neu-btn {
      transition: all 0.2s ease;
    }
    .neu-btn:hover {
      transform: translateY(-3px);
    }
    .neu-btn:active {
      transform: translateY(1px);
    }
  </style>
</head>
<body class="text-gray-700 dark:text-gray-200 flex items-center justify-center min-h-screen">

  <div class="max-w-md w-full px-6">
    <!-- Login Card -->
    <div class="neu-raised rounded-3xl p-10 shadow-xl">
      
      <!-- Header -->
      <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl neu-inset mb-4">
          <span class="iconify text-4xl text-purple-600" data-icon="lucide:shield-check" data-width="48"></span>
        </div>
        <h1 class="text-3xl font-semibold tracking-tight">Welcome Back</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Sign in to continue</p>
      </div>

      <?php if ($error): ?>
        <div class="mb-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm flex items-center gap-2">
          <span class="iconify" data-icon="lucide:alert-circle"></span>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-6">
        
        <!-- Username -->
        <div>
          <label class="block text-sm font-medium mb-2">Username</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <span class="iconify" data-icon="lucide:user" data-width="20"></span>
            </div>
            <input 
              type="text" 
              name="username" 
              required
              class="w-full pl-11 pr-4 py-4 rounded-2xl neu-inset focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"
              placeholder="Enter your username"
              value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required
            >
          </div>
        </div>

        <!-- Password -->
       
        <div>
          <label class="block text-sm font-medium mb-2">Email</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <span class="iconify" data-icon="lucide:mail" data-width="20"></span>
            </div>
            <input 
              type="email" 
              id="email"
              name="email" 
              required
              class="w-full pl-11 pr-12 py-4 rounded-2xl neu-inset focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"
              placeholder="Enter your email"
            >
            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
              <span class="iconify" id="eye-icon" data-icon="lucide:eye" data-width="20"></span>
            </button>
          </div>
        </div>
         <div>
          <label class="block text-sm font-medium mb-2">Password</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <span class="iconify" data-icon="lucide:lock" data-width="20"></span>
            </div>
            <input 
              type="password" 
              id="password"
              name="password" 
              required
              class="w-full pl-11 pr-12 py-4 rounded-2xl neu-inset focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"
              placeholder="Enter your password"
            >
            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
              <span class="iconify" id="eye-icon" data-icon="lucide:eye" data-width="20"></span>
            </button>
          </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="w-5 h-5 accent-purple-600">
            <span class="text-sm">Remember me</span>
          </label>
          <a href="#" class="text-sm text-purple-600 hover:underline">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <button 
          type="submit"
          class="neu-btn w-full py-4 rounded-2xl bg-gradient-to-br from-purple-600 to-purple-700 text-white font-semibold text-base shadow-lg hover:shadow-xl transition-all"
        >
          Sign In
        </button>

      </form>

      <!-- Register Link -->
      <div class="text-center mt-8">
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Don't have an account? 
          <a href="signup.php" class="text-purple-600 font-medium hover:underline">Create account</a>
        </p>
      </div>
    </div>

    <!-- Footer -->
    <p class="text-center text-xs text-gray-400 mt-8">
      © 2026 Neuromorphic UI • Secure Login
    </p>
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.setAttribute('data-icon', 'lucide:eye-off');
      } else {
        passwordField.type = 'password';
        eyeIcon.setAttribute('data-icon', 'lucide:eye');
      }
    }

    // Dark mode support
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
</body>
</html>