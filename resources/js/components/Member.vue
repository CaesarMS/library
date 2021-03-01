<template>
    <div class="limiter">
		<div class="container-login100">
        
            <img src="login/images/logo.png" alt="" style="position: absolute; top: 8vh; left: 8vh;">
            
            <form class="login100-form validate-form p-t-30 p-b-50" @submit.prevent="login">
			    <div class="wrap-login100 p-b-33 p-t-5">
				
                    <span class="login100-form-title p-b-41 m-l-75 m-t-30" style="font-size: 28px;">
                        Login
                    </span>
					<div class="wrap-input100 validate-input" data-validate = "Email" :class={noPass:noEmail}>
						<input class="input100" type="text" name="email" placeholder="Email" v-model="email">
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password" :class={noPass:noPass}>
						<input class="input100" type="password" name="password" placeholder="Password" v-model="password">
					</div>
                    <div class="login100-form-title p-b-10 m-t-10" style="text-align: right">
                        <span style="font-size: 12px; cursor: pointer; position: relative;" class="m-r-20" id="forgot">
                            I forgot my password
                        </span>
                    </div>
                    <div class="login100-form-title p-b-10 m-t-10" style="text-align: center; font-size: null;" v-if="failed">
                        <span style="font-size: 12px; cursor: pointer; position: relative; color: #ED3D3D">
                            Email or password are incorrect, or verify your<br>email first if you just registered your account.
                        </span>
                    </div>
					<div class="login100-form-title p-b-10 m-t-10" style="text-align: center; font-size: null;" v-if="noPassStatus">
                        <span style="font-size: 12px; cursor: pointer; position: relative; color: #ED3D3D">
                            Please input your password first to login into <br> your account.
                        </span>
                    </div>
			    </div>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                <div>
                    <div class="login100-form-title m-t-10" style="text-align: center">
                        <span style="font-size: 12px; color: #777777; font-family: Sans-serif; font-weight: bold">
                            I don't have Stendard account
                        </span>
                    </div>
                    <div class="login100-form-title p-t-1" style="text-align: center">
                        <span style="font-family: Sans-serif; font-weight: bold; font-size: 15px; cursor: pointer;" id="signup">
                            Sign Me Up!
                        </span>
                    </div>
                </div>
                
            </form>
            <img src="login/images/people.png" alt="" style="position: absolute; bottom: 0; left: 0;">
		</div>
	</div>
</template>

<script>
    export default {
        data(){
            return {
                failed: false,
                noPass: false,
                noEmail: false,
                noPassStatus: false,
                email: null,
                password: null
            }
        },
        methods: {
            login(){
                this.failed= false;
                this.noPass= false;
                this.noEmail= false;
                this.noPassStatus= false;
                if(this.password === '' || this.password === null){
                    this.noPass= true;
                    this.noPassStatus=true;
               } else{
                    axios.post("/api/login", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        window.location.href = '/';
                        console.log(response);
                    })
                    .catch(err=>{
                        this.failed= true;
                        this.noPass= true;
                        this.noEmail= true;
                        console.log(err.response);
                    });
                }

                
            }
        }
    }
</script>

<style>
    .noPass{
        border-bottom: 1px solid #ED3D3D !important;
    }
    #forgot:hover, #signup:hover{
        color: #555555;
    }
    .container-login100::before {
        background-color: transparent !important;
    }
    .login100-form {
        width: 390px;
        z-index: 1;
    }
    .wrap-login100{
        width: 100%;
        outline: none;
        border-color: #9ecaed;
        box-shadow: 0 0 20px 10px #9ecaed;
    }
    .login100-form-btn {
        min-width: 390px;
        max-width: 390px;
        height: 60px;
        border-radius: 11px;
    }
    .login100-form-btn::before {
        border-radius: 11px;
    }

</style>