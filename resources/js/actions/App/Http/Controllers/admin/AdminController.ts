import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\AdminController::index
 * @see app/Http/Controllers/admin/AdminController.php:11
 * @route '/admin/dashboard/admin'
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
* @see \App\Http\Controllers\admin\AdminController::destroy
 * @see app/Http/Controllers/admin/AdminController.php:43
 * @route '/admin/dashboard/delete/{admin_id}'
 */
export const destroy = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/delete/{admin_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\AdminController::destroy
 * @see app/Http/Controllers/admin/AdminController.php:43
 * @route '/admin/dashboard/delete/{admin_id}'
 */
destroy.url = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{admin_id}', parsedArgs.admin_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminController::destroy
 * @see app/Http/Controllers/admin/AdminController.php:43
 * @route '/admin/dashboard/delete/{admin_id}'
 */
destroy.delete = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\AdminController::destroy
 * @see app/Http/Controllers/admin/AdminController.php:43
 * @route '/admin/dashboard/delete/{admin_id}'
 */
    const destroyForm = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminController::destroy
 * @see app/Http/Controllers/admin/AdminController.php:43
 * @route '/admin/dashboard/delete/{admin_id}'
 */
        destroyForm.delete = (args: { admin_id: string | number } | [admin_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const AdminController = { index, store, update, destroy }

export default AdminController