<?php
session_start();
include 'db.php';

// Admin Check

// Handle Delete
if (isset($_GET['delete'])) {
    $username = mysqli_real_escape_string($conn, $_GET['delete']);
    $delete_query = "DELETE FROM user WHERE username = '$username'";
    if (mysqli_query($conn, $delete_query)) {
        $success = "User '$username' deleted successfully!";
    } else {
        $error = "Error deleting user: " . mysqli_error($conn);
    }
}

// Handle Edit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $old_username = mysqli_real_escape_string($conn, $_POST['old_username']);
    $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $update_query = "UPDATE user SET 
                    username = '$new_username', 
                    email = '$email', 
                    password = '$password' 
                    WHERE username = '$old_username'";

    if (mysqli_query($conn, $update_query)) {
        $success = "User updated successfully!";
    } else {
        $error = "Error updating user: " . mysqli_error($conn);
    }
}




// Search Functionality
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$search_condition = '';
if (!empty($search)) {
    $search_escaped = mysqli_real_escape_string($conn, $search);
    $search_condition = "WHERE username LIKE '%$search_escaped%' OR email LIKE '%$search_escaped%'";
}

$query = "SELECT username, email, password, profile_image 
          FROM user 
          $search_condition 
          ORDER BY username";
$result = mysqli_query($conn, $query);
$total_users = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Neuromorphic UI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  
  <style>
    :root { --neu-bg-primary: #e6e9ef; --neu-bg-secondary: #d1d5db; --neu-shadow-dark: #b8bcc2; --neu-shadow-light: #ffffff; }
    .dark { --neu-bg-primary: #374151; --neu-bg-secondary: #1f2937; --neu-shadow-dark: #111827; --neu-shadow-light: #4b5563; }
    body { font-family: 'Inter', system-ui, sans-serif; background: linear-gradient(145deg, var(--neu-bg-primary), var(--neu-bg-secondary)); min-height: 100vh; }
    .neu-raised { background: linear-gradient(145deg, var(--neu-bg-primary), var(--neu-bg-secondary)); box-shadow: 8px 8px 16px var(--neu-shadow-dark), -8px -8px 16px var(--neu-shadow-light); }
    .neu-inset { background: linear-gradient(145deg, var(--neu-bg-secondary), var(--neu-bg-primary)); box-shadow: inset 6px 6px 12px var(--neu-shadow-dark), inset -6px -6px 12px var(--neu-shadow-light); }
  </style>
</head>
<body class="text-gray-700 dark:text-gray-200">

  <nav class="neu-raised border-b">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
      <div class="flex items-center gap-3">
        <span class="iconify text-4xl text-red-600" data-icon="lucide:shield"></span>
        <h1 class="text-3xl font-bold tracking-tight">Admin Panel</h1>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-sm bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 px-4 py-1.5 rounded-full font-medium">
          <?= $total_users ?> Users
        </span>
        <a href="dashboard.php" class="px-5 py-2 neu-raised rounded-2xl text-sm font-medium">User View</a>
        <a href="logout.php" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-sm font-medium">Logout</a>
      </div>
    </div>
  </nav>

  <div class="max-w-7xl mx-auto px-6 py-10">

    <?php if(isset($success)): ?>
      <div class="mb-6 p-4 rounded-2xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300"><?= $success ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
      <div class="mb-6 p-4 rounded-2xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300"><?= $error ?></div>
    <?php endif; ?>

    <!-- Search Bar -->
    <div class="neu-raised rounded-3xl p-6 mb-8">
      <form method="GET" class="flex gap-4">
        <div class="flex-1 relative">
          <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400">
            <span class="iconify" data-icon="lucide:search"></span>
          </span>
          <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                 class="w-full pl-12 pr-6 py-4 neu-inset rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                 placeholder="Search by username or email...">
        </div>
        <button type="submit" class="px-8 py-4 bg-purple-600 text-white rounded-2xl font-medium neu-btn">
          Search
        </button>
        <?php if(!empty($search)): ?>
          <a href="admin.php" class="px-8 py-4 bg-gray-500 text-white rounded-2xl font-medium">Clear</a>
        <?php endif; ?>
      </form>
    </div>

    <!-- Users Table -->
    <div class="neu-raised rounded-3xl overflow-hidden">
      <div class="p-6 border-b flex justify-between items-center bg-gray-50 dark:bg-gray-800">
        <h2 class="text-2xl font-semibold">All Registered Users</h2>
        <button onclick="alert('Add New User - Coming Soon!')" 
                class="px-6 py-3 bg-purple-600 text-white rounded-2xl flex items-center gap-2">
          <span class="iconify" data-icon="lucide:user-plus"></span>
          Add User
        </button>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-gray-100 dark:bg-gray-800">
               <th class="px-6 py-5 text-center">Profile Image</th>
              <th class="px-6 py-5 text-left">Username</th>
              <th class="px-6 py-5 text-left">Email</th>
              <th class="px-6 py-5 text-left">Password</th>
              <th class="px-6 py-5 text-center">Actions</th>
            </tr>
          </thead> 
          <tbody class="divide-y">
            <?php if($total_users > 0): ?>
              <?php mysqli_data_seek($result, 0); ?>
              <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-6 py-5 text-center w-24">
                  <?php if (!empty($row['profile_image']) && file_exists($row['profile_image'])): ?>
                    <img src="<?= htmlspecialchars($row['profile_image']) ?>" alt="Profile" class="w-12 h-12 object-cover rounded-full">
                  <?php else: ?>
                    <div class="w-12 h-12 bg-purple-100 flex items-center justify-center rounded-full">
                      <span class="iconify text-purple-600" data-icon="lucide:user"></span>
                    </div>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-5 font-medium"><?= htmlspecialchars($row['username']) ?></td>
                <td class="px-6 py-5"><?= htmlspecialchars($row['email']) ?></td>
                <td class="px-6 py-5 font-mono text-red-500"><?= htmlspecialchars($row['password']) ?></td>
                <td class="px-6 py-5 text-center">
                  <button onclick="editUser('<?= htmlspecialchars($row['username']) ?>', '<?= htmlspecialchars($row['email']) ?>', '<?= htmlspecialchars($row['password']) ?>')" 
                          class="text-blue-600 hover:text-blue-700 mx-3">
                    <span class="iconify text-xl" data-icon="lucide:edit"></span>
                  </button>
                  <button onclick="if(confirm('Delete user <?= htmlspecialchars($row['username']) ?>?')) window.location='admin.php?delete=<?= urlencode($row['username']) ?>'" 
                          class="text-red-600 hover:text-red-700 mx-3">
                    <span class="iconify text-xl" data-icon="lucide:trash-2"></span>
                  </button>
                </td>
              </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">No users found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="neu-raised rounded-3xl p-8 w-full max-w-md mx-4">
      <h3 class="text-2xl font-semibold mb-6">Edit User</h3>
      <form method="POST">
        <input type="hidden" name="old_username" id="old_username">

        <div class="space-y-5">
          <div>
            <label class="block text-sm mb-2">Username</label>
            <input type="text" name="new_username" id="new_username" class="w-full neu-inset rounded-2xl p-4" required>
          </div>
          <div>
            <label class="block text-sm mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full neu-inset rounded-2xl p-4" required>
          </div>
          <div>
            <label class="block text-sm mb-2">Password</label>
            <input type="text" name="password" id="password" class="w-full neu-inset rounded-2xl p-4" required>
          </div>
        </div>

        <div class="flex gap-4 mt-8">
          <button type="submit" name="edit_user" class="flex-1 py-4 bg-purple-600 text-white rounded-2xl font-medium">Save Changes</button>
          <button type="button" onclick="closeModal()" class="flex-1 py-4 bg-gray-500 text-white rounded-2xl font-medium">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function editUser(username, email, password) {
      document.getElementById('old_username').value = username;
      document.getElementById('new_username').value = username;
      document.getElementById('email').value = email;
      document.getElementById('password').value = password;
      document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('editModal').classList.add('hidden');
    }

    // Dark mode
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
</body>
</html>