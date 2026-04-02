import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
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
* @see \App\Http\Controllers\admin\GalleryController::deleteMethod
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
export const deleteMethod = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

deleteMethod.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/gallery/delete/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\GalleryController::deleteMethod
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
deleteMethod.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return deleteMethod.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\GalleryController::deleteMethod
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
deleteMethod.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: deleteMethod.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\GalleryController::deleteMethod
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
    const deleteMethodForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: deleteMethod.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\GalleryController::deleteMethod
 * @see app/Http/Controllers/admin/GalleryController.php:44
 * @route '/admin/dashboard/gallery/delete/{id}'
 */
        deleteMethodForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: deleteMethod.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    deleteMethod.form = deleteMethodForm
const gallery = {
    store: Object.assign(store, store),
delete: Object.assign(deleteMethod, deleteMethod),
}

export default gallery