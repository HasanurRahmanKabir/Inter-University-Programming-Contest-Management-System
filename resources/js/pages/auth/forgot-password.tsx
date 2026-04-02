import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// এখানে ইম্পোর্ট পাথ এবং নাম ঠিক করা হয়েছে
import { password as passwordRoute } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function ForgotPassword({ status }: { status?: string }) {
    return (
        <AuthLayout
            title="Forgot password"
            description="Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."
        >
            <Head title="Forgot password" />

            {status && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    {status}
                </div>
            )}

            <Form
                // passwordRoute.form() ব্যবহার করা হয়েছে
                {...passwordRoute.form()}
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
                                value={data.email}
                                className="mt-1 block w-full"
                                autoFocus
                                onChange={(e) => setData('email', e.target.value)}
                                placeholder="email@example.com"
                            />
                            <InputError message={errors.email} />
                        </div>

                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                {processing && <Spinner />}
                                Email password reset link
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}