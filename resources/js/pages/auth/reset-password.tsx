import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// সঠিক ইম্পোর্ট পাথ নিশ্চিত করা হয়েছে
import { password as passwordRoute } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

interface ResetPasswordProps {
    token: string;
    email: string;
}

export default function ResetPassword({ token, email }: ResetPasswordProps) {
    return (
        <AuthLayout
            title="Reset password"
            description="Please enter your new password below"
        >
            <Head title="Reset password" />

            <Form
                {...passwordRoute.form()}
                transform={(data) => ({ ...data, token, email })}
                resetOnSuccess={['password', 'password_confirmation']}
            >
                {({ data, setData, processing, errors }) => (
                    <div className="grid gap-6">
                        {/* ইমেইল ফিল্ড (এটি পরিবর্তন করা যাবে না) */}
                        <div className="grid gap-2">
                            <Label htmlFor="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                value={email}
                                className="mt-1 block w-full bg-muted"
                                readOnly
                            />
                            <InputError
                                message={errors.email}
                                className="mt-2"
                            />
                        </div>

                        {/* পাসওয়ার্ড ইনপুট */}
                        <div className="grid gap-2">
                            <Label htmlFor="password">New Password</Label>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                autoComplete="new-password"
                                className="mt-1 block w-full"
                                autoFocus
                                placeholder="Enter new password"
                            />
                            <InputError message={errors.password} />
                        </div>

                        {/* পাসওয়ার্ড কনফার্মেশন */}
                        <div className="grid gap-2">
                            <Label htmlFor="password_confirmation">
                                Confirm Password
                            </Label>
                            <Input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
                                onChange={(e) => setData('password_confirmation', e.target.value)}
                                autoComplete="new-password"
                                className="mt-1 block w-full"
                                placeholder="Confirm new password"
                            />
                            <InputError
                                message={errors.password_confirmation}
                                className="mt-2"
                            />
                        </div>

                        {/* সাবমিট বাটন */}
                        <Button
                            type="submit"
                            className="mt-4 w-full"
                            disabled={processing}
                            data-test="reset-password-button"
                        >
                            {processing && <Spinner />}
                            Reset password
                        </Button>
                    </div>
                )}
            </Form>
        </AuthLayout>
    );
}