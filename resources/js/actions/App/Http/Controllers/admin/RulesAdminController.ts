import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/rules_admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\RulesAdminController::index
 * @see app/Http/Controllers/admin/RulesAdminController.php:11
 * @route '/admin/dashboard/rules_admin'
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
* @see \App\Http\Controllers\admin\RulesAdminController::store
 * @see app/Http/Controllers/admin/RulesAdminController.php:16
 * @route '/admin/dashboard/rules_admin/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/rules_admin/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\RulesAdminController::store
 * @see app/Http/Controllers/admin/RulesAdminController.php:16
 * @route '/admin/dashboard/rules_admin/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\RulesAdminController::store
 * @see app/Http/Controllers/admin/RulesAdminController.php:16
 * @route '/admin/dashboard/rules_admin/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\RulesAdminController::store
 * @see app/Http/Controllers/admin/RulesAdminController.php:16
 * @route '/admin/dashboard/rules_admin/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\RulesAdminController::store
 * @see app/Http/Controllers/admin/RulesAdminController.php:16
 * @route '/admin/dashboard/rules_admin/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
export const update = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/rules_admin/update/{rules_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
update.url = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { rules_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    rules_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        rules_id: args.rules_id,
                }

    return update.definition.url
            .replace('{rules_id}', parsedArgs.rules_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
update.put = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
    const updateForm = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
        updateForm.put = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\admin\RulesAdminController::destroy
 * @see app/Http/Controllers/admin/RulesAdminController.php:40
 * @route '/admin/dashboard/rules_admin/delete/{rules_id}'
 */
export const destroy = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/rules_admin/delete/{rules_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\RulesAdminController::destroy
 * @see app/Http/Controllers/admin/RulesAdminController.php:40
 * @route '/admin/dashboard/rules_admin/delete/{rules_id}'
 */
destroy.url = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { rules_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    rules_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        rules_id: args.rules_id,
                }

    return destroy.definition.url
            .replace('{rules_id}', parsedArgs.rules_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\RulesAdminController::destroy
 * @see app/Http/Controllers/admin/RulesAdminController.php:40
 * @route '/admin/dashboard/rules_admin/delete/{rules_id}'
 */
destroy.delete = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\RulesAdminController::destroy
 * @see app/Http/Controllers/admin/RulesAdminController.php:40
 * @route '/admin/dashboard/rules_admin/delete/{rules_id}'
 */
    const destroyForm = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\RulesAdminController::destroy
 * @see app/Http/Controllers/admin/RulesAdminController.php:40
 * @route '/admin/dashboard/rules_admin/delete/{rules_id}'
 */
        destroyForm.delete = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const RulesAdminController = { index, store, update, destroy }

export default RulesAdminController