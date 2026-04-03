import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
/**
 * @/routes/index থেকে resetPassword রাউটটি ইম্পোর্ট করা হয়েছে।
 * এটি এখন আপনার নতুন index.ts স্ট্রাকচার অনুযায়ী কাজ করবে।
 */
import { resetPassword } from '@/routes/index';
import { Form, Head } from '@inertiajs/react';

interface ResetPasswordProps {
    token: string;
    email: string;
}

export default function ResetPassword({ token, email }: ResetPasswordProps) {
    return (
        <AuthLayout
            title="Reset password"
            description="Please enter your new password below to reset your account password."
        >
            <Head title="Reset Password" />

            <Form
                /**
                 * আপনার নতুন index.ts অনুযায়ী {...resetPassword.form()} ব্যবহার করলে 
                 * action এবং method অটোমেটিক সেট হয়ে যাবে।
                 */
                {...resetPassword.form()}
                onBefore={(form) => {
                    /**
                     * ফর্ম সাবমিট হওয়ার আগে টোকেন এবং ইমেইল ডেটাতে যুক্ত করে দেওয়া হচ্ছে।
                     */
                    form.setData('token', token);
                    form.setData('email', email);
                }}
                className="space-y-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        {/* New Password Field */}
                        <div className="grid gap-2">
                            <Label htmlFor="password">New Password</Label>

                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password || ''}
                                className="mt-1 block w-full"
                                autoComplete="new-password"
                                onChange={(e) => setData('password', e.target.value)}
                                required
                                autoFocus
                            />

                            <InputError message={errors.password} className="mt-2" />
                        </div>

                        {/* Confirm Password Field */}
                        <div className="grid gap-2">
                            <Label htmlFor="password_confirmation">
                                Confirm Password
                            </Label>

                            <Input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation || ''}
                                className="mt-1 block w-full"
                                autoComplete="new-password"
                                onChange={(e) =>
                                    setData('password_confirmation', e.target.value)
                                }
                                required
                            />

                            <InputError
                                message={errors.password_confirmation}
                                className="mt-2"
                            />
                        </div>

                        {/* Submit Button */}
                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                {processing ? 'Resetting...' : 'Reset Password'}
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}