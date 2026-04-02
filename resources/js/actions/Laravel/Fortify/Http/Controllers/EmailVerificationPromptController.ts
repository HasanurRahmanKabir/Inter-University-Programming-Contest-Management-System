import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
export const __invoke = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: __invoke.url(options),
    method: 'get',
})

__invoke.definition = {
    methods: ["get","head"],
    url: '/email/verify',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
__invoke.url = (options?: RouteQueryOptions) => {
    return __invoke.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
__invoke.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: __invoke.url(options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
__invoke.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: __invoke.url(options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
    const __invokeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: __invoke.url(options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
        __invokeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: __invoke.url(options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\EmailVerificationPromptController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/EmailVerificationPromptController.php:18
 * @route '/email/verify'
 */
        __invokeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: __invoke.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    __invoke.form = __invokeForm
const EmailVerificationPromptController = { __invoke }

export default EmailVerificationPromptController