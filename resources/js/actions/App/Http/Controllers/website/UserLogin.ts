import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/website/user_login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\UserLogin::index
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:31
 * @route '/website/user_login_submit'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: login.url(options),
    method: 'post',
})

login.definition = {
    methods: ["post"],
    url: '/website/user_login_submit',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:31
 * @route '/website/user_login_submit'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:31
 * @route '/website/user_login_submit'
 */
login.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: login.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:31
 * @route '/website/user_login_submit'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: login.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:31
 * @route '/website/user_login_submit'
 */
        loginForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: login.url(options),
            method: 'post',
        })
    
    login.form = loginForm
/**
* @see \App\Http\Controllers\website\UserLogin::logout
 * @see app/Http/Controllers/website/UserLogin.php:68
 * @route '/website/user_logout'
 */
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ["post"],
    url: '/website/user_logout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\UserLogin::logout
 * @see app/Http/Controllers/website/UserLogin.php:68
 * @route '/website/user_logout'
 */
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\UserLogin::logout
 * @see app/Http/Controllers/website/UserLogin.php:68
 * @route '/website/user_logout'
 */
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\UserLogin::logout
 * @see app/Http/Controllers/website/UserLogin.php:68
 * @route '/website/user_logout'
 */
    const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: logout.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\UserLogin::logout
 * @see app/Http/Controllers/website/UserLogin.php:68
 * @route '/website/user_logout'
 */
        logoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: logout.url(options),
            method: 'post',
        })
    
    logout.form = logoutForm
const UserLogin = { index, login, logout }

export default UserLogin