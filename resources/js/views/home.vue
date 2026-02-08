<template>
  <section class="max-w-3xl mx-auto pt-20 text-center space-y-6">
    <h1 class="text-4xl font-bold text-slate-800">
      Welcome to JobMatch
    </h1>

    <p class="text-lg text-slate-600">
      JobMatch helps you connect with opportunities that actually fit your skills.
      Save time, track applications, and get matched faster.
    </p>

    <p class="text-slate-500">
      To personalize your experience and keep your data secure,
      you’ll need an account.
    </p>

    <button
      @click="continueAction"
      class="mt-8 px-8 py-3 bg-blue-600 text-white rounded-lg
             hover:bg-blue-700 transition"
    >
      Get started
    </button>

    <!-- Redirect prompt -->
    <div
      v-if="showRedirectPrompt"
      class="mt-10 bg-slate-50 border border-slate-200 rounded-lg p-6"
    >
      <p class="text-slate-700 mb-4">
        You’re almost there.
        Please login or create an account to continue.
      </p>

      <div class="text-center mt-4">
        <a href="" @click.prevent="$router.push({ name: 'Login' })" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium">
          Login
        </a>
      </div>

      <div class="text-center mt-4">
        <a href="" @click.prevent="$router.push({ name: 'Register' })" class="text-sm text-blue-600 hover:text-blue-800 hover:underline font-medium">
          sign up
        </a>
      </div>
    </div>
  </section>
</template>
<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const showRedirectPrompt = ref(false)

const isAuthenticated = () => {
  return !!localStorage.getItem('token')
}

const continueAction = () => {
  if (!isAuthenticated()) {
    showRedirectPrompt.value = true
    return
  }

  router.push({ name: 'Dashboard' })
}

const goLogin = () => router.push({ name: 'Login' })
const goRegister = () => router.push({ name: 'Register' })
</script>
