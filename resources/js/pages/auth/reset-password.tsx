import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
/** * পরিবর্তন: '@/routes/index' থেকে সরাসরি resetPassword ইম্পোর্ট করা হয়েছে।
 */
import { resetPassword } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function ResetPassword({
    token,
    email,
}: {
    token: string;
    email: string;
}) {
    return (
        <AuthLayout
            title="Reset password"
            description="Please enter your new password below to reset your account password."
        >
            <Head title="Reset Password" />

            <Form
                // আপনার নতুন index.ts এর স্ট্রাকচার অনুযায়ী সরাসরি .form() কল করা হয়েছে
                {...resetPassword.form()}
                onBefore={(form) => {
                    form.setData('token', token);
                    form.setData('email', email);
                }}
                className="space-y-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="password">New Password</Label>

                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                autoComplete="new-password"
                                onChange={(e) => setData('password', e.target.value)}
                                required
                            />

                            <InputError message={errors.password} className="mt-2" />
                        </div>

                        <div className="grid gap-2">
                            <Label htmlFor="password_confirmation">
                                Confirm Password
                            </Label>

                            <Input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                value={data.password_confirmation}
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

                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                Reset Password
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}