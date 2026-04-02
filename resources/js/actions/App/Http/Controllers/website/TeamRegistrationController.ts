import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/team/registration',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::index
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
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
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::checkDuplicateInDB
 * @see app/Http/Controllers/website/TeamRegistrationController.php:17
 * @route '/check-duplicate-db'
 */
export const checkDuplicateInDB = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: checkDuplicateInDB.url(options),
    method: 'post',
})

checkDuplicateInDB.definition = {
    methods: ["post"],
    url: '/check-duplicate-db',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::checkDuplicateInDB
 * @see app/Http/Controllers/website/TeamRegistrationController.php:17
 * @route '/check-duplicate-db'
 */
checkDuplicateInDB.url = (options?: RouteQueryOptions) => {
    return checkDuplicateInDB.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::checkDuplicateInDB
 * @see app/Http/Controllers/website/TeamRegistrationController.php:17
 * @route '/check-duplicate-db'
 */
checkDuplicateInDB.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: checkDuplicateInDB.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\TeamRegistrationController::checkDuplicateInDB
 * @see app/Http/Controllers/website/TeamRegistrationController.php:17
 * @route '/check-duplicate-db'
 */
    const checkDuplicateInDBForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: checkDuplicateInDB.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::checkDuplicateInDB
 * @see app/Http/Controllers/website/TeamRegistrationController.php:17
 * @route '/check-duplicate-db'
 */
        checkDuplicateInDBForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: checkDuplicateInDB.url(options),
            method: 'post',
        })
    
    checkDuplicateInDB.form = checkDuplicateInDBForm
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::store
 * @see app/Http/Controllers/website/TeamRegistrationController.php:56
 * @route '/team/registration/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/team/registration/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::store
 * @see app/Http/Controllers/website/TeamRegistrationController.php:56
 * @route '/team/registration/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::store
 * @see app/Http/Controllers/website/TeamRegistrationController.php:56
 * @route '/team/registration/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\TeamRegistrationController::store
 * @see app/Http/Controllers/website/TeamRegistrationController.php:56
 * @route '/team/registration/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::store
 * @see app/Http/Controllers/website/TeamRegistrationController.php:56
 * @route '/team/registration/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const TeamRegistrationController = { index, checkDuplicateInDB, store }

export default TeamRegistrationController