import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import loginDf2c2a from './login'
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/two-factor-challenge',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
    const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: login.url(options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
        loginForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url(options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController::login
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticatedSessionController.php:41
 * @route '/two-factor-challenge'
 */
        loginForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: login.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    login.form = loginForm
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::enable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:21
 * @route '/user/two-factor-authentication'
 */
export const enable = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: enable.url(options),
    method: 'post',
})

enable.definition = {
    methods: ["post"],
    url: '/user/two-factor-authentication',
} satisfies RouteDefinition<["post"]>

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::enable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:21
 * @route '/user/two-factor-authentication'
 */
enable.url = (options?: RouteQueryOptions) => {
    return enable.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::enable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:21
 * @route '/user/two-factor-authentication'
 */
enable.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: enable.url(options),
    method: 'post',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::enable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:21
 * @route '/user/two-factor-authentication'
 */
    const enableForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: enable.url(options),
        method: 'post',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::enable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:21
 * @route '/user/two-factor-authentication'
 */
        enableForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: enable.url(options),
            method: 'post',
        })
    
    enable.form = enableForm
/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::confirm
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedTwoFactorAuthenticationController.php:19
 * @route '/user/confirmed-two-factor-authentication'
 */
export const confirm = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: confirm.url(options),
    method: 'post',
})

confirm.definition = {
    methods: ["post"],
    url: '/user/confirmed-two-factor-authentication',
} satisfies RouteDefinition<["post"]>

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::confirm
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedTwoFactorAuthenticationController.php:19
 * @route '/user/confirmed-two-factor-authentication'
 */
confirm.url = (options?: RouteQueryOptions) => {
    return confirm.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::confirm
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedTwoFactorAuthenticationController.php:19
 * @route '/user/confirmed-two-factor-authentication'
 */
confirm.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: confirm.url(options),
    method: 'post',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::confirm
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedTwoFactorAuthenticationController.php:19
 * @route '/user/confirmed-two-factor-authentication'
 */
    const confirmForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: confirm.url(options),
        method: 'post',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController::confirm
 * @see vendor/laravel/fortify/src/Http/Controllers/ConfirmedTwoFactorAuthenticationController.php:19
 * @route '/user/confirmed-two-factor-authentication'
 */
        confirmForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: confirm.url(options),
            method: 'post',
        })
    
    confirm.form = confirmForm
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::disable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:35
 * @route '/user/two-factor-authentication'
 */
export const disable = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: disable.url(options),
    method: 'delete',
})

disable.definition = {
    methods: ["delete"],
    url: '/user/two-factor-authentication',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::disable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:35
 * @route '/user/two-factor-authentication'
 */
disable.url = (options?: RouteQueryOptions) => {
    return disable.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::disable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:35
 * @route '/user/two-factor-authentication'
 */
disable.delete = (options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: disable.url(options),
    method: 'delete',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::disable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:35
 * @route '/user/two-factor-authentication'
 */
    const disableForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: disable.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController::disable
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorAuthenticationController.php:35
 * @route '/user/two-factor-authentication'
 */
        disableForm.delete = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: disable.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    disable.form = disableForm
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
export const qrCode = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: qrCode.url(options),
    method: 'get',
})

qrCode.definition = {
    methods: ["get","head"],
    url: '/user/two-factor-qr-code',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
qrCode.url = (options?: RouteQueryOptions) => {
    return qrCode.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
qrCode.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: qrCode.url(options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
qrCode.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: qrCode.url(options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
    const qrCodeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: qrCode.url(options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
        qrCodeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: qrCode.url(options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController::qrCode
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorQrCodeController.php:16
 * @route '/user/two-factor-qr-code'
 */
        qrCodeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: qrCode.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    qrCode.form = qrCodeForm
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
export const secretKey = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: secretKey.url(options),
    method: 'get',
})

secretKey.definition = {
    methods: ["get","head"],
    url: '/user/two-factor-secret-key',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
secretKey.url = (options?: RouteQueryOptions) => {
    return secretKey.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
secretKey.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: secretKey.url(options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
secretKey.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: secretKey.url(options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
    const secretKeyForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: secretKey.url(options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
        secretKeyForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: secretKey.url(options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController::secretKey
 * @see vendor/laravel/fortify/src/Http/Controllers/TwoFactorSecretKeyController.php:17
 * @route '/user/two-factor-secret-key'
 */
        secretKeyForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: secretKey.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    secretKey.form = secretKeyForm
/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
export const recoveryCodes = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: recoveryCodes.url(options),
    method: 'get',
})

recoveryCodes.definition = {
    methods: ["get","head"],
    url: '/user/two-factor-recovery-codes',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
recoveryCodes.url = (options?: RouteQueryOptions) => {
    return recoveryCodes.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
recoveryCodes.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: recoveryCodes.url(options),
    method: 'get',
})
/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
recoveryCodes.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: recoveryCodes.url(options),
    method: 'head',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
    const recoveryCodesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: recoveryCodes.url(options),
        method: 'get',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
        recoveryCodesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: recoveryCodes.url(options),
            method: 'get',
        })
            /**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::recoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:19
 * @route '/user/two-factor-recovery-codes'
 */
        recoveryCodesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: recoveryCodes.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    recoveryCodes.form = recoveryCodesForm
/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::regenerateRecoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:38
 * @route '/user/two-factor-recovery-codes'
 */
export const regenerateRecoveryCodes = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: regenerateRecoveryCodes.url(options),
    method: 'post',
})

regenerateRecoveryCodes.definition = {
    methods: ["post"],
    url: '/user/two-factor-recovery-codes',
} satisfies RouteDefinition<["post"]>

/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::regenerateRecoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:38
 * @route '/user/two-factor-recovery-codes'
 */
regenerateRecoveryCodes.url = (options?: RouteQueryOptions) => {
    return regenerateRecoveryCodes.definition.url + queryParams(options)
}

/**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::regenerateRecoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:38
 * @route '/user/two-factor-recovery-codes'
 */
regenerateRecoveryCodes.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: regenerateRecoveryCodes.url(options),
    method: 'post',
})

    /**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::regenerateRecoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:38
 * @route '/user/two-factor-recovery-codes'
 */
    const regenerateRecoveryCodesForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: regenerateRecoveryCodes.url(options),
        method: 'post',
    })

            /**
* @see \Laravel\Fortify\Http\Controllers\RecoveryCodeController::regenerateRecoveryCodes
 * @see vendor/laravel/fortify/src/Http/Controllers/RecoveryCodeController.php:38
 * @route '/user/two-factor-recovery-codes'
 */
        regenerateRecoveryCodesForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: regenerateRecoveryCodes.url(options),
            method: 'post',
        })
    
    regenerateRecoveryCodes.form = regenerateRecoveryCodesForm
/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
export const show = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/settings/two-factor',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.url = (options?: RouteQueryOptions) => {
    return show.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
show.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
    const showForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
        showForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Settings\TwoFactorAuthenticationController::show
 * @see app/Http/Controllers/Settings/TwoFactorAuthenticationController.php:28
 * @route '/settings/two-factor'
 */
        showForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
const twoFactor = {
    login: Object.assign(login, loginDf2c2a),
enable: Object.assign(enable, enable),
confirm: Object.assign(confirm, confirm),
disable: Object.assign(disable, disable),
qrCode: Object.assign(qrCode, qrCode),
secretKey: Object.assign(secretKey, secretKey),
recoveryCodes: Object.assign(recoveryCodes, recoveryCodes),
regenerateRecoveryCodes: Object.assign(regenerateRecoveryCodes, regenerateRecoveryCodes),
show: Object.assign(show, show),
}

export default twoFactor