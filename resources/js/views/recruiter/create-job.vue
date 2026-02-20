<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center px-6 py-8">
      <div class="bg-slate-800 rounded-2xl px-8 py-10 md:px-12 md:py-12 max-w-6xl w-full shadow-2xl">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-2">
          <h1 class="text-white text-3xl md:text-4xl font-semibold">Create Job Offer</h1>
          <span class="bg-blue-600 text-white px-4 py-2 rounded-full text-base font-semibold">Step 2 of 3</span>
        </div>
        <p class="text-slate-400 text-base md:text-lg mb-10">Define the role requirements and expectations</p>
  
        <!-- ROLE BASICS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-2xl font-semibold mb-5">Role Basics</h2>
          
          <!-- Job Title -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-2.5">Job Title</label>
            <input 
              v-model="formData.jobTitle" 
              type="text" 
              placeholder="e.g., Senior Frontend Developer"
              class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
            />
          </div>
  
          <!-- Department & Location -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
              <label class="block text-slate-200 text-base font-medium mb-2.5">Department</label>
              <div class="relative">
                <select 
                  v-model="formData.department" 
                  class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 cursor-pointer appearance-none"
                >
                  <option value="">Select department...</option>
                  <option value="engineering">Engineering</option>
                  <option value="design">Design</option>
                  <option value="product">Product</option>
                  <option value="marketing">Marketing</option>
                  <option value="sales">Sales</option>
                </select>
                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
            </div>
  
            <div>
              <label class="block text-slate-200 text-base font-medium mb-2.5">Location</label>
              <input 
                v-model="formData.location" 
                type="text" 
                placeholder="City, Country or Remote"
                class="w-full bg-slate-900 border border-slate-600 rounded-xl px-5 py-3.5 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
            </div>
          </div>
  
          <!-- Work Model -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Work Model</label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
              <button 
                v-for="model in ['Remote', 'Hybrid', 'On-site']" 
                :key="model"
                :class="[
                  'px-6 py-3 rounded-xl text-base font-medium transition-all',
                  formData.workModel === model 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
                ]"
                @click="formData.workModel = model"
                type="button"
              >
                {{ model }}
              </button>
            </div>
          </div>
  
          <!-- Employment Type -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Employment Type</label>
            <div class="flex flex-wrap gap-2.5">
              <button 
                v-for="type in ['Full-time', 'Part-time', 'Contract', 'Internship']" 
                :key="type"
                :class="[
                  'px-5 py-3 rounded-xl text-base font-medium transition-all',
                  formData.employmentTypes.includes(type)
                    ? 'bg-blue-600 text-white' 
                    : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
                ]"
                @click="toggleEmploymentType(type)"
                type="button"
              >
                {{ type }}
              </button>
            </div>
            <span class="block text-slate-500 text-xs mt-1.5">Select multiple options</span>
          </div>
        </div>
  
        <!-- EXPERIENCE & COMPENSATION SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-2xl font-semibold mb-5">Experience & Compensation</h2>
          
          <!-- Experience Level -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Experience Level</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
              <button 
                v-for="level in ['Junior', 'Mid', 'Senior', 'Lead']" 
                :key="level"
                :class="[
                  'px-6 py-3 rounded-xl text-base font-medium transition-all',
                  formData.experienceLevel === level 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
                ]"
                @click="formData.experienceLevel = level"
                type="button"
              >
                {{ level }}
              </button>
            </div>
          </div>
  
          <!-- Salary Range -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Salary Range</label>
            <input 
              v-model.number="formData.salary" 
              type="range" 
              min="500" 
              max="6000" 
              step="100"
              class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
            />
            <div class="flex justify-between items-center mt-3 text-base">
              <span class="text-slate-400">500 TND</span>
              <span class="text-blue-500 font-semibold">{{ formData.salary }} TND</span>
              <span class="text-slate-400">6000 TND</span>
            </div>
          </div>
        </div>
  
        <!-- REQUIRED SKILLS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-2xl font-semibold mb-5">Required Skills</h2>
          
          <!-- Must-Have Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Must-Have Skills</label>
            <div class="flex flex-wrap gap-2 mb-3">
              <div 
                v-for="(skill, index) in formData.mustHaveSkills" 
                :key="index"
                class="bg-slate-700 rounded-lg px-3 py-2 flex items-center gap-2"
              >
                <span class="text-white text-base">{{ skill.name }}</span>
                <span class="text-slate-400 text-xs">{{ skill.years }}y</span>
                <span class="text-slate-500 text-xs">W:{{ skill.weight }}</span>
                <button 
                  @click="removeMustHaveSkill(index)"
                  class="text-slate-400 hover:text-red-400"
                  type="button"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="flex gap-3">
              <input 
                v-model="newMustHaveSkill.name" 
                type="text" 
                placeholder="Skill name"
                class="flex-1 bg-slate-900 border border-slate-600 rounded-xl px-5 py-3 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <input 
                v-model.number="newMustHaveSkill.years" 
                type="number" 
                min="0" 
                max="20"
                placeholder="Years"
                class="w-24 bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <select 
                v-model.number="newMustHaveSkill.weight"
                class="w-28 bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white text-base focus:outline-none focus:border-blue-500 appearance-none"
              >
                <option value="1">W: 1</option>
                <option value="2">W: 2</option>
                <option value="3">W: 3</option>
                <option value="4">W: 4</option>
                <option value="5">W: 5</option>
              </select>
              <button 
                @click="addMustHaveSkill"
                class="bg-blue-600 text-white px-6 rounded-xl text-base font-semibold hover:bg-blue-700 transition-all"
                type="button"
              >
                Add
              </button>
            </div>
          </div>
        </div>
  
        <!-- OPTIONAL SKILLS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-2xl font-semibold mb-5">Optional Skills</h2>
          
          <!-- Nice-to-Have Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Nice-to-Have Skills</label>
            <div class="flex flex-wrap gap-2 mb-3">
              <div 
                v-for="(skill, index) in formData.niceToHaveSkills" 
                :key="index"
                class="bg-slate-700 rounded-lg px-3 py-2 flex items-center gap-2"
              >
                <span class="text-white text-base">{{ skill }}</span>
                <button 
                  @click="removeNiceToHaveSkill(index)"
                  class="text-slate-400 hover:text-red-400"
                  type="button"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="flex gap-3">
              <input 
                v-model="newNiceToHaveSkill" 
                type="text" 
                placeholder="Add optional skill and press Enter"
                @keyup.enter="addNiceToHaveSkill"
                class="flex-1 bg-slate-900 border border-slate-600 rounded-xl px-5 py-3 text-white text-base focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <button 
                @click="addNiceToHaveSkill"
                class="bg-slate-700 text-white px-6 rounded-xl text-base font-semibold hover:bg-slate-600 transition-all"
                type="button"
              >
                Add
              </button>
            </div>
          </div>
        </div>
  
        <!-- CULTURE FIT SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-2xl font-semibold mb-5">Culture Fit</h2>
          
          <!-- Preferred Soft Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-base font-medium mb-3">Preferred Soft Skills</label>
            <div class="flex flex-wrap gap-2.5">
              <button 
                v-for="skill in ['Team Player', 'Leadership', 'Communication', 'Problem Solving', 'Adaptability', 'Creativity', 'Time Management']" 
                :key="skill"
                :class="[
                  'px-5 py-3 rounded-xl text-base font-medium transition-all',
                  formData.softSkills.includes(skill)
                    ? 'bg-blue-600 text-white' 
                    : 'bg-slate-700 text-slate-300 hover:bg-slate-600'
                ]"
                @click="toggleSoftSkill(skill)"
                type="button"
              >
                {{ skill }}
              </button>
            </div>
            <span class="block text-slate-500 text-xs mt-1.5">Select multiple options</span>
          </div>
        </div>
  
        <!-- Action Buttons -->
        <div class="flex gap-3">
          <button 
            @click="submit"
            :disabled="isLoading"
            class="flex-1 bg-blue-600 text-white rounded-xl px-8 py-4 text-base md:text-lg font-semibold hover:bg-blue-700 disabled:bg-blue-400 disabled:cursor-not-allowed transition-all"
            type="button"
          >
            {{ isLoading ? 'Submitting...' : 'Continue' }}
          </button>
        </div>
  
      </div>
    </div>
  </template>
  
  <script setup>
  import { reactive, ref } from 'vue';
  
  const formData = reactive({
    jobTitle: '',
    department: '',
    location: '',
    workModel: 'Hybrid',
    employmentTypes: ['Full-time'],
    experienceLevel: 'Mid',
    salary: 4000,
    mustHaveSkills: [],
    niceToHaveSkills: [],
    softSkills: []
  });
  
  const newMustHaveSkill = reactive({
    name: '',
    years: 2,
    weight: 3
  });
  
  const newNiceToHaveSkill = ref('');
  const isLoading = ref(false);

  const toggleEmploymentType = (type) => {
    const index = formData.employmentTypes.indexOf(type);
    if (index > -1) {
      formData.employmentTypes.splice(index, 1);
    } else {
      formData.employmentTypes.push(type);
    }
  };
  
  const addMustHaveSkill = () => {
    if (newMustHaveSkill.name.trim()) {
      formData.mustHaveSkills.push({ ...newMustHaveSkill });
      newMustHaveSkill.name = '';
      newMustHaveSkill.years = 2;
      newMustHaveSkill.weight = 3;
    }
  };
  
  const removeMustHaveSkill = (index) => {
    formData.mustHaveSkills.splice(index, 1);
  };
  
  const addNiceToHaveSkill = () => {
    if (newNiceToHaveSkill.value.trim()) {
      formData.niceToHaveSkills.push(newNiceToHaveSkill.value.trim());
      newNiceToHaveSkill.value = '';
    }
  };
  
  const removeNiceToHaveSkill = (index) => {
    formData.niceToHaveSkills.splice(index, 1);
  };
  
  const toggleSoftSkill = (skill) => {
    const index = formData.softSkills.indexOf(skill);
    if (index > -1) {
      formData.softSkills.splice(index, 1);
    } else {
      formData.softSkills.push(skill);
    }
  };
  
  const submit = async () => {
    // Prevent multiple submissions
    if (isLoading.value) return;
    
    isLoading.value = true;
    
    try {
      // Handle Laravel API call
      // await axiosInstance.post('/api/recruiter/create-job', formData);
      
      console.log('Job Offer:', formData);
    } catch (error) {
      console.error('Error submitting job:', error);
    } finally {
      isLoading.value = false;
    }
  };
  </script>