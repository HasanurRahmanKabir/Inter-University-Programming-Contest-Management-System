import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import payment from './payment'
import profile from './profile'
/**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/coach/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
    const dashboardForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: dashboard.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
        dashboardForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: dashboard.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\CoachController::dashboard
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
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
const coach = {
    dashboard: Object.assign(dashboard, dashboard),
payment: Object.assign(payment, payment),
profile: Object.assign(profile, profile),
}

export default coach