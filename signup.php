<?php

session_start();

include 'db.php';

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $profile_image = '';

    if (empty($username) || empty($password) || empty($email)) {
        $error = "All fields are required!";
    
    } else {

        $query = "SELECT * FROM user WHERE username='$username' OR email='$email'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
                 $error = "Username or Email already exists!";
            } else {

            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $file = $_FILES['profile_image'];
                $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
                $max_size = 5 * 1024 * 1024; // 5MB

                if (in_array($file['type'], $allowed_types) && $file['size'] <= $max_size) {
                    $upload_dir = 'uploads/profile/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $new_file_name = $username . '_' . time() . '.' . $file_ext;
                    $target_path = $upload_dir . $new_file_name;

                    if (move_uploaded_file($file['tmp_name'], $target_path)) {
                      $profile_image = $target_path;
                    } else {
                      $error = "Failed to upload profile image!";
                    }
                } else {
                  $error = "Invalid image! Only JPG/PNG allowed (max 5MB)";
                }
            }

            // Insert Query
            if (empty($error)) {
           $insert_query = "INSERT INTO user (username, password, email, profile_image) 
                               VALUES ('$username', '$password', '$email', '$profile_image')";
                 $result = mysqli_query($conn, $insert_query);
                $success = "Signup Successful";

            }else{

                $error = "Something went wrong" . mysqli_error($conn);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Neuromorphic UI</title>
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
  </style>
</head>
<body class="text-gray-700 dark:text-gray-200 flex items-center justify-center min-h-screen">

  <div class="max-w-md w-full px-6">
    <!-- Signup Card -->
    <div class="neu-raised rounded-3xl p-10 shadow-xl">
      
      <!-- Header -->
      <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl neu-inset mb-4">
          <span class="iconify text-4xl text-purple-600" data-icon="lucide:user-plus" data-width="48"></span>
        </div>
        <h1 class="text-3xl font-semibold tracking-tight">Create Account</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">Join us today</p>
      </div>

      <?php if ($error): ?>
        <div class="mb-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm flex items-center gap-2">
          <span class="iconify" data-icon="lucide:alert-circle"></span>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="mb-6 p-4 rounded-2xl bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-sm flex items-center gap-2">
          <span class="iconify" data-icon="lucide:check-circle"></span>
          <?= $success ?>
        </div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data" class="space-y-6">
        <!-- Profile Image -->
        <div class="flex flex-col items-center mb-6">
          <div id="image-preview" class="w-14 h-14 rounded-2xl border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden mb-3">
            <span class="iconify text-5xl text-gray-400" data-icon="lucide:user"></span>
          </div>
          <label class="cursor-pointer text-purple-600 hover:text-purple-700 font-medium text-sm">
            Upload Profile Picture
            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden" onchange="previewImage(event)" required>
          </label>
          <p class="text-xs text-gray-500 mt-1">JPG, PNG (Max 5MB)</p>
        </div>
        
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
              placeholder="Choose a username"
              
            >
          </div>
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium mb-2">Email Address</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
              <span class="iconify" data-icon="lucide:mail" data-width="20"></span>
            </div>
            <input 
              type="email" 
              name="email" 
              required
              class="w-full pl-11 pr-4 py-4 rounded-2xl neu-inset focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm"
              placeholder="you@example.com"
              
            >
          </div>
        </div>

        <!-- Password -->
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
              placeholder="Create a strong password"
            >
            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
              <span class="iconify" id="eye-icon" data-icon="lucide:eye" data-width="20"></span>
            </button>
          </div>
        </div>

        <!-- Signup Button -->
        <button 
          type="submit"
          class="neu-btn w-full py-4 rounded-2xl bg-gradient-to-br from-purple-600 to-purple-700 text-white font-semibold text-base shadow-lg hover:shadow-xl transition-all"
        >
          Create Account
        </button>

      </form>

      <!-- Login Link -->
      <div class="text-center mt-8">
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Already have an account? 
          <a href="login.php" class="text-purple-600 font-medium hover:underline">Sign in</a>
        </p>
      </div>
    </div>

    <!-- Footer -->
    <p class="text-center text-xs text-gray-400 mt-8">
      © 2026 Neuromorphic UI • Secure Signup
    </p>
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById('image-preview');
      const file = event.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
        }
        reader.readAsDataURL(file);
      }
    }
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
