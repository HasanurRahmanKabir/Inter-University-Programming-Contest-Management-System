import website from './website'
import admin from './admin'
import Settings from './Settings'
const Controllers = {
    website: Object.assign(website, website),
admin: Object.assign(admin, admin),
Settings: Object.assign(Settings, Settings),
}

export default Controllers