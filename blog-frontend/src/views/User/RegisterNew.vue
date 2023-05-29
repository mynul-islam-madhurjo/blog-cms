<template>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Registration Form</h2>
                    <div class="text-end">
                        <router-link to="/login"><button class="btn btn-sm btn-outline-warning">Login</button></router-link>
                     </div>

                <form @submit.prevent="save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" v-model="user.name" placeholder="User Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="user.email" placeholder="User Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="user.password" placeholder="User Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import apiClient from '../../router/axios';
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        save() {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            const formData = new FormData();
            formData.append("name", this.user.name);
            formData.append("email", this.user.email);
            formData.append("password", this.user.password);

            apiClient.post('/api/register', formData, config)
                .then(response => {
                    // This is for shwoing alert
                    this.$toast.success(this.user.name + ` your account has been registered`,
                    {
                        position: 'top-right',
                        duration: 2000
                    }
                    );
                    this.resetFields();
                })
                .catch(error => {
                    this.$toast.error(error);
                })
        },
        resetFields() {
            this.user.name = '',
            this.user.email = '',
            this.user.password = ''
        }
    }
}

</script>

<style lang="scss" scoped></style>