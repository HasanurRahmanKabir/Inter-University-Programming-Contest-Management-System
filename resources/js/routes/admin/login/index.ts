import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\admin\AdminLogin::submit
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
export const submit = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submit.url(options),
    method: 'post',
})

submit.definition = {
    methods: ["post"],
    url: '/admin/admin_login_submit',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\admin\AdminLogin::submit
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
submit.url = (options?: RouteQueryOptions) => {
    return submit.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\admin\AdminLogin::submit
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
submit.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: submit.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\admin\AdminLogin::submit
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
    const submitForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: submit.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\admin\AdminLogin::submit
 * @see app/Http/Controllers/admin/AdminLogin.php:16
 * @route '/admin/admin_login_submit'
 */
        submitForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: submit.url(options),
            method: 'post',
        })
    
    submit.form = submitForm
const login = {
    submit: Object.assign(submit, submit),
}

export default login