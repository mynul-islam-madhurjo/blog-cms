<template>
  <div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-lg-4">
          <h2 class="mb-3">Login Form</h2>
         
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                class="form-control"
                placeholder="Enter your username"
                v-model="credential.email"
              />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Enter your password"
                v-model="credential.password"
              />
            </div>
            <div class="mb-3">
              <button @click="loginSubmit" class="btn btn-primary">Login</button>
            </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import apiClient from '../../router/axios';
import { mapState, mapActions } from 'vuex';

export default {
  name: 'Login',
  data() {
    return {
      credential: {
        email: '',
        password: '',

      }
    }
  },
  computed: {
    ...mapState(['userId']),
  },
  methods: {

    ...mapActions(['updateUserId']),

    loginSubmit() {
      // console.log(this.credential);
      apiClient.post('/api/login', this.credential)
        .then(response => {
          // console.log(response.data);
          const userId = response.data.data.id;
          console.log(userId);
          this.updateUserId(userId);
          localStorage.setItem('access_token', response.data.data.access_token)
          this.$router.push('/');
          // alert('In Home Page');
        })
        .catch(error => {
          console.log(error);
        })
    }
  }
};


</script>

<style lang="scss" scoped></style>
