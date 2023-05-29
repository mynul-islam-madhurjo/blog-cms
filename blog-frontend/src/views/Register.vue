<template>
    <div class="login-container">
        <h2>Registration</h2>
       
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="user.email" id="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="user.password" id="password" required />
            </div>
            <div class="button-container">
                <button @click="register" class="btn-secondary">Register</button>
            </div>

        
    </div>
</template>
<script>
import apiClient from "../router/axios/index.js";

export default {
  data() {
    return {
      user: {
        email: "admin@gmail.com",
        password: "12345"
      },
    };
  },

  
  methods: {

    
    register() {
      // console.log(this.user);
      try {
        // console.log(this.user);

        apiClient.post('/api/register', this.user)
          .then((response) => {
            console.log(response.data); // Remove the quotation marks
          })
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>



<style scoped>
.login-container {
    max-width: 600px !important;
    margin-top: 200px !important;
    margin: 0 auto;
    padding: 20px;

    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f7f7f7;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

h2 {
    text-align: center;
}

.login-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 10px;
}

label {
    font-weight: bold;
}


input[type="password"] {
    padding: 8px;
    border: 1px solid #ccc;
    margin-left: 10px !important;
    border-radius: 3px;
}
input[type="email"] {
    padding: 8px;
    border: 1px solid #ccc;
    margin-left: 35px !important;
    border-radius: 3px;
}
.button-container {
    display: flex;
    gap: 10px;
    margin: 0 auto;
}

.btn-secondary {
    background-color: #4caf50;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.btn-secondary:hover {
    background-color: #45a049;
}

</style>
