<?php
session_start();
include 'db.php';

// Redirect if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orex Trade - Make it Easy to Reach</title>
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
    .hero-bg {
      background-image: url('orextrade.png');
      background-size: cover;
      background-position: center;
      height: 100vh;
    }

    /* Slider Container - Fixed 3 Cards Visible */
    .slider-wrapper {
      overflow: hidden;
      border-radius: 24px;
    }
    #slider {
      display: flex;
      gap: 24px;
      transition: transform 0.6s ease-in-out;
      scrollbar-width: none;
    }
    #slider::-webkit-scrollbar {
      display: none;
    }
    .inquiry-card {
      min-width: 340px;
      transition: all 0.4s ease;
    }
    .inquiry-card:hover {
      transform: translateY(-10px);
    }
  </style>
</head>
<body class="text-gray-700 dark:text-gray-200">

  <!-- Top Navigation -->
  <nav class="neu-raised border-b sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <span class="iconify text-4xl text-purple-600" data-icon="lucide:trending-up"></span>
        <h1 class="text-3xl font-bold tracking-tight">Orex Trade</h1>
      </div>

      <div class="flex items-center gap-4">
        <a href="login.php" class="neu-btn px-8 py-3 font-medium rounded-2xl border border-gray-300 hover:border-purple-500 transition-all">
          Login
        </a>
        <a href="signup.php" class="neu-btn px-8 py-3 bg-gradient-to-br from-purple-600 to-purple-700 text-white font-semibold rounded-2xl hover:shadow-xl transition-all">
          Sign Up
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero-bg relative flex items-center justify-center text-white">
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/60 to-black/80"></div>
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
      <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-6">MAKE IT EASY TO REACH</h1>
      <p class="text-2xl md:text-3xl font-light mb-10">Trade smarter with Orex Trade</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="signup.php" class="inline-block px-10 py-4 text-xl font-semibold bg-white text-gray-900 rounded-3xl hover:scale-105 transition-transform">
          Get Started Free
        </a>
        <a href="login.php" class="inline-block px-10 py-4 text-xl font-medium border-2 border-white rounded-3xl hover:bg-white/10 transition-all">
          Login to Account
        </a>
      </div>
    </div>
  </div>

  <!-- Inquiries Section -->
  <div class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold mb-3">FORWARDING INQUIRIES LIST</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">
        Access genuine trade inquiries from trusted businesses across the globe.
      </p>
    </div>

    <div class="slider-wrapper">
      <div id="slider" class="flex gap-6">
        <!-- Card 1 -->
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">India</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">asdf</span></div>
            <div><strong>Commodity:</strong> dsaf</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">India</span></div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">test</span></div>
            <div><strong>Commodity:</strong> test</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">test</span></div>
            <div><strong>Commodity:</strong> test</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">test</span></div>
            <div><strong>Commodity:</strong> test</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">test</span></div>
            <div><strong>Commodity:</strong> test</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">19 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages<br><span class="text-gray-500">test</span></div>
            <div><strong>Commodity:</strong> test</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="inquiry-card neu-raised rounded-3xl p-7">
          <div class="flex justify-between mb-5">
            <div>
              <p class="text-sm text-gray-500">Inquiry Request</p>
              <p class="font-semibold">20 May 2026</p>
            </div>
            <span class="px-5 py-2 text-xs font-medium border border-purple-600 text-purple-600 rounded-2xl">QUOTE</span>
          </div>
          <div class="space-y-5 text-sm">
            <div><strong>from</strong> <span class="text-purple-600">Afghanistan</span></div>
            <div class="pl-5 border-l-2 border-gray-200">Containers/Boxes/Pallet/Packages</div>
            <div><strong>Commodity:</strong> A</div>
            <div><strong>Term:</strong> FOB (Free On Board)</div>
            <div><strong>to</strong> <span class="text-purple-600">Afghanistan</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <a href="#" class="inline-block px-10 py-4 border-2 border-purple-600 text-purple-600 font-medium rounded-3xl hover:bg-purple-50 transition-all">
        View All Inquiries →
      </a>
    </div>
  </div>

  <script>
    const slider = document.getElementById('slider');
    let currentIndex = 0;
    const cardWidth = 364; // card width + gap

    function slideTo(index) {
      currentIndex = index;
      slider.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    // Auto Slide
    let autoSlideInterval = setInterval(() => {
      currentIndex = (currentIndex + 1) % 3; // Only 3 cards
      slideTo(currentIndex);
    }, 2000);

    // Pause on hover
    const wrapper = document.querySelector('.slider-wrapper');
    wrapper.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
    wrapper.addEventListener('mouseleave', () => {
      autoSlideInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % 3;
        slideTo(currentIndex);
      }, 2000);
    });

    // Dark mode
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    }
  </script>
</body>
</html>