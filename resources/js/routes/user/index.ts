import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import loginDf2c2a from './login'
/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/website/user_login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: login.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
        loginForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\UserLogin::login
 * @see app/Http/Controllers/website/UserLogin.php:14
 * @route '/website/user_login'
 */
        loginForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
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
const user = {
    login: Object.assign(login, loginDf2c2a),
logout: Object.assign(logout, logout),
}

export default user