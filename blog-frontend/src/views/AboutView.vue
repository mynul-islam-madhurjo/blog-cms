<template>
  <div class="about">
    <h1>This is an about page</h1>
  </div>
</template>

<script>
import apiClient from "../router/axios";

export default {
    data() {
        return {
            examples: [],
        };
    },
    created() {
        this.fetchExamples();
    },
    methods: {
        fetchExamples() {
            apiClient.get('/api/blog')
                .then(response => {
                    console.log(response.data);
                    this.examples = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
};


</script>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
