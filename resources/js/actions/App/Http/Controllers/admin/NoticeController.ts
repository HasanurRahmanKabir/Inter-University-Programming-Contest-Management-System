import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/notice',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\NoticeController::index
 * @see app/Http/Controllers/admin/NoticeController.php:11
 * @route '/admin/dashboard/notice'
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
* @see \App\Http\Controllers\admin\NoticeController::store
 * @see app/Http/Controllers/admin/NoticeController.php:33
 * @route '/admin/dashboard/notice/store'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/dashboard/notice/store',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\NoticeController::store
 * @see app/Http/Controllers/admin/NoticeController.php:33
 * @route '/admin/dashboard/notice/store'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\NoticeController::store
 * @see app/Http/Controllers/admin/NoticeController.php:33
 * @route '/admin/dashboard/notice/store'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\NoticeController::store
 * @see app/Http/Controllers/admin/NoticeController.php:33
 * @route '/admin/dashboard/notice/store'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\NoticeController::store
 * @see app/Http/Controllers/admin/NoticeController.php:33
 * @route '/admin/dashboard/notice/store'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\admin\NoticeController::update
 * @see app/Http/Controllers/admin/NoticeController.php:48
 * @route '/admin/dashboard/notice/update/{notice_id}'
 */
export const update = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard/notice/update/{notice_id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\admin\NoticeController::update
 * @see app/Http/Controllers/admin/NoticeController.php:48
 * @route '/admin/dashboard/notice/update/{notice_id}'
 */
update.url = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { notice_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    notice_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        notice_id: args.notice_id,
                }

    return update.definition.url
            .replace('{notice_id}', parsedArgs.notice_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\NoticeController::update
 * @see app/Http/Controllers/admin/NoticeController.php:48
 * @route '/admin/dashboard/notice/update/{notice_id}'
 */
update.put = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\admin\NoticeController::update
 * @see app/Http/Controllers/admin/NoticeController.php:48
 * @route '/admin/dashboard/notice/update/{notice_id}'
 */
    const updateForm = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\NoticeController::update
 * @see app/Http/Controllers/admin/NoticeController.php:48
 * @route '/admin/dashboard/notice/update/{notice_id}'
 */
        updateForm.put = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\admin\NoticeController::destroy
 * @see app/Http/Controllers/admin/NoticeController.php:61
 * @route '/admin/dashboard/notice/delete/{notice_id}'
 */
export const destroy = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/dashboard/notice/delete/{notice_id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\admin\NoticeController::destroy
 * @see app/Http/Controllers/admin/NoticeController.php:61
 * @route '/admin/dashboard/notice/delete/{notice_id}'
 */
destroy.url = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { notice_id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    notice_id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        notice_id: args.notice_id,
                }

    return destroy.definition.url
            .replace('{notice_id}', parsedArgs.notice_id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\NoticeController::destroy
 * @see app/Http/Controllers/admin/NoticeController.php:61
 * @route '/admin/dashboard/notice/delete/{notice_id}'
 */
destroy.delete = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\admin\NoticeController::destroy
 * @see app/Http/Controllers/admin/NoticeController.php:61
 * @route '/admin/dashboard/notice/delete/{notice_id}'
 */
    const destroyForm = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\NoticeController::destroy
 * @see app/Http/Controllers/admin/NoticeController.php:61
 * @route '/admin/dashboard/notice/delete/{notice_id}'
 */
        destroyForm.delete = (args: { notice_id: string | number } | [notice_id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const NoticeController = { index, store, update, destroy }

export default NoticeController