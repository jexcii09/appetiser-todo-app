import config from '../../config.js';
import fileFormat from '../../fileFormat.js';

var promise;

const head = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
};

export default class UploadService {
    uploadFile(data, file) {
        var imageUploaded = file.files;
        var file_validator = false;

        for (var i = 0; i < imageUploaded.length; i++ ){
            fileFormat.forEach((value, key) => {
                if(imageUploaded[i].type == value){
                    file_validator = true;
                }
            });

            if(!file_validator){
                alert("Please upload valid format only.");
                file.value = null;
                data = null;
                file_validator = false;
                return;
            }
        }
        promise = imageUploaded;

        return promise;
    };

    saveImage(data, id) {
        console.log('save');
        if(!data){
            return;
        }

        for (var i = 0; i < data.length; i++ ){
            let file = data[i];
            const headers = { 'Content-Type': 'multipart/form-data' };
    
            const formData = new FormData();
            formData.append('file', file);
            formData.append('todo_id', id);
            
            axios.post(config.base_url + config.end_point.images, formData, { headers })
            .then((response) => {})
            .catch((error) => { console.log(error); });
        }
    };

    deleteImages(id) {
        axios.delete(config.base_url + config.end_point.images + '/' + id , { headers: head })
        .then((response) => {})
        .catch((error) => { console.log(error); });
    };

}

export const uploadService = new UploadService();