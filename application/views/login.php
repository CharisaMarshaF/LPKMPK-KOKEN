<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - LPK MPK KOKEN</title>
  <link rel="shortcut icon" href="<?= base_url('assets/fotobin/logo.png'); ?>" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --ungu-utama: #352C6E;
      --ungu-lembut: #eae6ff;
      --pink-sakura: #FCD1D1;
    }

    body {
      margin: 0;
      background: linear-gradient(to bottom, #f7f6ff, #e9e5fc);
      overflow-x: hidden;
      font-family: 'Nunito', sans-serif;
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cursor-glow {
      position: fixed;
      width: 100px;
      height: 100px;
      pointer-events: none;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(53, 44, 110, 0.15), transparent 80%);
      transform: translate(-50%, -50%);
      z-index: 1;
      transition: transform 0.05s ease;
    }

    .sakura {
      position: absolute;
      width: 12px;
      height: 12px;
      background: radial-gradient(circle, var(--pink-sakura) 40%, transparent 70%);
      border-radius: 50%;
      opacity: 0.7;
      animation: fall 15s linear infinite;
      z-index: 0;
    }

    @keyframes fall {
      0% {
        transform: translateY(-100px) rotate(0deg);
        opacity: 0.8;
      }
      100% {
        transform: translateY(100vh) rotate(360deg);
        opacity: 0.2;
      }
    }

    .fade-in {
      animation: fadeInUp 1s ease-out forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-card {
      background: rgba(255, 255, 255, 0.94);
      backdrop-filter: blur(10px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border-radius: 1.5rem;
    }

    .logo-ring {
      animation: pulseRing 6s ease-in-out infinite;
    }

    @keyframes pulseRing {
      0%, 100% { transform: scale(1); opacity: 0.9; }
      50% { transform: scale(1.08); opacity: 1; }
    }

    /* Responsive fix */
    @media (max-width: 640px) {
      .login-card {
        padding: 1.5rem;
        margin: 1rem;
        width: 100%;
        max-width: 90%;
      }

      .cursor-glow {
        width: 60px;
        height: 60px;
      }
    }

    @media (min-width: 641px) and (max-width: 1023px) {
      .login-card {
        max-width: 80%;
        padding: 2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Cursor Glow -->
  <div class="cursor-glow" id="cursorGlow"></div>

  <!-- Partikel Sakura -->
  <div id="sakura-container"></div>

  <!-- Login Card -->
  <div class="login-card w-full max-w-md p-8 fade-in z-10 relative">
    <div class="flex justify-center mb-6">
      <div class="relative">
        <div class="absolute w-20 h-20 bg-purple-100 rounded-full blur-2xl opacity-70 logo-ring"></div>
        <img src="<?= base_url('assets/assets/img/logo-remove.png'); ?>" alt="Logo" class="relative z-10 w-20 h-20" />
      </div>
    </div>
    <h2 class="text-2xl font-bold text-center text-[var(--ungu-utama)] mb-6">LPK MPK KOKEN</h2>
    <form action="<?= base_url('auth/login'); ?>" method="POST" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" required
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--ungu-utama)]">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" required
          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--ungu-utama)]">
      </div>
      <button type="submit"
        class="w-full bg-[var(--ungu-utama)] hover:bg-[#4b3c9c] text-white font-bold py-2 rounded-md transition transform hover:scale-105">
        Login
      </button>
    </form>
    <p class="text-xs text-center text-gray-500 mt-6">© 2025 LPK MPK KOKEN</p>
  </div>

  <!-- JS Sakura Generator -->
  <script>
    const container = document.getElementById("sakura-container");
    for (let i = 0; i < 30; i++) {
      const petal = document.createElement("div");
      petal.classList.add("sakura");
      petal.style.left = Math.random() * 100 + "vw";
      petal.style.animationDuration = 10 + Math.random() * 10 + "s";
      petal.style.opacity = 0.5 + Math.random() * 0.5;
      petal.style.width = petal.style.height = 8 + Math.random() * 10 + "px";
      container.appendChild(petal);
    }
  </script>

  <!-- JS Cursor Glow -->
  <script>
    const cursor = document.getElementById("cursorGlow");
    document.addEventListener("mousemove", (e) => {
      cursor.style.top = `${e.clientY}px`;
      cursor.style.left = `${e.clientX}px`;
    });
  </script>

</body>
</html>
