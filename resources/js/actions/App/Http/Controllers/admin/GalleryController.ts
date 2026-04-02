import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/gallery',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\GalleryController::index
 * @see app/Http/Controllers/admin/GalleryController.php:12
 * @route '/admin/dashboard/gallery'
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
* @see \App\Http\Controllers\admin\GalleryController::store
 * @see app/Http/Controllers/admin/GalleryController.php:18
 * @route '/admin/dashboard/gallery/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/gallery/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\GalleryController::store
 * @see app/Http/Controllers/admin/GalleryController.php:18
 * @route '/admin/dashboard/gallery/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\GalleryController::store
 * @see app/Http/Controllers/admin/GalleryController.php:18
 * @route '/admin/dashboard/gallery/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\GalleryController::store
 * @see app/Http/Controllers/admin/GalleryController.php:18
 * @route '/admin/dashboard/gallery/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\GalleryController::store
 * @see app/Http/Controllers/admin/GalleryController.php:18
 * @route '/admin/dashboard/gallery/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\GalleryController::destroy
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
export const destroy = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/gallery/delete/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\GalleryController::destroy
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
destroy.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\GalleryController::destroy
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
destroy.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\GalleryController::destroy
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
    const destroyForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\GalleryController::destroy
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
        destroyForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const GalleryController = { index, store, destroy }

export default GalleryController