import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
export const update = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/volunteer/update/{volunteer_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
update.url = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { volunteer_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    volunteer_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        volunteer_id: args.volunteer_id,
                }

    return update.definition.url
            .replace('{volunteer_id}', parsedArgs.volunteer_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
update.put = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
    const updateForm = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\VolunteerController::update
 * @see app/Http/Controllers/admin/VolunteerController.php:34
 * @route '/admin/dashboard/volunteer/update/{volunteer_id}'
 */
        updateForm.put = (args: { volunteer_id: string | number } | [volunteer_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const volunteer = {
    update: Object.assign(update, update),
}

export default volunteer