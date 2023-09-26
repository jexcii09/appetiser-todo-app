import config from '../../config.js';

var promise;

const head = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
};

export default class TagService {
    storeTag(data, id){
        if(!data){
            return;
        }

        for (var i = 0; i < data.names.length; i++){
            if(!data.names[i].id){
                var post_data = {
                    'todo_id': id,
                    'name': data.names[i].name
                };
         
                axios.post(config.base_url + config.end_point.tags, post_data, { headers: head })
                .then((response) => {})
                .catch((error) => { console.log(error); });
            }
        }
    };

    deleteTags(id) {
        axios.delete(config.base_url + config.end_point.tags + '/' + id, { headers: head})
        .then((response) => { return promise = response.data})
        .catch((error) => { console.log(error); });
    };

}

export const tagService = new TagService();