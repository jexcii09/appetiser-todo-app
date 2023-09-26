import config from '../../../config.js';
import { optionsService } from '../../services/options.service.js';
import { paginateService } from '../../services/paginate.service.js';

export default{
    data() {
        return {
            auth: {},
            data: {},
            todos: [],

            priorityLevels: [],
            statuses: [],
            
            filter: {
                paginate : 1,
                per_page: 10,
                page: 1,

                order_by: '',
                status_id: '',
                priority_level_id: '',

                keyword: '',
                filter_status_id: '',
                filter_priority_level_id: '',
            },
            headers: {},
            errors: [],

        }
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

            this.list$(this.filter);
        }

        this.priorityLevelList();
        this.statusesList();
    },
    methods: {
        async list$(filter) {
            await axios.get(config.base_url + config.end_point.todos.todo, 
            { 
                headers: this.headers, 
                params: filter,
            })
            .then((response) => {
                this.todos = response.data.data
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


        updateStatus(event, id){
            if(event.target.checked){
                this.data.status_id = 2;
            } else {
                this.data.status_id = 1;
            }
            
            axios.put(config.base_url + config.end_point.todos.updateStatus + id, this.data,
            { 
                headers: this.headers, 
            })
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

        archive(todo){
            delete todo.user;
            delete todo.priority_level;
            delete todo.status;

            var data = {
                user_id: todo.user_id,
                details: JSON.stringify(todo)
            }

            axios.post(config.base_url + config.end_point.todos.archive.store, data,{ headers: this.headers })
            .then((response) => {
                var id = response.data.data.details.id;
                axios.delete(config.base_url + config.end_point.todos.todo + '/' + id,{ headers: this.headers })
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

        // Select Options
        priorityLevelList() {
            optionsService.priorityLevelList()
            .then( (response)=> {
                this.priorityLevels = response.data.data;
            })
            .catch((error) => { console.log(error); });
        },
        statusesList() {
            optionsService.priorityLevelList()
            .then( (response)=> {
                this.statuses = response.data.data;
            })
            .catch((error) => { console.log(error); });
        },

        search(){
            this.list$(this.filter);
        },

        paginate(url){
            const page = paginateService.splitUrlPaginate(url);
            this.filter.page = page;
            this.list$(this.filter);
        },
        
        clearFilter(){
            this.filter = {
                paginate : 1,
                per_page: 10,
                page: 1,

                order_by: '',
                status_id: '',
                priority_level_id: '',

                keyword: '',
                filter_status_id: '',
                filter_priority_level_id: ''
            };

            this.list$(this.filter);
        },
    }
}