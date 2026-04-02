import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/kitstatus',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\KitStatusController::index
 * @see app/Http/Controllers/admin/KitStatusController.php:12
 * @route '/admin/dashboard/kitstatus'
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
* @see \App\Http\Controllers\admin\KitStatusController::store
 * @see app/Http/Controllers/admin/KitStatusController.php:48
 * @route '/admin/dashboard/kitstatus/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/kitstatus/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\KitStatusController::store
 * @see app/Http/Controllers/admin/KitStatusController.php:48
 * @route '/admin/dashboard/kitstatus/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\KitStatusController::store
 * @see app/Http/Controllers/admin/KitStatusController.php:48
 * @route '/admin/dashboard/kitstatus/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\KitStatusController::store
 * @see app/Http/Controllers/admin/KitStatusController.php:48
 * @route '/admin/dashboard/kitstatus/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\KitStatusController::store
 * @see app/Http/Controllers/admin/KitStatusController.php:48
 * @route '/admin/dashboard/kitstatus/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\KitStatusController::update
 * @see app/Http/Controllers/admin/KitStatusController.php:61
 * @route '/admin/dashboard/kitstatus/update/{id}'
 */
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/kitstatus/update/{id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\KitStatusController::update
 * @see app/Http/Controllers/admin/KitStatusController.php:61
 * @route '/admin/dashboard/kitstatus/update/{id}'
 */
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        id: args.id,
                }

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\KitStatusController::update
 * @see app/Http/Controllers/admin/KitStatusController.php:61
 * @route '/admin/dashboard/kitstatus/update/{id}'
 */
update.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\KitStatusController::update
 * @see app/Http/Controllers/admin/KitStatusController.php:61
 * @route '/admin/dashboard/kitstatus/update/{id}'
 */
    const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\KitStatusController::update
 * @see app/Http/Controllers/admin/KitStatusController.php:61
 * @route '/admin/dashboard/kitstatus/update/{id}'
 */
        updateForm.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const KitStatusController = { index, store, update }

export default KitStatusController