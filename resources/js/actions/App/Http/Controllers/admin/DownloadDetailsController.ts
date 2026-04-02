import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/downloaddetails',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::index
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:11
 * @route '/admin/dashboard/downloaddetails'
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
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
 */
export const show = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard/downloaddetails/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
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
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
 */
show.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
 */
show.head = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
 */
    const showForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
 */
        showForm.get = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\admin\DownloadDetailsController::show
 * @see app/Http/Controllers/admin/DownloadDetailsController.php:18
 * @route '/admin/dashboard/downloaddetails/{id}'
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
const DownloadDetailsController = { index, show }

export default DownloadDetailsController