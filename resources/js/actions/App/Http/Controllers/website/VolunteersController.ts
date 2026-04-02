import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
const index45bf6a061dac495f2f1fd0c3532decb9 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index45bf6a061dac495f2f1fd0c3532decb9.url(options),
    method: 'get',
})

index45bf6a061dac495f2f1fd0c3532decb9.definition = {
    methods: ["get","head"],
    url: '/website/volunteer',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
index45bf6a061dac495f2f1fd0c3532decb9.url = (options?: RouteQueryOptions) => {
    return index45bf6a061dac495f2f1fd0c3532decb9.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
index45bf6a061dac495f2f1fd0c3532decb9.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index45bf6a061dac495f2f1fd0c3532decb9.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
index45bf6a061dac495f2f1fd0c3532decb9.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index45bf6a061dac495f2f1fd0c3532decb9.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
    const index45bf6a061dac495f2f1fd0c3532decb9Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index45bf6a061dac495f2f1fd0c3532decb9.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
        index45bf6a061dac495f2f1fd0c3532decb9Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index45bf6a061dac495f2f1fd0c3532decb9.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/website/volunteer'
 */
        index45bf6a061dac495f2f1fd0c3532decb9Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index45bf6a061dac495f2f1fd0c3532decb9.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index45bf6a061dac495f2f1fd0c3532decb9.form = index45bf6a061dac495f2f1fd0c3532decb9Form
    /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
const index5cc90c886da0956c0a868733706b6566 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index5cc90c886da0956c0a868733706b6566.url(options),
    method: 'get',
})

index5cc90c886da0956c0a868733706b6566.definition = {
    methods: ["get","head"],
    url: '/volunteer/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
index5cc90c886da0956c0a868733706b6566.url = (options?: RouteQueryOptions) => {
    return index5cc90c886da0956c0a868733706b6566.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
index5cc90c886da0956c0a868733706b6566.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index5cc90c886da0956c0a868733706b6566.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
index5cc90c886da0956c0a868733706b6566.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index5cc90c886da0956c0a868733706b6566.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
    const index5cc90c886da0956c0a868733706b6566Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index5cc90c886da0956c0a868733706b6566.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
        index5cc90c886da0956c0a868733706b6566Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index5cc90c886da0956c0a868733706b6566.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\VolunteersController::index
 * @see app/Http/Controllers/website/VolunteersController.php:14
 * @route '/volunteer/dashboard'
 */
        index5cc90c886da0956c0a868733706b6566Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index5cc90c886da0956c0a868733706b6566.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index5cc90c886da0956c0a868733706b6566.form = index5cc90c886da0956c0a868733706b6566Form

export const index = {
    '/website/volunteer': index45bf6a061dac495f2f1fd0c3532decb9,
    '/volunteer/dashboard': index5cc90c886da0956c0a868733706b6566,
}

/**
* @see \App\Http\Controllers\website\VolunteersController::saveKitStatus
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
export const saveKitStatus = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: saveKitStatus.url(options),
    method: 'post',
})

saveKitStatus.definition = {
    methods: ["post"],
    url: '/volunteer/kit/save',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\VolunteersController::saveKitStatus
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
saveKitStatus.url = (options?: RouteQueryOptions) => {
    return saveKitStatus.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\VolunteersController::saveKitStatus
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
saveKitStatus.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: saveKitStatus.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\VolunteersController::saveKitStatus
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
    const saveKitStatusForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: saveKitStatus.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\VolunteersController::saveKitStatus
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
        saveKitStatusForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: saveKitStatus.url(options),
            method: 'post',
        })
    
    saveKitStatus.form = saveKitStatusForm
const VolunteersController = { index, saveKitStatus }

export default VolunteersController