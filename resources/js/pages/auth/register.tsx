import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
/** * পরিবর্তন: '@/routes/register' এর বদলে সরাসরি '@/routes/index' থেকে 
 * register রাউট অবজেক্টটি ইম্পোর্ট করা হয়েছে।
 */
import { login, register } from '@/routes/index'; 
import { Form, Head, Link } from '@inertiajs/react';

export default function Register() {
    return (
        <AuthLayout
            title="Create an account"
            description="Enter your details below to create your account"
        >
            <Head title="Register" />

            <Form {...register.store.form()} className="space-y-6">
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="name">Name</Label>
                            <Input
                                id="name"
                                name="name"
                                value={data.name}
                                className="mt-1 block w-full"
                                autoComplete="name"
                                autoFocus
                                onChange={(e) => setData('name', e.target.value)}
                                required
                                placeholder="Full name"
                            />
                            <InputError message={errors.name} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full"
                                autoComplete="username"
                                onChange={(e) => setData('email', e.target.value)}
                                required
                                placeholder="email@example.com"
                            />
                            <InputError message={errors.email} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                autoComplete="new-password"
                                onChange={(e) => setData('password', e.target.value)}
                                required
                                placeholder="Password"
                            />
                            <InputError message={errors.password} />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="password_confirmation">Confirm Password</Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
                                className="mt-1 block w-full"
                                autoComplete="new-password"
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                                required
                                placeholder="Confirm password"
                            />
                            <InputError message={errors.password_confirmation} />
                        </div>

                        <Button className="w-full" disabled={processing}>
                            Create account
                        </Button>
                    </>
                )}
            </Form>

            <div className="text-center text-sm">
                Already have an account?{' '}
                <Link href={login.url()} className="underline underline-offset-4">
                    Log in
                </Link>
            </div>
        </AuthLayout>
    );
}