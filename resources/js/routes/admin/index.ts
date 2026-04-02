import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
import loginDf2c2a from './login'
import contest from './contest'
import teamregistration from './teamregistration'
import team from './team'
import payment from './payment'
import volunteer from './volunteer'
import notice from './notice'
import rules from './rules'
import gallery6dff65 from './gallery'
import sponsor from './sponsor'
/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/admin/admin_login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: login.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
 */
        loginForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\AdminLogin::login
 * @see app/Http/Controllers/admin/AdminLogin.php:11
 * @route '/admin/admin_login'
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
/**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
    const dashboardForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: dashboard.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
        dashboardForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: dashboard.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\UserController::dashboard
 * @see app/Http/Controllers/admin/UserController.php:13
 * @route '/admin/dashboard'
 */
        dashboardForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: dashboard.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    dashboard.form = dashboardForm
/**
* @see \App\Http\Controllers\admin\AdminController::store
 * @see app/Http/Controllers/admin/AdminController.php:17
 * @route '/admin/dashboard/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\AdminController::store
 * @see app/Http/Controllers/admin/AdminController.php:17
 * @route '/admin/dashboard/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminController::store
 * @see app/Http/Controllers/admin/AdminController.php:17
 * @route '/admin/dashboard/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\AdminController::store
 * @see app/Http/Controllers/admin/AdminController.php:17
 * @route '/admin/dashboard/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminController::store
 * @see app/Http/Controllers/admin/AdminController.php:17
 * @route '/admin/dashboard/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\AdminController::update
 * @see app/Http/Controllers/admin/AdminController.php:31
 * @route '/admin/dashboard/update/{admin_id}'
 */
export const update = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/update/{admin_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\AdminController::update
 * @see app/Http/Controllers/admin/AdminController.php:31
 * @route '/admin/dashboard/update/{admin_id}'
 */
update.url = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { admin_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    admin_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        admin_id: args.admin_id,
                }

    return update.definition.url
            .replace('{admin_id}', parsedArgs.admin_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminController::update
 * @see app/Http/Controllers/admin/AdminController.php:31
 * @route '/admin/dashboard/update/{admin_id}'
 */
update.put = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\AdminController::update
 * @see app/Http/Controllers/admin/AdminController.php:31
 * @route '/admin/dashboard/update/{admin_id}'
 */
    const updateForm = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminController::update
 * @see app/Http/Controllers/admin/AdminController.php:31
 * @route '/admin/dashboard/update/{admin_id}'
 */
        updateForm.put = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
export const gallery = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: gallery.url(options),
    method: 'get',
})

gallery.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/gallery',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
gallery.url = (options?: RouteQueryOptions) => {
    return gallery.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
gallery.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: gallery.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
gallery.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: gallery.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
    const galleryForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: gallery.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
        galleryForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: gallery.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\GalleryController::gallery
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
        galleryForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: gallery.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    gallery.form = galleryForm
const admin = {
    login: Object.assign(login, loginDf2c2a),
logout: Object.assign(logout, logout),
dashboard: Object.assign(dashboard, dashboard),
store: Object.assign(store, store),
update: Object.assign(update, update),
contest: Object.assign(contest, contest),
teamregistration: Object.assign(teamregistration, teamregistration),
team: Object.assign(team, team),
payment: Object.assign(payment, payment),
volunteer: Object.assign(volunteer, volunteer),
notice: Object.assign(notice, notice),
rules: Object.assign(rules, rules),
gallery: Object.assign(gallery, gallery6dff65),
sponsor: Object.assign(sponsor, sponsor),
}

export default admin