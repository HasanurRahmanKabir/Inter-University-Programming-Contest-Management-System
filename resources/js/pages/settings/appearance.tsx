import { Head } from '@inertiajs/react';
import HeadingSmall from '@/components/heading-small';
import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { type BreadcrumbItem } from '@/types';
// এখানে '@/routes' এর বদলে '@/routes/index' নিশ্চিত করা হয়েছে
import { appearance as appearanceRoute } from '@/routes/index'; 
import AppearanceForm from './partials/appearance-form';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: appearanceRoute().url,
    },
];

export default function Appearance() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Appearance settings" />

            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall
                        title="Appearance settings"
                        description="Update your account's appearance settings"
                    />
                    <AppearanceForm />
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}