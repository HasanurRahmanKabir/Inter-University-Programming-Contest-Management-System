import { queryParams, type RouteDefinition, type RouteFormDefinition, type RouteQueryOptions } from './../wayfinder';

/**
 * @route '/'
 */
export const home = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: home.url(options),
    method: 'get',
});

home.definition = {
    methods: ["get", "head"],
    url: '/',
} satisfies RouteDefinition<["get", "head"]>;

home.url = (options?: RouteQueryOptions) => {
    return home.definition.url + queryParams(options);
};

/**
 * @route '/settings/appearance'
 */
export const appearance = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: appearance.url(options),
    method: 'get',
});

appearance.definition = {
    methods: ["get", "head"],
    url: '/settings/appearance',
} satisfies RouteDefinition<["get", "head"]>;

appearance.url = (options?: RouteQueryOptions) => {
    return appearance.definition.url + queryParams(options);
};

/**
 * @route '/forgot-password'
 */
export const forgotPassword = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: forgotPassword.url(options),
    method: 'get',
});

forgotPassword.definition = {
    methods: ["get", "head", "post"],
    url: '/forgot-password',
} satisfies RouteDefinition<["get", "head", "post"]>;

forgotPassword.url = (options?: RouteQueryOptions) => {
    return forgotPassword.definition.url + queryParams(options);
};

forgotPassword.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: forgotPassword.url(options),
    method: 'post',
});

/**
 * @route '/confirm-password'
 * নতুন যোগ করা হয়েছে যাতে ইম্পোর্ট এরর না আসে
 */
export const confirmPassword = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: confirmPassword.url(options),
    method: 'get',
});

confirmPassword.definition = {
    methods: ["get", "head", "post"],
    url: '/confirm-password',
} satisfies RouteDefinition<["get", "head", "post"]>;

confirmPassword.url = (options?: RouteQueryOptions) => {
    return confirmPassword.definition.url + queryParams(options);
};

confirmPassword.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: confirmPassword.url(options),
    method: 'post',
});

/**
 * @route '/reset-password'
 */
export const resetPassword = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: resetPassword.url(options),
    method: 'get',
});

resetPassword.definition = {
    methods: ["get", "head", "post"],
    url: '/reset-password',
} satisfies RouteDefinition<["get", "head", "post"]>;

resetPassword.url = (options?: RouteQueryOptions) => {
    return resetPassword.definition.url + queryParams(options);
};

resetPassword.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: resetPassword.url(options),
    method: 'post',
});

/**
 * @route '/login'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
});

login.definition = {
    methods: ["get", "head", "post"],
    url: '/login',
} satisfies RouteDefinition<["get", "head", "post"]>;

login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options);
};

login.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: login.url(options),
    method: 'post',
});

/**
 * @route '/logout'
 */
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
});

logout.definition = {
    methods: ["post"],
    url: '/logout',
} satisfies RouteDefinition<["post"]>;

logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options);
};

logout.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
});

/**
 * @route '/register'
 */
export const register = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: register.url(options),
    method: 'get',
});

register.definition = {
    methods: ["get", "head", "post"],
    url: '/register',
} satisfies RouteDefinition<["get", "head", "post"]>;

register.url = (options?: RouteQueryOptions) => {
    return register.definition.url + queryParams(options);
};

register.form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: register.url(options),
    method: 'post',
});

/**
 * @route '/settings/password'
 */
export const password = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: password.url(options),
        method: 'get',
    }),
    {
        definition: {
            methods: ["get", "head", "put"],
            url: '/settings/password',
        } as RouteDefinition<["get", "head", "put"]>,
        url: (options?: RouteQueryOptions) => '/settings/password' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'put'> => ({
            action: '/settings/password' + queryParams(options),
            method: 'put',
        }),
        forgot: forgotPassword
    }
);