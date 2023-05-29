<template>
    <div class="login-container">
        <h2>Login</h2>
        <form @submit.prevent="login" class="login-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="email" id="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="password" id="password" required />
            </div>
            <div class="button-container">
                <button @click="login" class="btn-primary">Login</button>
                <router-link to="/register">
                    <button class="btn-secondary">Register</button>
                </router-link>

            </div>

        </form>
    </div>
</template>

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

.btn-primary,
.btn-secondary {
    background-color: #4caf50;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.btn-primary:hover,
.btn-secondary:hover {
    background-color: #45a049;
}

</style>
