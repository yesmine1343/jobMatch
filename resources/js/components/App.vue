<!-- This root component wraps the SPA and holds the main layout + router view. -->
<template>
  <div class="app-container">
    <header class="app-header">
      <div class="container">
        <!-- Logo routes to home -->
        <router-link to="/" class="logo-link">
          <h1 class="logo">JobMatch</h1>
        </router-link>
        
        <nav class="nav-links">
          <!-- NOT logged in: Show Login & Register -->
          <template v-if="!isAuthenticated">
            <router-link to="/login" class="nav-link">Login</router-link>
            <router-link to="/register" class="nav-link">Register</router-link>
          </template>

          <!-- Logged in: Show Go Back & Logout -->
          <template v-else>
            <a href="#" class="nav-link" @click.prevent="goBack">← Go Back</a>
            <a href="#" class="nav-link" @click.prevent="handleLogout">Logout</a>
          </template>
        </nav>
      </div>
    </header>

    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>


<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axiosInstance from '../api/axios';

const router = useRouter();
const route = useRoute();
const isAuthenticated = ref(false);

const checkAuth = () => {
  isAuthenticated.value = !!localStorage.getItem('token');
};

onMounted(() => {
  checkAuth();
});

// Watch for route changes to update auth status (e.g., after login/logout)
watch(() => route.path, () => {
  checkAuth();
});

const goBack = () => {
  router.go(-1); // Go to previous page
};

const handleLogout = async () => {
  try {
    const token = localStorage.getItem('token');
    if (token) {
      await axiosInstance.post('/api/auth/logout', {}, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
    }
  } catch (error) {
    console.error('Logout error:', error);
  } finally {
    localStorage.removeItem('token');
    isAuthenticated.value = false;
    router.push({ name: 'login' });
  }
};
</script>

<style scoped>

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

.logo-link {
  text-decoration: none;
}

.logo {
  font-size: 1.5rem;
  font-weight: bold;
  color: #60a5fa;
  margin: 0;
  cursor: pointer;
}

.logo:hover {
  color: #3b82f6;
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
  cursor: pointer;
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