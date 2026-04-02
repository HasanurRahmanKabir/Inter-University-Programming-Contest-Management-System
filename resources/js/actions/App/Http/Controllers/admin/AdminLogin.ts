import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/admin_login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\AdminLogin::index
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
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
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: login.url(options),
    method: 'post',
})

login.definition = {
    methods: ["post"],
    url: '/admin/admin_login_submit',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
login.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: login.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: login.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
        loginForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: login.url(options),
            method: 'post',
        })
    
    login.form = loginForm
/**
* @see \App\Http\Controllers\admin\AdminLogin::logout
 * @see app/Http/Controllers/admin/AdminLogin.php:41
 * @route '/admin/logout'
 */
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ["post"],
    url: '/admin/logout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\AdminLogin::logout
 * @see app/Http/Controllers/admin/AdminLogin.php:41
 * @route '/admin/logout'
 */
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminLogin::logout
 * @see app/Http/Controllers/admin/AdminLogin.php:41
 * @route '/admin/logout'
 */
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\AdminLogin::logout
 * @see app/Http/Controllers/admin/AdminLogin.php:41
 * @route '/admin/logout'
 */
    const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: logout.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminLogin::logout
 * @see app/Http/Controllers/admin/AdminLogin.php:41
 * @route '/admin/logout'
 */
        logoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: logout.url(options),
            method: 'post',
        })
    
    logout.form = logoutForm
const AdminLogin = { index, login, logout }

export default AdminLogin