import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import kit from './kit'
/**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/volunteer/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
    const dashboardForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: dashboard.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
        dashboardForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: dashboard.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\VolunteersController::dashboard
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
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
const volunteer = {
    dashboard: Object.assign(dashboard, dashboard),
kit: Object.assign(kit, kit),
}

export default volunteer