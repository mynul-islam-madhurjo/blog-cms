<template>
  <div class="container" style="margin-top: 20px;">
    <div class="text-end">
      <router-link to="/">
          <button class="btn btn-info" style="">Back</button>
        </router-link>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="mb-3">
          <label for="title" class="form-label">Title</label>

        <input type="text" class="form-control" id="title" v-model="blog.title" required>
      </div>
      <div class="mb-3">
        <label for="post" class="form-label">Post</label>
        <textarea class="form-control" id="post" v-model="blog.post" rows="5" required></textarea>
      </div>

      <div>
        <button type="submit" class="btn btn-primary">Create Post</button>
      </div>
      
    </form>
  </div>
</template>

<script>
import apiClient from '../../router/axios';
import { mapState, mapActions, mapGetters } from 'vuex';

export default {
  data() {
    return {
      blog: {
        title: '',
        post: '',
      }
    };
  },
  computed: {
    ...mapState(['userId']),
  },
  methods: {
    ...mapActions(['updateUserId']),

    onSubmit() {

     const tk = localStorage.getItem('access_ token') 
      // console.log(tk);


      const config = {
        headers: {
          'content-type': 'multipart/form-data',
          Authorization: 'Bearer ' + tk
        }
      }
      // console.log(this.userId);

      const formData = new FormData();
      formData.append("title", this.blog.title);
      formData.append("post", this.blog.post);
      formData.append("user_id", this.userId);

      apiClient.post('/api/blogs', formData, config)

        .then(response => {


          // This is for shwoing alert
          this.$toast.success(` your blog has been created`,
            {
              position: 'top-right',
              duration: 2000
            }
          );
          this.resetFields();

        })
        .catch(error => {
          // Handle error
          this.$toast.error(error);
        });
    },
    resetFields() {
      this.blog.title = '',
      this.blog.post = ''
    }
  }
}
</script>

<style lang="scss" scoped>

</style>