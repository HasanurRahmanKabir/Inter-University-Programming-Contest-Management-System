import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/volunteer',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\VolunteerController::index
 * @see app/Http/Controllers/admin/VolunteerController.php:13
 * @route '/admin/dashboard/volunteer'
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
* @see \App\Http\Controllers\admin\VolunteerController::store
 * @see app/Http/Controllers/admin/VolunteerController.php:18
 * @route '/admin/dashboard/volunteer/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/volunteer/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\VolunteerController::store
 * @see app/Http/Controllers/admin/VolunteerController.php:18
 * @route '/admin/dashboard/volunteer/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\VolunteerController::store
 * @see app/Http/Controllers/admin/VolunteerController.php:18
 * @route '/admin/dashboard/volunteer/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\VolunteerController::store
 * @see app/Http/Controllers/admin/VolunteerController.php:18
 * @route '/admin/dashboard/volunteer/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\VolunteerController::store
 * @see app/Http/Controllers/admin/VolunteerController.php:18
 * @route '/admin/dashboard/volunteer/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
export const update = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/volunteer/update/{volunteer_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
update.url = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { volunteer_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    volunteer_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        volunteer_id: args.volunteer_id,
                }

    return update.definition.url
            .replace('{volunteer_id}', parsedArgs.volunteer_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
update.put = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
    const updateForm = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
        updateForm.put = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\admin\VolunteerController::destroy
 * @see app/Http/Controllers/admin/VolunteerController.php:47
 * @route '/admin/dashboard/volunteer/delete/{volunteer_id}'
 */
export const destroy = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/volunteer/delete/{volunteer_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\VolunteerController::destroy
 * @see app/Http/Controllers/admin/VolunteerController.php:47
 * @route '/admin/dashboard/volunteer/delete/{volunteer_id}'
 */
destroy.url = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { volunteer_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    volunteer_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        volunteer_id: args.volunteer_id,
                }

    return destroy.definition.url
            .replace('{volunteer_id}', parsedArgs.volunteer_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\VolunteerController::destroy
 * @see app/Http/Controllers/admin/VolunteerController.php:47
 * @route '/admin/dashboard/volunteer/delete/{volunteer_id}'
 */
destroy.delete = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\VolunteerController::destroy
 * @see app/Http/Controllers/admin/VolunteerController.php:47
 * @route '/admin/dashboard/volunteer/delete/{volunteer_id}'
 */
    const destroyForm = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\VolunteerController::destroy
 * @see app/Http/Controllers/admin/VolunteerController.php:47
 * @route '/admin/dashboard/volunteer/delete/{volunteer_id}'
 */
        destroyForm.delete = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const VolunteerController = { index, store, update, destroy }

export default VolunteerController