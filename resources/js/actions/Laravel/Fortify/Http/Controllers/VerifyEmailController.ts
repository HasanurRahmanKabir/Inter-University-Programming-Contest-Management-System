import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
export const __invoke = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: __invoke.url(args, options),
    method: 'get',
})

__invoke.definition = {
    methods: ["get","head"],
    url: '/email/verify/{id}/{hash}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
__invoke.url = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
                    id: args[0],
                    hash: args[1],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        id: args.id,
                                hash: args.hash,
                }

    return __invoke.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace('{hash}', parsedArgs.hash.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
__invoke.get = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: __invoke.url(args, options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
__invoke.head = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: __invoke.url(args, options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
    const __invokeForm = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: __invoke.url(args, options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
        __invokeForm.get = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: __invoke.url(args, options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\VerifyEmailController::__invoke
 * @see vendor/laravel/fortify/src/Http/Controllers/VerifyEmailController.php:18
 * @route '/email/verify/{id}/{hash}'
 */
        __invokeForm.head = (args: { id: string | number, hash: string | number } | [id: string | number, hash: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: __invoke.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    __invoke.form = __invokeForm
const VerifyEmailController = { __invoke }

export default VerifyEmailController