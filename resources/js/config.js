const config = Object.freeze({
    base_url: location.origin + '/api',
    end_point: {
        auth: {
            login: '/auth/login',
            register: '/auth/register',
            user : {
                profile: '/auth/user/profile',
                logout: '/auth/user/logout',
            }
        },
        options: {
            priority_levels: '/options/priority-levels',
            statuses: '/options/statuses'
        },
        todos: {
            todo : '/todos/todo', // Resource Route
            updateStatus : '/todos/update-status/',
            
            // Todos Archive
            archive: {
                list : '/todos/archive',
                store : '/todos/archive/store',
                delete : '/todos/archive/delete/'
            }
        },
        images: '/images',
        tags: '/tags',
    }
});

export default config;
