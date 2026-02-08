<!-- This root component wraps the SPA and holds the main layout + router view. -->
<template>
  <div class="app-container">
    <header class="app-header">
      <div class="container">
        <h1 class="logo">JobMatch</h1>
        <nav class="nav-links">
          <router-link to="/" class="nav-link">Home</router-link>
          <router-link to="/login" class="nav-link">Login</router-link>
          <router-link to="/register" class="nav-link">Register</router-link>
        </nav>
      </div>
    </header>

    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script setup>
// No logic yet – just the main layout shell.
</script>

<style scoped>
/* You can put global-like styles here or rely on Tailwind if enabled */
.app-container {
  min-height: 100vh;
  background-image: url('/images/bgimg.png');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  position: relative;
}

/* Dark overlay for better text readability */
.app-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(15, 23, 42, 0.85); /* Dark blue overlay */
  z-index: 0;
}

.app-header {
  position: relative;
  z-index: 10;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  padding: 1rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: #60a5fa;
  margin: 0;
}

.nav-links {
  display: flex;
  gap: 2rem;
}

.nav-link {
  color: #94a3b8;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s;
}

.nav-link:hover,
.nav-link.router-link-active {
  color: #60a5fa;
}

.main-content {
  position: relative;
  z-index: 10;
  padding: 2rem;
}
</style>
