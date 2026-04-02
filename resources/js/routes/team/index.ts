import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
export const registration = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: registration.url(options),
    method: 'get',
})

registration.definition = {
    methods: ["get","head"],
    url: '/team/registration',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
registration.url = (options?: RouteQueryOptions) => {
    return registration.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
registration.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: registration.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
registration.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: registration.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
    const registrationForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: registration.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
        registrationForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: registration.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\website\TeamRegistrationController::registration
 * @see app/Http/Controllers/website/TeamRegistrationController.php:12
 * @route '/team/registration'
 */
        registrationForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: registration.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    registration.form = registrationForm
/**
* @see \App\Http\Controllers\admin\TeamController::update
 * @see app/Http/Controllers/admin/TeamController.php:48
 * @route '/admin/dashboard/team/update/{team_id}'
 */
export const update = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/team/update/{team_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\TeamController::update
 * @see app/Http/Controllers/admin/TeamController.php:48
 * @route '/admin/dashboard/team/update/{team_id}'
 */
update.url = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { team_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    team_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        team_id: args.team_id,
                }

    return update.definition.url
            .replace('{team_id}', parsedArgs.team_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\TeamController::update
 * @see app/Http/Controllers/admin/TeamController.php:48
 * @route '/admin/dashboard/team/update/{team_id}'
 */
update.put = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\TeamController::update
 * @see app/Http/Controllers/admin/TeamController.php:48
 * @route '/admin/dashboard/team/update/{team_id}'
 */
    const updateForm = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\TeamController::update
 * @see app/Http/Controllers/admin/TeamController.php:48
 * @route '/admin/dashboard/team/update/{team_id}'
 */
        updateForm.put = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
const team = {
    registration: Object.assign(registration, registration),
update: Object.assign(update, update),
}

export default team