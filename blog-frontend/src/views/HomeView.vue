<template>
  <div>
    <h1>Home</h1>
    <div style="text-align: right; padding-right: 20px;">
    <button class="btn btn-danger" @click="logout">Logout</button>
    <router-link to="/blog">
      <button class="btn btn-info" @click="createBlog" style="margin-left: 10px;">Create Blog</button>
    </router-link>
    
  </div>

  </div>
</template>

<script>
export default {
  methods: {
    logout() {
      // apiClient.post('/api/v1/logout', null, {
      //   headers: {
      //     Authorization: 'Bearer ' + token
      //     // Authorization: `Bearer ${token}`
      //   },
      // })
      //   .then(response => {
      //     // console.log(response);
      //     localStorage.removeItem('access_token'); // Remove the token from local storage
      //     this.isLoggedIn = false;
      //     this.$router.push('/login')
      //     this.alertToast(response.data.message)
      //   })
      //   .catch(error => {
      //     console.log(error);
      //   });
      // }
    },
  },
};
</script>

<style lang="scss" scoped></style>
