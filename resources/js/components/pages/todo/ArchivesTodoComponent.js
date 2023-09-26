import config from '../../../config.js';

export default{
    data() {
        return {
            auth: {},
            data: {},
            todos: [],
            
            filter: {
                paginate : 1,
                per_page: 10,
                page: 1,
                order_by: ''
            },
            headers: {},
            errors: [],

        }
    },
    mounted() {
        
     
    },
    created(){    
        if(localStorage.getItem("auth")){
            this.auth = JSON.parse(localStorage.getItem("auth"));
            this.filter.user_id = this.auth.id;
            
            this.headers = {
                'Authorization': 'Bearer ' + this.auth.api_token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }

            this.list$(this.filter, this.auth.api_token);
        }
    },
    methods: {
        async list$(filter) {
            await axios.get(config.base_url + config.end_point.todos.archive.list, 
            { 
                headers: this.headers, 
                params: filter,
            })
            .then((response) => {
                this.todos = response.data.data;
            })
            .catch((error) => {
                if(error.response.status == 401){
                    console.log(error.response.data?.message);
                } // Alert user unauthenticated

                if(this.errors = error.response.data?.errors){
                    console.log(this.errors);
                }
            });
        },



        restore(todo){
            axios.post(config.base_url + config.end_point.todos.todo, todo.details,{ headers: this.headers })
            .then((response) => {
                axios.delete(config.base_url + config.end_point.todos.archive.delete + todo.id, { headers: this.headers })
                .then((response) => {
                    this.list$(this.filter, this.auth.api_token);
                })
                .catch((error) => {
                    if(error.response.status == 401){
                        alert(error.response.data?.message);
                        location.reload();
                    } // Alert user unauthenticated
                });

            })
            .catch((error) => {
                if(error.response.status == 401){
                    alert(error.response.data?.message);
                    location.reload();
                } // Alert user unauthenticated
            });
        },

        delete$(id){
            axios.delete(config.base_url + config.end_point.todos.archive.delete + id, { headers: this.headers })
            .then((response) => {
                this.list$(this.filter, this.auth.api_token);
            })
            .catch((error) => {
                if(error.response.status == 401){
                    alert(error.response.data?.message);
                    location.reload();
                } // Alert user unauthenticated
            });
        },
    }
}