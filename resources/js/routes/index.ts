import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../wayfinder';

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
 * @route '/settings/password'
 */
export const password = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: password.url(options),
    method: 'get',
});

password.definition = {
    methods: ["get", "head", "put"],
    url: '/settings/password',
} satisfies RouteDefinition<["get", "head", "put"]>;

password.url = (options?: RouteQueryOptions) => {
    return password.definition.url + queryParams(options);
};

const passwordForm = (options?: RouteQueryOptions): RouteFormDefinition<'put'> => ({
    action: password.url(options),
    method: 'put',
});

password.form = passwordForm;

/**
 * @route '/confirm-password'
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

const confirmPasswordForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: confirmPassword.url(options),
    method: 'post',
});

confirmPassword.form = confirmPasswordForm;

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

const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: login.url(options),
    of: login.definition.url,
    method: 'post',
});

login.form = loginForm;

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

const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
});

logout.form = logoutForm;

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

const registerForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: register.url(options),
    method: 'post',
});

register.form = registerForm;

/**
 * @route '/verify-email'
 */
export const verifyEmail = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: verifyEmail.url(options),
    method: 'get',
});

verifyEmail.definition = {
    methods: ["get", "head"],
    url: '/verify-email',
} satisfies RouteDefinition<["get", "head"]>;

verifyEmail.url = (options?: RouteQueryOptions) => {
    return verifyEmail.definition.url + queryParams(options);
};

/**
 * Verification Send Logic
 */
export const verificationSend = {
    form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: '/email/verification-notification' + queryParams(options),
        method: 'post',
    }),
};