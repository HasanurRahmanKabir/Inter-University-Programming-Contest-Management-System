import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
export const update = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/sponsor/update/{sponsor_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
update.url = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { sponsor_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    sponsor_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        sponsor_id: args.sponsor_id,
                }

    return update.definition.url
            .replace('{sponsor_id}', parsedArgs.sponsor_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
update.put = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
    const updateForm = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\SponsorController::update
 * @see app/Http/Controllers/admin/SponsorController.php:47
 * @route '/admin/dashboard/sponsor/update/{sponsor_id}'
 */
        updateForm.put = (args: { sponsor_id: string | number } | [sponsor_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const sponsor = {
    update: Object.assign(update, update),
}

export default sponsor