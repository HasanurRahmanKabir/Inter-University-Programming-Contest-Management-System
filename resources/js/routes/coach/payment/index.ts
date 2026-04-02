import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/coach/payment/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const payment = {
    store: Object.assign(store, store),
}

export default payment