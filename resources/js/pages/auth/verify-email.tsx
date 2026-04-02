import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/auth-layout';
// এখানে পাথটি পরিবর্তন করে '@/routes/index' করা হয়েছে
import { logout as logoutRoute, verificationSend } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

export default function VerifyEmail({ status }: { status?: string }) {
    const isVerificationLinkSent = status === 'verification-link-sent';

    return (
        <AuthLayout
            title="Verify email"
            description="Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another."
        >
            <Head title="Email Verification" />

            {isVerificationLinkSent && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            )}

            <div className="mt-4 flex items-center justify-between">
                <Form {...verificationSend.form()}>
                    {({ processing }) => (
                        <Button disabled={processing}>
                            Resend Verification Email
                        </Button>
                    )}
                </Form>

                <Form {...logoutRoute.form()}>
                    <Button variant="link" as="button" type="submit" className="text-sm text-muted-foreground underline">
                        Log Out
                    </Button>
                </Form>
            </div>
        </AuthLayout>
    );
}