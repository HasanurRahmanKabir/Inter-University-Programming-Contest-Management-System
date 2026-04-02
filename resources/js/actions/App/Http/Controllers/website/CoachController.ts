import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
const indexe80eea81ba73d7bf34c1dfc691cf5602 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexe80eea81ba73d7bf34c1dfc691cf5602.url(options),
    method: 'get',
})

indexe80eea81ba73d7bf34c1dfc691cf5602.definition = {
    methods: ["get","head"],
    url: '/website/coach',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
indexe80eea81ba73d7bf34c1dfc691cf5602.url = (options?: RouteQueryOptions) => {
    return indexe80eea81ba73d7bf34c1dfc691cf5602.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
indexe80eea81ba73d7bf34c1dfc691cf5602.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexe80eea81ba73d7bf34c1dfc691cf5602.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
indexe80eea81ba73d7bf34c1dfc691cf5602.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: indexe80eea81ba73d7bf34c1dfc691cf5602.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
    const indexe80eea81ba73d7bf34c1dfc691cf5602Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: indexe80eea81ba73d7bf34c1dfc691cf5602.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
        indexe80eea81ba73d7bf34c1dfc691cf5602Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: indexe80eea81ba73d7bf34c1dfc691cf5602.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/website/coach'
 */
        indexe80eea81ba73d7bf34c1dfc691cf5602Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: indexe80eea81ba73d7bf34c1dfc691cf5602.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    indexe80eea81ba73d7bf34c1dfc691cf5602.form = indexe80eea81ba73d7bf34c1dfc691cf5602Form
    /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
const index667e1894df308d24c587edb7424eeaa1 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index667e1894df308d24c587edb7424eeaa1.url(options),
    method: 'get',
})

index667e1894df308d24c587edb7424eeaa1.definition = {
    methods: ["get","head"],
    url: '/coach/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
index667e1894df308d24c587edb7424eeaa1.url = (options?: RouteQueryOptions) => {
    return index667e1894df308d24c587edb7424eeaa1.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
index667e1894df308d24c587edb7424eeaa1.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index667e1894df308d24c587edb7424eeaa1.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
index667e1894df308d24c587edb7424eeaa1.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index667e1894df308d24c587edb7424eeaa1.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
    const index667e1894df308d24c587edb7424eeaa1Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index667e1894df308d24c587edb7424eeaa1.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
        index667e1894df308d24c587edb7424eeaa1Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index667e1894df308d24c587edb7424eeaa1.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\CoachController::index
 * @see app/Http/Controllers/website/CoachController.php:14
 * @route '/coach/dashboard'
 */
        index667e1894df308d24c587edb7424eeaa1Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index667e1894df308d24c587edb7424eeaa1.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index667e1894df308d24c587edb7424eeaa1.form = index667e1894df308d24c587edb7424eeaa1Form

export const index = {
    '/website/coach': indexe80eea81ba73d7bf34c1dfc691cf5602,
    '/coach/dashboard': index667e1894df308d24c587edb7424eeaa1,
}

/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:0
 * @route '/website/coach/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/website/coach/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:0
 * @route '/website/coach/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:0
 * @route '/website/coach/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:0
 * @route '/website/coach/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::store
 * @see app/Http/Controllers/website/CoachController.php:0
 * @route '/website/coach/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\website\CoachController::storePayment
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
export const storePayment = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storePayment.url(options),
    method: 'post',
})

storePayment.definition = {
    methods: ["post"],
    url: '/coach/payment/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\CoachController::storePayment
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
storePayment.url = (options?: RouteQueryOptions) => {
    return storePayment.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::storePayment
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
storePayment.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storePayment.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\CoachController::storePayment
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
    const storePaymentForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: storePayment.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::storePayment
 * @see app/Http/Controllers/website/CoachController.php:23
 * @route '/coach/payment/store'
 */
        storePaymentForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: storePayment.url(options),
            method: 'post',
        })
    
    storePayment.form = storePaymentForm
/**
* @see \App\Http\Controllers\website\CoachController::updateProfile
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
export const updateProfile = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateProfile.url(options),
    method: 'put',
})

updateProfile.definition = {
    methods: ["put"],
    url: '/coach/profile/update',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\website\CoachController::updateProfile
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
updateProfile.url = (options?: RouteQueryOptions) => {
    return updateProfile.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::updateProfile
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
updateProfile.put = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateProfile.url(options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\website\CoachController::updateProfile
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
    const updateProfileForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateProfile.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::updateProfile
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
        updateProfileForm.put = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateProfile.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateProfile.form = updateProfileForm
const CoachController = { index, store, storePayment, updateProfile }

export default CoachController