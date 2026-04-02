import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/contest',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\ContestController::index
 * @see app/Http/Controllers/admin/ContestController.php:11
 * @route '/admin/dashboard/contest'
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
* @see \App\Http\Controllers\admin\ContestController::store
 * @see app/Http/Controllers/admin/ContestController.php:16
 * @route '/admin/dashboard/contest/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/contest/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\ContestController::store
 * @see app/Http/Controllers/admin/ContestController.php:16
 * @route '/admin/dashboard/contest/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\ContestController::store
 * @see app/Http/Controllers/admin/ContestController.php:16
 * @route '/admin/dashboard/contest/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\ContestController::store
 * @see app/Http/Controllers/admin/ContestController.php:16
 * @route '/admin/dashboard/contest/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\ContestController::store
 * @see app/Http/Controllers/admin/ContestController.php:16
 * @route '/admin/dashboard/contest/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
export const update = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/contest/update/{contest_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
update.url = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { contest_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    contest_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        contest_id: args.contest_id,
                }

    return update.definition.url
            .replace('{contest_id}', parsedArgs.contest_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
update.put = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
    const updateForm = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
        updateForm.put = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\admin\ContestController::destroy
 * @see app/Http/Controllers/admin/ContestController.php:49
 * @route '/admin/dashboard/contest/delete/{contest_id}'
 */
export const destroy = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/contest/delete/{contest_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\ContestController::destroy
 * @see app/Http/Controllers/admin/ContestController.php:49
 * @route '/admin/dashboard/contest/delete/{contest_id}'
 */
destroy.url = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { contest_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    contest_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        contest_id: args.contest_id,
                }

    return destroy.definition.url
            .replace('{contest_id}', parsedArgs.contest_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\ContestController::destroy
 * @see app/Http/Controllers/admin/ContestController.php:49
 * @route '/admin/dashboard/contest/delete/{contest_id}'
 */
destroy.delete = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\ContestController::destroy
 * @see app/Http/Controllers/admin/ContestController.php:49
 * @route '/admin/dashboard/contest/delete/{contest_id}'
 */
    const destroyForm = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\ContestController::destroy
 * @see app/Http/Controllers/admin/ContestController.php:49
 * @route '/admin/dashboard/contest/delete/{contest_id}'
 */
        destroyForm.delete = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const ContestController = { index, store, update, destroy }

export default ContestController