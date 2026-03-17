<template>
  <section class="max-w-6xl mx-auto pt-20 pb-12 px-4">
    <div class="text-center space-y-6">
      <h1 class="text-5xl font-bold text-sky-400">
        Welcome to JobMatch {{ username ? username : '' }}!
      </h1>
      
      <h2 class="text-2xl font-semibold text-white">
        The smarter way to match jobs & talents
      </h2>

      <p class="text-lg text-slate-300 max-w-3xl mx-auto leading-relaxed">
        AI-powered skill gap analysis shows you what to learn to unlock more opportunities.
        <br>
        Intelligent candidate matching algorithm to save recruiters hours of evaluation time.
      </p>

      <div class="pt-6">
        <button
          @click="handleGetStarted"
          class="px-10 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg
                 hover:bg-blue-700 transform hover:scale-105 transition-all duration-200
                 shadow-lg hover:shadow-xl"
        >
          Get Started →
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useRouter } from 'vue-router';
import axiosInstance from '../api/axios.js';
import { ref,onMounted } from 'vue';

const router = useRouter();
const username = ref(''); // Placeholder for username, will be populated on mount

onMounted(() => {
  fetchUsername();
});

  const fetchUsername = () => {
    axiosInstance.get('/api/user/username')
      .then(response => {
        username.value = response.data.username;
      })
      .catch(error => {
        console.error("Error fetching username:", error);
      });
  }

  const handleGetStarted = async () => {

    const token = localStorage.getItem('token');
    
    if (!token) {
      // Not logged in, go to login
      router.push({ name: 'login' });
      return;
    }
    
    const user = JSON.parse(localStorage.getItem('user'));
    
    console.log('🔍 DEBUG handleGetStarted:', {
      user: user,
      active_role: user?.active_role,
      hasRole: !!user?.active_role
    });

    if (!user || !user.active_role) {
      // No role selected yet, go to role selection
      console.log('✅ Redirecting to RoleSelection');
      router.push({ name: 'RoleSelection' });
    } else if (user.active_role === 'candidate') {
      // Fetch candidate profile from database to check if setup is complete
      try {
        const { data: candidateProfile } = await axiosInstance.get('/api/user/candidate-profile');
        
        // Check if work_type field is null (profile incomplete)
        if (!candidateProfile || !candidateProfile.work_type) {
          router.push({ name: 'candidateProfileSetup' });
        } else {
          // Profile is complete, go to dashboard
          router.push({ name: 'Cdashboard' });
        }
      } catch (error) {
        console.error('Error fetching candidate profile:', error);
        router.push({ name: 'candidateProfileSetup' });
      }
    } else if (user.active_role === 'recruiter') {
      // Fetch recruiter profile from database to check if setup is complete
      try {
        const { data: recruiterProfile } = await axiosInstance.get('/api/user/recruiter-profile');
        
        // Check if company_name field is null (profile incomplete)
        if (!recruiterProfile || !recruiterProfile.company_name) {
          router.push({ name: 'recruiterProfileSetup' });
        } else {
          // Profile is complete, go to dashboard
          router.push({ name: 'Rdashboard' });
        }
      } catch (error) {
        console.error('Error fetching recruiter profile:', error);
        router.push({ name: 'recruiterProfileSetup' });
      }
    }
    };
</script>