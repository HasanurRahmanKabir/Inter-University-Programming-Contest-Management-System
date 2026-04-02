import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
export const show = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/two-factor',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.url = (options?: RouteQueryOptions) => {
    return show.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
    const showForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
        showForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
        showForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
const TwoFactorAuthenticationController = { show }

export default TwoFactorAuthenticationController