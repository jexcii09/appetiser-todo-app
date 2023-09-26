<template>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card" style="width: 40rem;">
            <div class="card-header">
                Register Account
                <a href="/login" class="link-dark float-end">&lt; Go To Login</a>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-12 pt-0">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control form-control-sm"
                        :class="{'is-invalid' : errors && errors.name}"
                         id="name" v-model="data.name" placeholder="Input Name">
                        <div v-if="errors && errors.name" class="text-danger">
                            <small v-for="(value, key) in errors.name" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" v-model="data.email" placeholder="Input Email">
                        <div v-if="errors && errors.email" class="text-danger">
                            <small v-for="(value, key) in errors.email" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" v-model="data.password" placeholder="Input Password">
                        <div v-if="errors && errors.password" class="text-danger">
                            <small v-for="(value, key) in errors.password" :key="key">* {{value}}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="button" class="btn btn-success float-end" @click="store$()">Register</button>
            </div>
        </div>
    </div>
</template>

<script>
    import config from '../../../config.js';

    export default{
        data() {
            return {
                data: {},
                errors: []
            }
        },
        created(){
            console.log(config);
        },
        methods: {
            store$() {
                axios.post(config.base_url + config.end_point.auth.register, this.data)
                .then((response) => {
                    console.log(response);
                    var toLocalStorage = response.data.data;
                    localStorage.setItem("auth", JSON.stringify(toLocalStorage));

                    window.location.href = '/todo';
                })
                .catch((error) => {
                    if(this.errors = error.response.data?.errors){
                        console.log(this.errors);
                    }
                    
                });
            },
        }
    }
</script>