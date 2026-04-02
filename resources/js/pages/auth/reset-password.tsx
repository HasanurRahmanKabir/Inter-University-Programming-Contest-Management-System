import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/auth-layout';
// এখানে ইম্পোর্ট পাথ ঠিক করা হয়েছে
import { password as passwordRoute } from '@/routes/index'; 
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
            <Head title="Reset password" />

            <Form
                // passwordRoute.reset.update.form() ব্যবহার করা হয়েছে
                {...passwordRoute.reset.update.form()}
                className="space-y-6"
            >
                {({ data, setData, processing, errors }) => {
                    // টোকেন এবং ইমেইল সেট করা নিশ্চিত করছি
                    data.token = token;
                    data.email = email;

                    return (
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
                                />
                                <InputError message={errors.password_confirmation} />
                            </div>

                            <div className="flex items-center justify-end">
                                <Button className="w-full" disabled={processing}>
                                    Reset password
                                </Button>
                            </div>
                        </>
                    );
                }}
            </Form>
        </AuthLayout>
    );
}