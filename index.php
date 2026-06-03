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


    @import url(https://fonts.googleapis.com/css2?family=Limelight&display=swap);



.title {
    font-family: "Limelight", sans-serif;
    font-weight: 400;
    position: fixed;
    right: 40px;
    top: 40px;
    z-index: 10;
    padding: 8px;
    border-radius: 8px;
    opacity: .85;
    font-size: 10vw;
    color: #fff;
    pointer-events: none
}

.sub-title {
    position: fixed;
    font-family: "Limelight", sans-serif;
    font-weight: 200;
    bottom: 100px;
    left: 40px;
    z-index: 10;
    padding: 8px;
    border-radius: 8px;
    opacity: .85;
    font-size: 3vw;
    color: #fff;
    pointer-events: none
}

.hint {
    position: fixed;
    left: 12px;
    bottom: 12px;
    z-index: 10;
    background: rgb(0 0 0 / .8);
    padding: 8px;
    border-radius: 8px;
    opacity: .85;
    font-size: 13px;
    color: #fff;
    pointer-events: none
}

.hint a {
    color: tomato;
    text-decoration: none;
    pointer-events: auto
}

.copy {
    position: fixed;
    bottom: 20px;
    right: 20px;
    color: #000;
    background: rgb(255 255 255 / .9);
    padding: 10px;
    border-radius: 5px;
    font-size: 12px;
    z-index: 100;
    pointer-events: none
}

.page-wrapper {
    width: 100%;
    margin: 0 auto;
    position: relative
}

.gallery-container {
    display: flex;
    overflow-x: hidden;
    padding: 20px;
    gap: 15px;
    scroll-behavior: auto
}

.gallery-item {
    position: relative;
    flex: 0 0 600px;
    height: 400px;
    border-radius: 10px;
    overflow: hidden;
    will-change: transform
}

.gallery-item img {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 130%;
    height: 100%;
    object-fit: cover;
    transform: translate(-50%, -50%);
    will-change: transform
}

@media (max-width:1024px) {
    .gallery-item {
        flex: 0 0 250px;
        height: 170px
    }
}

@media (max-width:768px) {
    .gallery-item {
        flex: 0 0 200px;
        height: 140px
    }
}

@media (max-width:480px) {
    .gallery-item {
        flex: 0 0 160px;
        height: 120px
    }
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

  
<div class="page-wrapper">
    <div class="gallery-container" id="gallery"></div>
</div>
<div id="ui" class="hint"><a href="https://unsplash.com/fr/@the_ova?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" target="_blank" rel="noopener nofollow">Vitaly Otinov</a> on <a href="https://unsplash.com/fr/@the_ova?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" target="_blank" rel="noopener nofollow">Unsplash</a></div>



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

    // js for parallax effect
    const gallery = document.getElementById('gallery');
const originalImages = [

    // Massive Cargo Ship
    "https://images.unsplash.com/photo-1518546305927-5a555bb7020d?auto=format&fit=crop&w=2000&q=90",

    // Container Shipping Port
    "https://images.unsplash.com/photo-1494412519320-aa613dfb7738?auto=format&fit=crop&w=2000&q=90",

    // Road Transport Truck
    "https://images.unsplash.com/photo-1519003722824-194d4455a60c?auto=format&fit=crop&w=2000&q=90",

    // Air Cargo Logistics
    "https://images.unsplash.com/photo-1530521954074-e64f6810b32d?auto=format&fit=crop&w=2000&q=90",

    // Warehouse Storage
    "https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=90",

    // Shipping Containers
    "https://images.unsplash.com/photo-1483729558449-99ef09a8c325?auto=format&fit=crop&w=2000&q=90",

    // Import Export Business
    "https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=2000&q=90",

    // Cargo Handling Operations
    "https://images.unsplash.com/photo-1494412651409-8963ce7935a7?auto=format&fit=crop&w=2000&q=90",

    // Global Freight Transport
    "https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=2000&q=90",

    // Dockyard Cranes
    "https://images.unsplash.com/photo-1483721310020-03333e577078?auto=format&fit=crop&w=2000&q=90",

    // Logistics Control Office
    "https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=2000&q=90",

    // Cargo Loading Yard
    "https://images.unsplash.com/photo-1508830524289-0adcbe822b40?auto=format&fit=crop&w=2000&q=90",

    // Highway Freight Transport
    "https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=2000&q=90",

    // Airway Cargo Shipping
    "https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=2000&q=90",

    // Shipping Yard Containers
    "https://images.unsplash.com/photo-1516542076529-1ea3854896f2?auto=format&fit=crop&w=2000&q=90",

    // Industrial Warehouse
    "https://images.unsplash.com/photo-1565793298595-6a879b1d9492?auto=format&fit=crop&w=2000&q=90",

    // Sea Freight Logistics
    "https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=2000&q=90",

    // Delivery Transport Truck
    "https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=2000&q=90",

    // Cargo Terminal Operations
    "https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=2000&q=90",

    // International Trade Shipping
    "https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=2000&q=90"

];


function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

shuffleArray(originalImages);
const SNAP_ENABLED = !0;
const SNAP_DELAY = 300;
const SNAP_STRENGTH = 0.08;
const INERTIA_DAMPING = 0.92;
const PARALLAX_STRENGTH = 0.15;
const SCROLL_SMOOTHING = 0.15;
const AUTO_SCROLL_SPEED = 95 / 60;
const cloneCount = 3;
let allItems = [];

function buildInfiniteGallery() {
    gallery.innerHTML = '';
    allItems = [];
    for (let c = 0; c < cloneCount; c++) {
        originalImages.forEach((src, index) => {
            const item = document.createElement('div');
            item.className = 'gallery-item';
            const img = document.createElement('img');
            img.src = src;
            img.alt = `Image ${index + 1}`;
            img.loading = 'eager';
            item.appendChild(img);
            gallery.appendChild(item);
            allItems.push(item)
        })
    }
}
buildInfiniteGallery();
let targetScroll = 0;
let currentScroll = 0;
let velocity = 0;
let snapTimeout = null;
let isLooping = !1;
let animationId = null;
const items = Array.from(document.querySelectorAll('.gallery-item'));
const images = items.map(item => item.querySelector('img'));
let cachedContainerCenter = window.innerWidth / 2;
let cachedItemsCenters = new Array(items.length);
let cachedItemsBounds = new Array(items.length);
const originalSetSize = originalImages.length;
const totalItems = items.length;

function updateItemsCenters() {
    const rects = gallery.getBoundingClientRect();
    for (let i = 0; i < items.length; i++) {
        const rect = items[i].getBoundingClientRect();
        cachedItemsCenters[i] = rect.left + rect.width / 2;
        cachedItemsBounds[i] = rect
    }
}

function handleInfiniteScroll() {
    if (isLooping) return;
    const maxScroll = gallery.scrollWidth - gallery.clientWidth;
    const setWidth = getOriginalSetWidth();
    const threshold = setWidth * 0.3;
    if (targetScroll > maxScroll - threshold && !isLooping) {
        isLooping = !0;
        const newScroll = targetScroll - setWidth;
        targetScroll = newScroll;
        currentScroll = newScroll;
        gallery.scrollLeft = currentScroll;
        requestAnimationFrame(() => {
            isLooping = !1
        })
    } else if (targetScroll < threshold && !isLooping) {
        isLooping = !0;
        const newScroll = targetScroll + setWidth;
        targetScroll = newScroll;
        currentScroll = newScroll;
        gallery.scrollLeft = currentScroll;
        requestAnimationFrame(() => {
            isLooping = !1
        })
    }
}

function getOriginalSetWidth() {
    if (items.length === 0) return 0;
    let firstItemRect = items[0].getBoundingClientRect();
    let lastItemRect = items[originalSetSize - 1].getBoundingClientRect();
    return (lastItemRect.right - firstItemRect.left) + 15
}

function lerp(start, end, amt) {
    return start + (end - start) * amt
}
console.log("&Toc on codepen - https://codepen.io/ol-ivier");

function triggerSnap() {
    if (!SNAP_ENABLED) return;
    clearTimeout(snapTimeout);
    snapTimeout = setTimeout(() => {
        if (Math.abs(velocity) > 0.5) return;
        updateItemsCenters();
        const containerCenter = window.innerWidth / 2;
        let closest = 0;
        let minDist = Infinity;
        for (let i = 0; i < items.length; i++) {
            const dist = Math.abs(containerCenter - cachedItemsCenters[i]);
            if (dist < minDist) {
                minDist = dist;
                closest = i
            }
        }
        const targetItem = items[closest];
        const rect = targetItem.getBoundingClientRect();
        const targetPosition = targetScroll + (rect.left + rect.width / 2 - containerCenter);
        const maxScroll = gallery.scrollWidth - gallery.clientWidth;
        let newTarget = Math.max(0, Math.min(targetPosition, maxScroll));
        const snapVelocity = (newTarget - targetScroll) * SNAP_STRENGTH;
        velocity += snapVelocity
    }, SNAP_DELAY)
}

function resetSnap() {
    clearTimeout(snapTimeout);
    if (SNAP_ENABLED) {
        snapTimeout = setTimeout(triggerSnap, SNAP_DELAY)
    }
}
let lastWheelTime = 0;
let wheelDelta = 0;
gallery.addEventListener('wheel', e => {
    e.preventDefault();
    const now = Date.now();
    if (now - lastWheelTime < 16) return;
    lastWheelTime = now;
    wheelDelta = e.deltaY;
    let normalizedDelta = wheelDelta;
    if (Math.abs(wheelDelta) > 100) normalizedDelta = wheelDelta * 0.5;
    if (Math.abs(wheelDelta) < 20) normalizedDelta = wheelDelta * 1.5;
    velocity += normalizedDelta * 0.6;
    resetSnap()
}, {
    passive: false
});
let isDragging = !1;
let startX = 0;
let startScroll = 0;
let lastMoveX = 0;
let lastMoveTime = 0;
gallery.addEventListener('pointerdown', e => {
    isDragging = !0;
    startX = e.clientX;
    startScroll = targetScroll;
    lastMoveX = e.clientX;
    lastMoveTime = Date.now();
    velocity = 0;
    clearTimeout(snapTimeout);
    gallery.style.cursor = 'grabbing'
});
gallery.addEventListener('pointermove', e => {
    if (!isDragging) return;
    e.preventDefault();
    const now = Date.now();
    const dx = startX - e.clientX;
    let newScroll = startScroll + dx;
    const maxScroll = gallery.scrollWidth - gallery.clientWidth;
    newScroll = Math.max(0, Math.min(newScroll, maxScroll));
    targetScroll = newScroll;
    currentScroll = newScroll;
    gallery.scrollLeft = currentScroll;
    const timeDiff = now - lastMoveTime;
    if (timeDiff > 0 && timeDiff < 100) {
        const moveDelta = lastMoveX - e.clientX;
        velocity = moveDelta / timeDiff * 8
    }
    lastMoveX = e.clientX;
    lastMoveTime = now
});
gallery.addEventListener('pointerup', () => {
    isDragging = !1;
    gallery.style.cursor = 'grab';
    triggerSnap()
});
gallery.addEventListener('pointerleave', () => {
    if (isDragging) {
        isDragging = !1;
        gallery.style.cursor = 'grab';
        triggerSnap()
    }
});
gallery.style.cursor = 'grab';
let lastTimestamp = 0;
let offsets = new Array(images.length).fill(0);
let frameCount = 0;

function animate(timestamp) {
    if (timestamp - lastTimestamp > 100) {
        cachedContainerCenter = window.innerWidth / 2; 
        lastTimestamp = timestamp
    }
    if (!isDragging) {
        targetScroll += AUTO_SCROLL_SPEED;
        targetScroll += velocity;
        velocity *= INERTIA_DAMPING;
        if (Math.abs(velocity) < 0.05) velocity = 0
    }
    const maxScroll = gallery.scrollWidth - gallery.clientWidth;
    targetScroll = Math.max(0, Math.min(targetScroll, maxScroll));
    handleInfiniteScroll();
    currentScroll = lerp(currentScroll, targetScroll, SCROLL_SMOOTHING);
    gallery.scrollLeft = currentScroll;
    updateItemsCenters();
    for (let i = 0; i < images.length; i++) {
        let offset = (cachedContainerCenter - cachedItemsCenters[i]) / 6;
        offset = Math.max(-80, Math.min(80, offset));
        offsets[i] = lerp(offsets[i], offset, 0.12);
        images[i].style.transform = `translate(calc(-50% + ${offsets[i].toFixed(1)}px), -50%)`
    }
    frameCount++;
    animationId = requestAnimationFrame(animate)
}
updateItemsCenters();
cachedContainerCenter = window.innerWidth / 2;
animate();
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        cachedContainerCenter = window.innerWidth / 2;
        updateItemsCenters();
        const maxScroll = gallery.scrollWidth - gallery.clientWidth;
        targetScroll = Math.max(0, Math.min(targetScroll, maxScroll));
        currentScroll = targetScroll;
        gallery.scrollLeft = currentScroll
    }, 100)
});

function preloadImages() {
    originalImages.forEach(src => {
        const img = new Image();
        img.src = src
    })
}
preloadImages()
  </script>
</body>
</html>