import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
// নিশ্চিত করা হয়েছে ইম্পোর্ট পাথ '@/routes/index'
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
            description="Please enter your new password below to reset your account password."
        >
            <Head title="Reset password" />

            <Form
                // আপনার index.ts এর passwordRoute অবজেক্ট অনুযায়ী মেথড কল করা হয়েছে
                {...passwordRoute.reset.update.form()}
                // পেজ লোড হওয়ার সময় ডিফল্ট ডাটা হিসেবে ইমেইল ও টোকেন পাস করা হয়েছে
                data={{
                    token: token,
                    email: email,
                    password: '',
                    password_confirmation: '',
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
                                autoFocus
                                onChange={(e) => setData('password', e.target.value)}
                                placeholder="New password"
                                required
                            />
                            <InputError message={errors.password} />
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
                                placeholder="Confirm password"
                                required
                            />
                            <InputError message={errors.password_confirmation} />
                        </div>

                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                {processing ? 'Resetting...' : 'Reset password'}
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}