import HeadingSmall from '@/components/heading-small';
import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { appearance as appearanceRoute } from '@/routes/index';
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: appearanceRoute().url,
    },
];

export default function Appearance() {
    // এখানে সরাসরি ফর্ম লজিক রাখা হয়েছে যাতে আলাদা ফাইল না লাগে
    const { data, setData, patch, processing } = useForm({
        appearance: 'light', // ডিফল্ট ভ্যালু
    });

    const updateAppearance = (e: React.FormEvent) => {
        e.preventDefault();
        // আপনার ব্যাকএন্ড রাউট অনুযায়ী এটি কাজ করবে
        patch(appearanceRoute().url);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Appearance settings" />

            <SettingsLayout>
                <div className="space-y-6">
                    <HeadingSmall
                        title="Appearance settings"
                        description="Update your account's appearance settings"
                    />
                    
                    <form onSubmit={updateAppearance} className="space-y-6">
                        <RadioGroup 
                            value={data.appearance} 
                            onValueChange={(value) => setData('appearance', value)}
                            className="grid grid-cols-2 gap-4"
                        >
                            <div className="flex items-center space-x-2">
                                <RadioGroupItem value="light" id="light" />
                                <Label htmlFor="light">Light Mode</Label>
                            </div>
                            <div className="flex items-center space-x-2">
                                <RadioGroupItem value="dark" id="dark" />
                                <Label htmlFor="dark">Dark Mode</Label>
                            </div>
                        </RadioGroup>

                        <Button disabled={processing}>Save Changes</Button>
                    </form>
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}