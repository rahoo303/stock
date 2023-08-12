
<script setup>
import Sidebar from '../sidebar/index.vue'
import {onMounted, ref} from 'vue'

 
let username = ref([])
let password = ref([])

onMounted(async () => {
   
})

 
 

const submit = async() => {
    const cred = {
        email : username.value,
        password : password.value,
    }
 
    try {
    const response = await axios.post('/api/login', cred);
    localStorage.setItem('usersession', response.data.token)
    window.location="/home"
    return response.data;
  } catch (error) {
    console.error(error);
    alert(error.response.data.message);
   
   
  }
  
}

</script>
<template>
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                
                  <span class="d-none d-lg-block">Stock App</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username"  v-model="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password"  v-model="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                    
                     
                      </div>
                    </div>
                    <div class="col-12">
                      <button  @click="submit()" class="btn btn-primary w-100" type="button">Login</button>
                        <h6>Test user : </h6>
                      <label>username : admin</label><br/>
                      <label>password : admin</label>
                    </div>
                
                  </form>

                </div>
              </div>

              <div class="credits">
             
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

</template>