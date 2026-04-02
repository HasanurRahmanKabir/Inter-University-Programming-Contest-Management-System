import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
export const update = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/contest/update/{contest_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
update.url = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { contest_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    contest_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        contest_id: args.contest_id,
                }

    return update.definition.url
            .replace('{contest_id}', parsedArgs.contest_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
update.put = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
    const updateForm = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\ContestController::update
 * @see app/Http/Controllers/admin/ContestController.php:32
 * @route '/admin/dashboard/contest/update/{contest_id}'
 */
        updateForm.put = (args: { contest_id: string | number } | [contest_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const contest = {
    update: Object.assign(update, update),
}

export default contest