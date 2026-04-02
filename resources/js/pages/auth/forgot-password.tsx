import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// নিশ্চিত করুন যে '@/routes/index' থেকে passwordRoute সঠিকভাবে এক্সপোর্ট করা আছে
import { password as passwordRoute } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

interface ForgotPasswordProps {
    status?: string;
}

export default function ForgotPassword({ status }: ForgotPasswordProps) {
    return (
        <AuthLayout
            title="Forgot password"
            description="Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."
        >
            <Head title="Forgot password" />

            {/* সাকসেস মেসেজ দেখানোর জন্য */}
            {status && (
                <div className="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                    {status}
                </div>
            )}

            <Form
                {...passwordRoute.forgot.send.form()} // এখানে আপনার রাউট কনফিগ অনুযায়ী কল হবে
                className="space-y-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                value={data.email || ''} // ডাটা বাইন্ডিং নিশ্চিত করা হয়েছে
                                className="mt-1 block w-full"
                                autoFocus
                                onChange={(e) => setData('email', e.target.value)}
                                placeholder="email@example.com"
                                required
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                {processing && <Spinner className="mr-2 h-4 w-4" />}
                                Email password reset link
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}