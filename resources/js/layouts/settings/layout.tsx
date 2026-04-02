import Heading from '@/components/heading'; // { Heading } এর বদলে শুধু Heading
import { cn } from '@/lib/utils';
// আপনার index.ts ফাইল অনুযায়ী এই দুটো রাউট ইম্পোর্ট করা হলো
import { appearance, password } from '@/routes/index'; 
import { Link, usePage } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

const sidebarNavItems = [
    {
        title: 'Appearance',
        href: appearance.url(),
    },
    {
        title: 'Password',
        href: password.url(),
    },
];

export default function SettingsLayout({ children }: PropsWithChildren) {
    const { url } = usePage();

    return (
        <div className="px-4 py-6">
            <Heading 
                title="Settings" 
                description="Manage your account settings and preferences." 
            />
            <div className="flex flex-col space-y-8 lg:flex-row lg:space-x-12 lg:space-y-0 py-6">
                <aside className="lg:w-1/5">
                    <nav className="flex space-x-2 lg:flex-col lg:space-x-0 lg:space-y-1">
                        {sidebarNavItems.map((item) => (
                            <Link
                                key={item.href}
                                href={item.href}
                                className={cn(
                                    'justify-start rounded-md px-3 py-2 text-sm font-medium',
                                    url.startsWith(item.href)
                                        ? 'bg-muted'
                                        : 'hover:bg-transparent hover:underline',
                                )}
                            >
                                {item.title}
                            </Link>
                        ))}
                    </nav>
                </aside>
                <div className="flex-1 lg:max-w-2xl">{children}</div>
            </div>
        </div>
    );
}