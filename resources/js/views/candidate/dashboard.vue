<template>
    <div class="bg-slate-800 rounded-xl p-6 border border-slate-700">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-white">Profile Completion</h3>
        <span class="text-blue-400 text-2xl font-bold">40%</span>
      </div>
      
      <!-- Progress Bar -->
      <div class="w-full bg-slate-700 rounded-full h-3 mb-6">
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full" 
             style="width: 40%">
        </div>
      </div>
  
      <!-- Steps -->
      <div class="grid grid-cols-3 gap-4">
        <!-- Step 1: Complete -->
        <div class="text-center">
          <div class="w-12 h-12 mx-auto bg-green-500 rounded-full flex items-center justify-center mb-2">
            <svg class="w-6 h-6 text-white"><!-- checkmark icon --></svg>
          </div>
          <p class="text-sm text-slate-300 font-medium">Basic Info</p>
          <p class="text-xs text-green-400">Complete</p>
        </div>
  
        <!-- Step 2: In Progress -->
        <div class="text-center">
          <div class="w-12 h-12 mx-auto bg-yellow-500 rounded-full flex items-center justify-center mb-2">
            <svg class="w-6 h-6 text-white"><!-- clock icon --></svg>
          </div>
          <p class="text-sm text-slate-300 font-medium">Skills</p>
          <p class="text-xs text-yellow-400">2 added</p>
        </div>
  
        <!-- Step 3: Not Started -->
        <div class="text-center">
          <div class="w-12 h-12 mx-auto bg-slate-600 rounded-full flex items-center justify-center mb-2">
            <svg class="w-6 h-6 text-slate-400"><!-- document icon --></svg>
          </div>
          <p class="text-sm text-slate-300 font-medium">Resume</p>
          <p class="text-xs text-slate-400">Not started</p>
        </div>
      </div>
    </div>
  <div class="bg-slate-800 rounded-xl p-12 border border-slate-700 text-center">
    <!-- Illustration/Icon -->
    <div class="w-32 h-32 mx-auto mb-6 bg-slate-700 rounded-full flex items-center justify-center">
      <svg class="w-16 h-16 text-slate-500">
        <!-- briefcase or search icon -->
      </svg>
    </div>

    <!-- Message -->
    <h3 class="text-2xl font-bold text-white mb-3">
      No Jobs Yet
    </h3>
    <p class="text-slate-400 mb-6 max-w-md mx-auto">
      Add your skills to see which jobs you match. Our AI will show you opportunities that fit your profile.
    </p>

    <!-- CTA Button -->
    <button class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
      + Add Skills Now
    </button>
  </div>
</template>