import config from '../../../config.js';
import { uploadService } from '../../services/upload.service.js';
import { tagService } from '../../services/tag.service.js';
import { optionsService } from '../../services/options.service.js';

export default{
    data() {
        return {
            auth: {},
            data: {
                status_id: 1
            },
            pathId: '',
            tag: {},
            tags: {
                id: '',
                names: []
            },
            
            priorityLevels: [],
            statuses: [],

            headers: {},
            errors: [],

            images : null,
            toDeleteImages: [],
            toDeleteTags: [],
        }
    },
    computed: {
        minDate() {
            const date = new Date();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();

            if(month.toString.length == 1){
                month = '0' + month.toString();
            }
            
            var date_format = year + "-" + month + "-" + day; //YYYY-MM-DD
            return date_format;
        },
    },
    created(){
        if(localStorage.getItem("auth")){
            this.auth = JSON.parse(localStorage.getItem("auth"));
            this.data.user_id = this.auth.id;

            this.headers = {
                'Authorization': 'Bearer ' + this.auth.api_token,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            }
        }

        var pathname = window.location.pathname;
        var pathId = parseInt(pathname.split('/')[3]);

        if( Number.isInteger(pathId) ){
            this.pathId = pathId;
            this.show$(this.pathId);
        }

        this.priorityLevelList();
        this.statusesList();
    },
    methods: {
        async store$() {
            await axios.post(config.base_url + config.end_point.todos.todo, this.data, { headers: this.headers })
            .then((response) => {
                var id = response.data.data.id;
                uploadService.saveImage(this.images, id);
                tagService.storeTag(this.tags, id);
                window.location.href = '/todo'
            })
            .catch((error) => {
                console.log(error);
                if(error.response?.status == 401){ alert(error.response.data?.message); } // Alert user unauthenticated
                if(this.errors = error.response?.data?.errors){ console.log(this.errors); }
            });
        },
        async update$() {
            await axios.put(config.base_url + config.end_point.todos.todo + '/' + this.pathId, this.data, { headers: this.headers })
            .then((response) => {
                var id = response.data.data.id;

                if(this.toDeleteImages){
                    this.toDeleteImages.forEach( (value) => { uploadService.deleteImages(value); });
                }
                if(this.toDeleteTags){
                    this.toDeleteTags.forEach( (value) => { tagService.deleteTags(value); });
                }
                if(this.images){ uploadService.saveImage(this.images, id); }
                if(this.tags.names){ tagService.storeTag(this.tags, id); }
                window.location.href = '/todo'
            })
            .catch((error) => {
                console.log(error);
                if(error.response?.status == 401) { alert(error.response.data?.message); }// Alert user unauthenticated
                if(this.errors = error.response?.data?.errors){ console.log(this.errors); }
            });
        },
        async show$(id) {
            await axios.get(config.base_url + config.end_point.todos.todo + '/' + id, { headers: this.headers })
            .then((response) => {
                this.data = response.data.data;
                this.tags.names = this.data.tags;
            })
            .catch((error) => {
                if(error.response.status == 401){ alert(error.response.data?.message); } // Alert user unauthenticated
                if(this.errors = error.response.data?.errors){ console.log(this.errors); }
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


        // Uploading File
        uploadFile() {
            this.images = uploadService.uploadFile(this.images, this.$refs.file);
        },
        removeImage(key){
            this.toDeleteImages.push(this.data.images[key].id);
            this.data.images.splice(key, 1);
        },


        // Add Tags
        addTag(){
            this.tags.names.push(this.tag);
            this.tag = {};
        },
        removeTag(key){
            if(this.tags.names[key].id){
                this.toDeleteTags.push(this.tags.names[key].id);
            }
            this.tags.names.splice(key, 1);
        },

    }
}