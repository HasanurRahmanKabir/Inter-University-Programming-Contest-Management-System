import { queryParams, type RouteDefinition, type RouteFormDefinition, type RouteQueryOptions } from './../wayfinder';

/**
 * @route '/'
 */
export const home = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: home.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head"], url: '/' } as RouteDefinition<["get", "head"]>,
        url: (options?: RouteQueryOptions) => '/' + queryParams(options)
    }
);

/**
 * @route '/settings/appearance'
 */
export const appearance = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: appearance.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head"], url: '/settings/appearance' } as RouteDefinition<["get", "head"]>,
        url: (options?: RouteQueryOptions) => '/settings/appearance' + queryParams(options)
    }
);

/**
 * @route '/settings/profile'
 */
export const profile = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: profile.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "patch"], url: '/settings/profile' } as RouteDefinition<["get", "head", "patch"]>,
        url: (options?: RouteQueryOptions) => '/settings/profile' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'patch'> => ({
            action: '/settings/profile' + queryParams(options),
            method: 'patch',
        })
    }
);

/**
 * @route '/settings/two-factor'
 * এরর ফিক্স: twoFactor রাউট যোগ করা হলো
 */
export const twoFactor = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: twoFactor.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post", "delete"], url: '/settings/two-factor' } as RouteDefinition<["get", "head", "post", "delete"]>,
        url: (options?: RouteQueryOptions) => '/settings/two-factor' + queryParams(options),
        enable: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/settings/two-factor' + queryParams(options),
            method: 'post',
        }),
        disable: (options?: RouteQueryOptions): RouteFormDefinition<'delete'> => ({
            action: '/settings/two-factor' + queryParams(options),
            method: 'delete',
        })
    }
);

/**
 * @route '/settings/danger-zone'
 * ভবিষ্যতের এরর এড়াতে এটিও যোগ করে রাখা হলো
 */
export const dangerZone = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: dangerZone.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "delete"], url: '/settings/danger-zone' } as RouteDefinition<["get", "head", "delete"]>,
        url: (options?: RouteQueryOptions) => '/settings/danger-zone' + queryParams(options),
        destroy: (options?: RouteQueryOptions): RouteFormDefinition<'delete'> => ({
            action: '/settings/danger-zone' + queryParams(options),
            method: 'delete',
        })
    }
);

/**
 * @route '/forgot-password'
 */
export const forgotPassword = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: forgotPassword.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post"], url: '/forgot-password' } as RouteDefinition<["get", "head", "post"]>,
        url: (options?: RouteQueryOptions) => '/forgot-password' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/forgot-password' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/confirm-password'
 */
export const confirmPassword = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: confirmPassword.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post"], url: '/confirm-password' } as RouteDefinition<["get", "head", "post"]>,
        url: (options?: RouteQueryOptions) => '/confirm-password' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/confirm-password' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/reset-password'
 */
export const resetPassword = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: resetPassword.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post"], url: '/reset-password' } as RouteDefinition<["get", "head", "post"]>,
        url: (options?: RouteQueryOptions) => '/reset-password' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/reset-password' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/login'
 */
export const login = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: login.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post"], url: '/login' } as RouteDefinition<["get", "head", "post"]>,
        url: (options?: RouteQueryOptions) => '/login' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/login' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/logout'
 */
export const logout = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
        url: logout.url(options),
        method: 'post',
    }),
    {
        definition: { methods: ["post"], url: '/logout' } as RouteDefinition<["post"]>,
        url: (options?: RouteQueryOptions) => '/logout' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/logout' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/register'
 */
export const register = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: register.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "post"], url: '/register' } as RouteDefinition<["get", "head", "post"]>,
        url: (options?: RouteQueryOptions) => '/register' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/register' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/email/verification-notification'
 */
export const verificationSend = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
        url: verificationSend.url(options),
        method: 'post',
    }),
    {
        definition: { methods: ["post"], url: '/email/verification-notification' } as RouteDefinition<["post"]>,
        url: (options?: RouteQueryOptions) => '/email/verification-notification' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: '/email/verification-notification' + queryParams(options),
            method: 'post',
        })
    }
);

/**
 * @route '/settings/password'
 */
export const password = Object.assign(
    (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
        url: password.url(options),
        method: 'get',
    }),
    {
        definition: { methods: ["get", "head", "put"], url: '/settings/password' } as RouteDefinition<["get", "head", "put"]>,
        url: (options?: RouteQueryOptions) => '/settings/password' + queryParams(options),
        form: (options?: RouteQueryOptions): RouteFormDefinition<'put'> => ({
            action: '/settings/password' + queryParams(options),
            method: 'put',
        }),
        forgot: forgotPassword
    }
);