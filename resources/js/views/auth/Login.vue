<template>
  <div class="login-container container-sm card p-4 shadow">
    <form action="/someRoute" novalidate>
      <div class="container-fluid"> 
        <div class="form-group row mb-6">
          <div class="col mb-3"> 
            <label for="email">Email address:</label>
            <input type="email" class="form-control md-6" id="email">
          </div>
        </div>
        <div class="form-group row mb-3">
          <div class="col md-6"> 
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
          </div>
        </div>
        <div class="checkbox row mb-3">
          <div class="col md-6"> 
            <label><input type="checkbox"> Remember me</label>
          </div>
        </div>
        <div class="row mb-3"> 
          <div class="col md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        <div class="row mb-6">
          <a href="/forgot-password" class="text-decoration-none small">
            Forgot password?
          </a>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const form = ref({
  username: '',
  password: '',
  remember: false
});

const handleSubmit = () => {
  // TODO: Implement login logic
  console.log('Login attempt:', form.value);
  //  Call  authentication API here
};

const handleCancel = () => {
  router.push('/');
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: left;
  align-items: center;
  min-height: 60vh;
  padding: 2rem;
  max-width: 400px;
  margin-left: 12%;
  margin-top: 4%;
}
.login-form {
  border: 3px solid #03085c;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 8px;
  max-width: 400px;
  width: 100%;
}

.container {
  padding: 16px;
}

input[type=text], 
input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  box-sizing: border-box;
  border-radius: 4px;
}

input[type=text]:focus, 
input[type=password]:focus {
  outline: none;
  border-color: #03085c;
}

button {
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 4px;
  font-size: 16px;
  font-weight: 500;
  transition: opacity 0.3s;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.footer-container {
  background-color: #f1f1f1;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

span.psw {
  float: right;
  padding-top: 16px;
}

span.psw a {
  color: #04AA6D;
  text-decoration: none;
}.footer-container {
  background-color: #f1f1f1;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

span.psw {
  float: right;
  padding-top: 16px;
}

span.psw a {
  color: #04AA6D;
  text-decoration: none;
}

span.psw a:hover {
  text-decoration: underline;
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }

  .cancelbtn {
    width: 100%;
  }

  .footer-container {
    flex-direction: column;
    gap: 10px;
  }
}
</style>

