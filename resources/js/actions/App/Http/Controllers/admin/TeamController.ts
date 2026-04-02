import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/team',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\TeamController::index
 * @see app/Http/Controllers/admin/TeamController.php:12
 * @route '/admin/dashboard/team'
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
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
export const show = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/team/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
show.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        id: args.id,
                }

    return show.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
show.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
show.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
    const showForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
        showForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\TeamController::show
 * @see app/Http/Controllers/admin/TeamController.php:0
 * @route '/admin/dashboard/team/{id}'
 */
        showForm.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
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
/**
* @see \App\Http\Controllers\admin\TeamController::destroy
 * @see app/Http/Controllers/admin/TeamController.php:34
 * @route '/admin/dashboard/team/delete/{team_id}'
 */
export const destroy = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/team/delete/{team_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\TeamController::destroy
 * @see app/Http/Controllers/admin/TeamController.php:34
 * @route '/admin/dashboard/team/delete/{team_id}'
 */
destroy.url = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return destroy.definition.url
            .replace('{team_id}', parsedArgs.team_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\TeamController::destroy
 * @see app/Http/Controllers/admin/TeamController.php:34
 * @route '/admin/dashboard/team/delete/{team_id}'
 */
destroy.delete = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\TeamController::destroy
 * @see app/Http/Controllers/admin/TeamController.php:34
 * @route '/admin/dashboard/team/delete/{team_id}'
 */
    const destroyForm = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\TeamController::destroy
 * @see app/Http/Controllers/admin/TeamController.php:34
 * @route '/admin/dashboard/team/delete/{team_id}'
 */
        destroyForm.delete = (args: { team_id: string | number } | [team_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const TeamController = { index, show, update, destroy }

export default TeamController