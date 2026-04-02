import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// এখানে নিশ্চিতভাবে '@/routes/index' ইম্পোর্ট করা হয়েছে
import { login, password, register } from '@/routes/index'; 
import { Form, Head, Link } from '@inertiajs/react';

export default function Login({ status, canResetPassword }: { status?: string; canResetPassword?: boolean }) {
    return (
        <AuthLayout
            title="Log in to your account"
            description="Enter your email below to log in to your account"
        >
            <Head title="Log in" />

            {status && <div className="mb-4 text-sm font-medium text-green-600">{status}</div>}

            <Form {...login.form()} className="space-y-6">
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full"
                                autoComplete="username"
                                autoFocus
                                onChange={(e) => setData('email', e.target.value)}
                                placeholder="email@example.com"
                            />
                            <InputError message={errors.email} />
                        </div>

                        <div className="grid gap-2">
                            <div className="flex items-center justify-between">
                                <Label htmlFor="password">Password</Label>
                                {canResetPassword && (
                                    <Link
                                        {...password.forgot.link()}
                                        className="text-sm text-gray-600 underline hover:text-gray-900"
                                    >
                                        Forgot your password?
                                    </Link>
                                )}
                            </div>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                autoComplete="current-password"
                                onChange={(e) => setData('password', e.target.value)}
                                placeholder="Password"
                            />
                            <InputError message={errors.password} />
                        </div>

                        <div className="flex items-center space-x-2">
                            <Checkbox
                                id="remember"
                                name="remember"
                                checked={data.remember}
                                onCheckedChange={(checked) => setData('remember', checked as boolean)}
                            />
                            <Label htmlFor="remember" className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Remember me
                            </Label>
                        </div>

                        <Button className="w-full" disabled={processing}>
                            {processing && <Spinner className="mr-2 h-4 w-4" />}
                            Log in
                        </Button>

                        <div className="text-center text-sm">
                            Don't have an account?{' '}
                            <Link {...register().link()} className="underline underline-offset-4">
                                Sign up
                            </Link>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}