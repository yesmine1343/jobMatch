<template>
    <router-link :to="{name:'CreateJob'}" class="nav-link text-white">Create New Job ➜</router-link>
    <!--
    <router-link :to="{name:''}" class="nav-link">Job Offers</router-link>
    
    <router-link :to="{name:''}" class="nav-link">Received applications</router-link>
    
    <router-link :to="{name:''}" class="nav-link">Saved Candidates</router-link>
    
    <router-link :to="{name:''}" class="nav-link">Settings</router-link>
    -->
    </template>
    <script setup>
    import createJob from '../views/recruiter/create-job.vue';
    </script>