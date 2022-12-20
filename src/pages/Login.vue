<template>
    <div class='login-bg'>
        <div class='login'>
            <transition name='slide-fade'>
                <el-card class="box-card login-box" v-if="show" v-loading="loading">
                    <el-form @submit.prevent.native="login()" >
                        <img src="../assets/logo.png" class="img-responsive img-logo" />
                        <hr/>
                        <h5 class='card-title'>Login</h5>
                        <el-form-item label="Email" >
                            <el-input type="email"  v-model="email" placeholder='Emailul dvs'></el-input>
                        </el-form-item>
                        <el-form-item label="Parola" >
                            <el-input type="password" v-model="password" placeholder='Parola dvs'></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button  native-type='submit' type="primary" @click="login()" > Login </el-button>
                        </el-form-item>
                    </el-form>
                </el-card>
            </transition>
        </div>
    </div>
</template>

<script>
    import settings from "@/backend/LocalSettings";
    import Vue from 'vue'

    export default {
        name: "login",
        data () {
            return {
                show: false,
                loading: false,
                email: "",
                password: ""
            }
        },
        methods: {
            login: async function() {
                var response = await this.post('login', { email: this.email, password: this.password } );

                if( response.Token != '' ){
                    settings.set_token    ( response.Token    );
                    settings.set_drepturi ( response.Rights   );
                    settings.set_user_type( response.UserType );
                    this.$router.push("/dashboard");
                }else{
                    this.$message.error('Date gresite');
                }
            },
            post: async function(url, args={}){
                this.loadingVisible      = true;
                var             response = await this.$http.post(url, args );
                this.loadingVisible      = false;
                if( settings.verify_response(response) )
                {
                    return response.body;
                }
            }
        },
        mounted: function() {
            this.show   = true;
        }
    };
</script>

<style lang="less" scoped>

    .img-logo {
        max-height: 40px;
    }
    .login-box {
        margin: 50px auto;
        width: 320px;
    }

    .slide-fade-enter-active {
        transition: all 1.3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateY(250px);
        opacity: 0;
    }
</style>
