import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/team',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
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
const teamregistration = {
    index: Object.assign(index, index),
}

export default teamregistration