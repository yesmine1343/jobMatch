<!-- create job code as placeholder -->
<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center p-5">
      <div class="bg-slate-800 rounded-xl p-10 max-w-4xl w-full shadow-2xl">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-2">
          <h1 class="text-white text-2xl font-semibold">Create Job Offer</h1>
          <span class="bg-blue-600 text-white px-4 py-1.5 rounded-full text-sm">Step 2 of 3</span>
        </div>
        <p class="text-slate-400 text-sm mb-8">Define the role requirements and expectations</p>
  
        <!-- ROLE BASICS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-lg font-semibold mb-4">Role Basics</h2>
          
          <!-- Job Title -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Job Title</label>
            <input 
              v-model="formData.jobTitle" 
              type="text" 
              placeholder="e.g., Senior Frontend Developer"
              class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
            />
          </div>
  
          <!-- Department & Location -->
          <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
              <label class="block text-slate-200 text-sm font-medium mb-2.5">Department</label>
              <div class="relative">
                <select 
                  v-model="formData.department" 
                  class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 cursor-pointer appearance-none"
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
              <label class="block text-slate-200 text-sm font-medium mb-2.5">Location</label>
              <input 
                v-model="formData.location" 
                type="text" 
                placeholder="City, Country or Remote"
                class="w-full bg-slate-900 border border-slate-600 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
            </div>
          </div>
  
          <!-- Work Model -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Work Model</label>
            <div class="flex gap-3">
              <button 
                v-for="model in ['Remote', 'Hybrid', 'On-site']" 
                :key="model"
                :class="[
                  'flex-1 px-6 py-2.5 rounded-lg text-sm font-medium transition-all',
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
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Employment Type</label>
            <div class="flex flex-wrap gap-2.5">
              <button 
                v-for="type in ['Full-time', 'Part-time', 'Contract', 'Internship']" 
                :key="type"
                :class="[
                  'px-5 py-2.5 rounded-lg text-sm font-medium transition-all',
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
          <h2 class="text-slate-200 text-lg font-semibold mb-4">Experience & Compensation</h2>
          
          <!-- Experience Level -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Experience Level</label>
            <div class="flex gap-3">
              <button 
                v-for="level in ['Junior', 'Mid', 'Senior', 'Lead']" 
                :key="level"
                :class="[
                  'flex-1 px-6 py-2.5 rounded-lg text-sm font-medium transition-all',
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
            <label class="block text-slate-200 text-sm font-medium mb-3">Salary Range</label>
            <div class="space-y-4">
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-slate-400 text-xs">Minimum</span>
                  <span class="text-blue-500 text-sm font-semibold">{{ formData.salaryMin }} TND</span>
                </div>
                <input 
                  v-model.number="formData.salaryMin" 
                  type="range" 
                  min="2000" 
                  max="10000" 
                  step="500"
                  class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
                />
              </div>
              <div>
                <div class="flex justify-between mb-2">
                  <span class="text-slate-400 text-xs">Maximum</span>
                  <span class="text-blue-500 text-sm font-semibold">{{ formData.salaryMax }} TND</span>
                </div>
                <input 
                  v-model.number="formData.salaryMax" 
                  type="range" 
                  min="2000" 
                  max="10000" 
                  step="500"
                  class="w-full h-1.5 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-blue-600"
                />
              </div>
            </div>
          </div>
        </div>
  
        <!-- REQUIRED SKILLS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-lg font-semibold mb-4">Required Skills</h2>
          
          <!-- Must-Have Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Must-Have Skills</label>
            <div class="flex flex-wrap gap-2 mb-3">
              <div 
                v-for="(skill, index) in formData.mustHaveSkills" 
                :key="index"
                class="bg-slate-700 rounded-lg px-3 py-2 flex items-center gap-2"
              >
                <span class="text-white text-sm">{{ skill.name }}</span>
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
                class="flex-1 bg-slate-900 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <input 
                v-model.number="newMustHaveSkill.years" 
                type="number" 
                min="0" 
                max="20"
                placeholder="Years"
                class="w-20 bg-slate-900 border border-slate-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <select 
                v-model.number="newMustHaveSkill.weight"
                class="w-24 bg-slate-900 border border-slate-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-blue-500 appearance-none"
              >
                <option value="1">W: 1</option>
                <option value="2">W: 2</option>
                <option value="3">W: 3</option>
                <option value="4">W: 4</option>
                <option value="5">W: 5</option>
              </select>
              <button 
                @click="addMustHaveSkill"
                class="bg-blue-600 text-white px-4 rounded-lg text-sm font-medium hover:bg-blue-700 transition-all"
                type="button"
              >
                Add
              </button>
            </div>
          </div>
        </div>
  
        <!-- OPTIONAL SKILLS SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-lg font-semibold mb-4">Optional Skills</h2>
          
          <!-- Nice-to-Have Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Nice-to-Have Skills</label>
            <div class="flex flex-wrap gap-2 mb-3">
              <div 
                v-for="(skill, index) in formData.niceToHaveSkills" 
                :key="index"
                class="bg-slate-700 rounded-lg px-3 py-2 flex items-center gap-2"
              >
                <span class="text-white text-sm">{{ skill }}</span>
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
                class="flex-1 bg-slate-900 border border-slate-600 rounded-lg px-4 py-2 text-white text-sm focus:outline-none focus:border-blue-500 placeholder-slate-500"
              />
              <button 
                @click="addNiceToHaveSkill"
                class="bg-slate-700 text-white px-4 rounded-lg text-sm font-medium hover:bg-slate-600 transition-all"
                type="button"
              >
                Add
              </button>
            </div>
          </div>
        </div>
  
        <!-- CULTURE FIT SECTION -->
        <div class="mb-8">
          <h2 class="text-slate-200 text-lg font-semibold mb-4">Culture Fit</h2>
          
          <!-- Preferred Soft Skills -->
          <div class="mb-6">
            <label class="block text-slate-200 text-sm font-medium mb-2.5">Preferred Soft Skills</label>
            <div class="flex flex-wrap gap-2.5">
              <button 
                v-for="skill in ['Team Player', 'Leadership', 'Communication', 'Problem Solving', 'Adaptability', 'Creativity', 'Time Management']" 
                :key="skill"
                :class="[
                  'px-4 py-2.5 rounded-lg text-sm font-medium transition-all',
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
            class="flex-1 bg-blue-600 text-white rounded-lg px-6 py-3 text-sm font-medium hover:bg-blue-700 transition-all"
            type="button"
          >
            Continue
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
    salaryMin: 3000,
    salaryMax: 6000,
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
  
  const submit = () => {
    console.log('Job Offer:', formData);
    // Handle Laravel API call
  };
  </script>