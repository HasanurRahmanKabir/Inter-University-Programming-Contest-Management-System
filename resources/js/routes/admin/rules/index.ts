import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
export const update = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/rules_admin/update/{rules_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
update.url = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { rules_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    rules_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        rules_id: args.rules_id,
                }

    return update.definition.url
            .replace('{rules_id}', parsedArgs.rules_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
update.put = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
    const updateForm = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\RulesAdminController::update
 * @see app/Http/Controllers/admin/RulesAdminController.php:29
 * @route '/admin/dashboard/rules_admin/update/{rules_id}'
 */
        updateForm.put = (args: { rules_id: string | number } | [rules_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const rules = {
    update: Object.assign(update, update),
}

export default rules