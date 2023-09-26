var promise;

export default class PaginateService {

    splitUrlPaginate(url){
        const page = url.split('?');
        if(page.length == 2) {
            let vars = page[1].split('&');
            let getVars = {};
            let tmp = '';
            vars.forEach(function(v) {
            tmp = v.split('=');
            if(tmp.length == 2)
                getVars[tmp[0]] = tmp[1];
            });
            return promise = getVars.page;
        }
    };
}

export const paginateService = new PaginateService();