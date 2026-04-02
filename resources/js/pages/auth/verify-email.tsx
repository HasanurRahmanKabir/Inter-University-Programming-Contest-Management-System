import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// এখানে নিশ্চিতভাবে '@/routes/index' ইম্পোর্ট করা হয়েছে এবং সঠিক নাম (verifyEmail) ব্যবহার করা হয়েছে
import { logout, verifyEmail } from '@/routes/index'; 
import { Form, Head, Link } from '@inertiajs/react';

export default function VerifyEmail({ status }: { status?: string }) {
    return (
        <AuthLayout
            title="Verify email"
            description="Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another."
        >
            <Head title="Email Verification" />

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            )}

            <div className="mt-4 flex items-center justify-between">
                <Form {...verifyEmail.send.form()}>
                    {({ processing }) => (
                        <Button disabled={processing}>
                            {processing && <Spinner className="mr-2 h-4 w-4" />}
                            Resend verification email
                        </Button>
                    )}
                </Form>

                <Link
                    {...logout().link()}
                    className="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Log Out
                </Link>
            </div>
        </AuthLayout>
    );
}