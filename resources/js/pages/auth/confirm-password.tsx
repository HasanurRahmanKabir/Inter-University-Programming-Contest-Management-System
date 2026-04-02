import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// এখানে নিশ্চিতভাবে '@/routes/index' ইম্পোর্ট করা হয়েছে
import { confirmPassword } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function ConfirmPassword() {
    return (
        <AuthLayout
            title="Confirm your password"
            description="This is a secure area of the application. Please confirm your password before continuing."
        >
            <Head title="Confirm password" />

            <Form
                {...confirmPassword.form()}
                resetOnSuccess={['password']}
                className="space-y-6"
            >
                {({ data, setData, processing, errors }) => (
                    <>
                        <div className="grid gap-2">
                            <Label htmlFor="password">Password</Label>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                autoFocus
                                onChange={(e) => setData('password', e.target.value)}
                                placeholder="Enter your password"
                                required
                            />
                            <InputError message={errors.password} />
                        </div>

                        <div className="flex items-center justify-end">
                            <Button className="w-full" disabled={processing}>
                                {processing && <Spinner className="mr-2 h-4 w-4" />}
                                Confirm
                            </Button>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}