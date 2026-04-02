import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/sponsor',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\SponsorController::index
 * @see app/Http/Controllers/admin/SponsorController.php:11
 * @route '/admin/dashboard/sponsor'
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
* @see \App\Http\Controllers\admin\SponsorController::store
 * @see app/Http/Controllers/admin/SponsorController.php:17
 * @route '/admin/dashboard/sponsor/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/sponsor/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\SponsorController::store
 * @see app/Http/Controllers/admin/SponsorController.php:17
 * @route '/admin/dashboard/sponsor/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\SponsorController::store
 * @see app/Http/Controllers/admin/SponsorController.php:17
 * @route '/admin/dashboard/sponsor/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\SponsorController::store
 * @see app/Http/Controllers/admin/SponsorController.php:17
 * @route '/admin/dashboard/sponsor/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\SponsorController::store
 * @see app/Http/Controllers/admin/SponsorController.php:17
 * @route '/admin/dashboard/sponsor/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
export const update = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/sponsor/update/{sponsor_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
update.url = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { sponsor_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    sponsor_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        sponsor_id: args.sponsor_id,
                }

    return update.definition.url
            .replace('{sponsor_id}', parsedArgs.sponsor_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
update.put = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
    const updateForm = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
        updateForm.put = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\admin\SponsorController::destroy
 * @see app/Http/Controllers/admin/SponsorController.php:74
 * @route '/admin/dashboard/sponsor/delete/{sponsor_id}'
 */
export const destroy = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/sponsor/delete/{sponsor_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\SponsorController::destroy
 * @see app/Http/Controllers/admin/SponsorController.php:74
 * @route '/admin/dashboard/sponsor/delete/{sponsor_id}'
 */
destroy.url = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { sponsor_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    sponsor_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        sponsor_id: args.sponsor_id,
                }

    return destroy.definition.url
            .replace('{sponsor_id}', parsedArgs.sponsor_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\SponsorController::destroy
 * @see app/Http/Controllers/admin/SponsorController.php:74
 * @route '/admin/dashboard/sponsor/delete/{sponsor_id}'
 */
destroy.delete = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\SponsorController::destroy
 * @see app/Http/Controllers/admin/SponsorController.php:74
 * @route '/admin/dashboard/sponsor/delete/{sponsor_id}'
 */
    const destroyForm = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\SponsorController::destroy
 * @see app/Http/Controllers/admin/SponsorController.php:74
 * @route '/admin/dashboard/sponsor/delete/{sponsor_id}'
 */
        destroyForm.delete = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const SponsorController = { index, store, update, destroy }

export default SponsorController