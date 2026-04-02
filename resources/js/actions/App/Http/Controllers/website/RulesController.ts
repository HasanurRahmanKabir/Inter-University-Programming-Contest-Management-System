import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/rules',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\RulesController::index
 * @see app/Http/Controllers/website/RulesController.php:11
 * @route '/rules'
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
const RulesController = { index }

export default RulesController