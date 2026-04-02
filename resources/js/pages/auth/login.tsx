import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
// ইম্পোর্ট পাথ '@/routes/index' নিশ্চিত করা হয়েছে
import { login as loginRoute, register } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function Login({ status, canResetPassword }: { status?: string; canResetPassword?: boolean }) {
    return (
        <AuthLayout
            title="Log in to your account"
            description="Enter your email and password below to log in"
        >
            <Head title="Log in" />

            {status && <div className="mb-4 text-sm font-medium text-green-600">{status}</div>}

            <Form
                {...loginRoute.form()}
                className="flex flex-col gap-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-6">
                            <div className="grid gap-2">
                                <Label htmlFor="email">Email address</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    autoComplete="username"
                                    onChange={(e) => setData('email', e.target.value)}
                                    className="mt-1 block w-full"
                                    placeholder="email@example.com"
                                    autoFocus
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center justify-between">
                                    <Label htmlFor="password">Password</Label>
                                    {canResetPassword && (
                                        <TextLink href="/forgot-password" tabIndex={5}>
                                            Forgot your password?
                                        </TextLink>
                                    )}
                                </div>
                                <Input
                                    id="password"
                                    type="password"
                                    name="password"
                                    value={data.password}
                                    autoComplete="current-password"
                                    onChange={(e) => setData('password', e.target.value)}
                                    className="mt-1 block w-full"
                                    placeholder="Password"
                                />
                                <InputError message={errors.password} />
                            </div>

                            <div className="flex items-center space-x-2">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    checked={data.remember}
                                    onCheckedChange={(checked) => setData('remember', !!checked)}
                                />
                                <label
                                    htmlFor="remember"
                                    className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                >
                                    Remember me
                                </label>
                            </div>

                            <Button type="submit" className="mt-2 w-full" disabled={processing}>
                                Log in
                            </Button>
                        </div>

                        <div className="text-center text-sm text-muted-foreground">
                            Don't have an account?{' '}
                            <TextLink href={register().url} tabIndex={6}>
                                Sign up
                            </TextLink>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}