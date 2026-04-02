import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\website\VolunteersController::save
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
export const save = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: save.url(options),
    method: 'post',
})

save.definition = {
    methods: ["post"],
    url: '/volunteer/kit/save',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\website\VolunteersController::save
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
save.url = (options?: RouteQueryOptions) => {
    return save.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\VolunteersController::save
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
save.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: save.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\website\VolunteersController::save
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
    const saveForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: save.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\website\VolunteersController::save
 * @see app/Http/Controllers/website/VolunteersController.php:28
 * @route '/volunteer/kit/save'
 */
        saveForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: save.url(options),
            method: 'post',
        })
    
    save.form = saveForm
const kit = {
    save: Object.assign(save, save),
}

export default kit