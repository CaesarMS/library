<template>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" @submit.prevent="login">
					<div class="wrap-input100 validate-input" data-validate = "Email">
						<input class="input100" type="text" name="email" placeholder="Email" v-model="email">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password" v-model="password">
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        data(){
            return {
                email: null,
                password: null
            }
        },
        methods: {
            login(){
                axios.post("/api/login", {
                    email: this.email,
                    password: this.password
                    })
                    .then(response => {
                        console.log(response);
                    })
                    .catch(err=>{
                        console.log(err.response);
                    });
            }
        }
    }
</script>