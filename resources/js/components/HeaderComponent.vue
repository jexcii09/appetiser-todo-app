<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown" v-if="profile">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{profile.name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/todo/archives">Archive List</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)" @click="logout()">Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" v-if="!profile">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import config from '../config.js';

export default{
    data() {
        return {
            profile: {},
            profile_local_storage: {},
            
            errors: [],

        }
    },
    mounted() {
        
     
    },
    created(){  
        this.profile_local_storage = JSON.parse(localStorage.getItem("auth"));
        if(this.profile_local_storage){
            this.checkAuth(this.profile_local_storage.api_token);  
        } else {
            this.profile = null;
        }
    },
    methods: {
        checkAuth(api_token) {
            let headers = {
                'Authorization': 'Bearer ' + api_token
            }
            axios.get(config.base_url + config.end_point.auth.user.profile, {headers: headers})
            .then((response) => {
                this.profile = response.data;
                this.profile.api_token = api_token;
            })
            .catch((error) => {
                this.profile = null;
                if(this.errors = error.response.data?.errors){
                    console.log(this.errors);
                }
            });
        },

        logout() {
            let headers = {
                'Authorization': 'Bearer ' + this.profile.api_token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
            axios.get(config.base_url + config.end_point.auth.user.logout, { headers: headers })
            .then((response) => {

                localStorage.removeItem("auth");
                window.location.href = '/login';
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