import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// ইম্পোর্ট পাথ '@/routes/index' নিশ্চিত করা হয়েছে
import { login, register as store } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function Register() {
    return (
        <AuthLayout
            title="Create an account"
            description="Enter your details below to create your account"
        >
            <Head title="Register" />
            <Form
                {...store.form()}
                resetOnSuccess={['password', 'password_confirmation']}
                className="flex flex-col gap-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-6">
                            {/* Name Field */}
                            <div className="grid gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="name"
                                    placeholder="Full name"
                                />
                                <InputError
                                    message={errors.name}
                                    className="mt-2"
                                />
                            </div>

                            {/* Email Field */}
                            <div className="grid gap-2">
                                <Label htmlFor="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    required
                                    tabIndex={2}
                                    autoComplete="email"
                                    placeholder="email@example.com"
                                />
                                <InputError message={errors.email} />
                            </div>

                            {/* Password Field */}
                            <div className="grid gap-2">
                                <Label htmlFor="password">Password</Label>
                                <Input
                                    id="password"
                                    type="password"
                                    name="password"
                                    value={data.password}
                                    onChange={(e) => setData('password', e.target.value)}
                                    required
                                    tabIndex={3}
                                    autoComplete="new-password"
                                    placeholder="Password"
                                />
                                <InputError message={errors.password} />
                            </div>

                            {/* Confirm Password Field */}
                            <div className="grid gap-2">
                                <Label htmlFor="password_confirmation">
                                    Confirm password
                                </Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    value={data.password_confirmation}
                                    onChange={(e) => setData('password_confirmation', e.target.value)}
                                    required
                                    tabIndex={4}
                                    autoComplete="new-password"
                                    placeholder="Confirm password"
                                />
                                <InputError
                                    message={errors.password_confirmation}
                                />
                            </div>

                            {/* Submit Button */}
                            <Button
                                type="submit"
                                className="w-full mt-2"
                                tabIndex={5}
                                disabled={processing}
                            >
                                {processing && <Spinner />}
                                Create account
                            </Button>
                        </div>

                        {/* Login Redirect */}
                        <div className="text-center text-sm text-muted-foreground">
                            Already have an account?{' '}
                            <TextLink href={login().url} tabIndex={6}>
                                Log in
                            </TextLink>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}