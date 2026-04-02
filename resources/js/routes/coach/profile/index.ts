import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\website\CoachController::update
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
export const update = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/coach/profile/update',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\website\CoachController::update
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
update.url = (options?: RouteQueryOptions) => {
    return update.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\CoachController::update
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
update.put = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\website\CoachController::update
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
    const updateForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\CoachController::update
 * @see app/Http/Controllers/website/CoachController.php:40
 * @route '/coach/profile/update'
 */
        updateForm.put = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const profile = {
    update: Object.assign(update, update),
}

export default profile