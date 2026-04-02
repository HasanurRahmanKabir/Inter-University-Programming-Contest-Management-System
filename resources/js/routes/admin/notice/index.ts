import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
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
const notice = {
    update: Object.assign(update, update),
}

export default notice