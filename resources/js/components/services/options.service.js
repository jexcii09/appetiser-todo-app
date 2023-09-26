import config from '../../config.js';

var promise;

const head = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
};

export default class OptionsService {
    priorityLevelList() {
        promise = axios.get(config.base_url + config.end_point.options.priority_levels, { headers: head });
        return promise;
    };

    statusesList() {
        promise = axios.get(config.base_url + config.end_point.options.statuses, { headers: head });
        return promise;
    };
}

export const optionsService = new OptionsService();