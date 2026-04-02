import HeadingSmall from '@/components/heading-small';
import { useAppearance } from '@/hooks/use-appearance';
import SettingsLayout from '@/layouts/settings/layout';
// এখানে '@/routes' এর বদলে '@/routes/index' করা হয়েছে যা সার্ভারের জন্য জরুরি
import { appearance } from '@/routes/index'; 
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Monitor, Moon, Sun } from 'lucide-react';

export default function Appearance() {
    const { appearance: mode, updateAppearance } = useAppearance();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Appearance settings',
            href: appearance.url(),
        },
    ];

    return (
        <SettingsLayout>
            <Head title="Appearance settings" />

            <div className="space-y-6">
                <HeadingSmall
                    title="Appearance settings"
                    description="Update your account's appearance settings"
                />

                <div className="space-y-2">
                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <button
                            type="button"
                            onClick={() => updateAppearance('light')}
                            className={`flex flex-col items-center gap-2 rounded-lg border-2 p-4 transition-all hover:bg-accent ${
                                mode === 'light' ? 'border-primary' : 'border-transparent'
                            }`}
                        >
                            <Sun className="h-6 w-6" />
                            <span className="text-sm font-medium">Light</span>
                        </button>

                        <button
                            type="button"
                            onClick={() => updateAppearance('dark')}
                            className={`flex flex-col items-center gap-2 rounded-lg border-2 p-4 transition-all hover:bg-accent ${
                                mode === 'dark' ? 'border-primary' : 'border-transparent'
                            }`}
                        >
                            <Moon className="h-6 w-6" />
                            <span className="text-sm font-medium">Dark</span>
                        </button>

                        <button
                            type="button"
                            onClick={() => updateAppearance('system')}
                            className={`flex flex-col items-center gap-2 rounded-lg border-2 p-4 transition-all hover:bg-accent ${
                                mode === 'system' ? 'border-primary' : 'border-transparent'
                            }`}
                        >
                            <Monitor className="h-6 w-6" />
                            <span className="text-sm font-medium">System</span>
                        </button>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    );
}