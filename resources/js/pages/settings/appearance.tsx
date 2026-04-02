import HeadingSmall from '@/components/heading-small';
import { Button } from '@/components/ui/button';
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group';
import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
// নিশ্চিত করা হয়েছে যে ইম্পোর্ট পাথটি '@/routes/index' ই আছে
import { appearance as appearanceRoute } from '@/routes/index'; 
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: appearanceRoute().url,
    },
];

export default function Appearance() {
    // Inertia useForm লজিক
    const { data, setData, patch, processing } = useForm({
        appearance: 'light', // ডিফল্ট ভ্যালু, ডাটাবেজ থেকে আসলে এখানে ম্যাপ করতে পারেন
    });

    const updateAppearance = (e: React.FormEvent) => {
        e.preventDefault();
        
        // patch মেথডটি সরাসরি appearanceRoute().url এ কল হবে
        patch(appearanceRoute().url, {
            preserveScroll: true,
            onSuccess: () => {
                // সাকসেস হলে কোনো মেসেজ দেখাতে চাইলে এখানে লজিক দিতে পারেন
            },
        });
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
                            <div className="flex items-center space-x-2 rounded-md border p-4 hover:bg-accent cursor-pointer">
                                <RadioGroupItem value="light" id="light" />
                                <Label htmlFor="light" className="flex-1 cursor-pointer">Light Mode</Label>
                            </div>
                            
                            <div className="flex items-center space-x-2 rounded-md border p-4 hover:bg-accent cursor-pointer">
                                <RadioGroupItem value="dark" id="dark" />
                                <Label htmlFor="dark" className="flex-1 cursor-pointer">Dark Mode</Label>
                            </div>
                        </RadioGroup>

                        <div className="flex justify-start">
                            <Button disabled={processing} type="submit">
                                {processing ? 'Saving...' : 'Save Changes'}
                            </Button>
                        </div>
                    </form>
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}