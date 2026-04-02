// Components
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
// ইম্পোর্ট পাথ অবশ্যই '@/routes/index' হতে হবে
import { logout, verificationSend as send } from '@/routes/index'; 
import { Form, Head } from '@inertiajs/react';

interface VerifyEmailProps {
    status?: string;
}

export default function VerifyEmail({ status }: VerifyEmailProps) {
    return (
        <AuthLayout
            title="Verify email"
            description="Please verify your email address by clicking on the link we just emailed to you."
        >
            <Head title="Email verification" />

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    A new verification link has been sent to the email address
                    you provided during registration.
                </div>
            )}

            {/* send.form() এখন সঠিকভাবে কল হবে */}
            <Form {...send.form()} className="space-y-6 text-center">
                {({ processing }) => (
                    <>
                        <div className="flex flex-col gap-4">
                            <Button disabled={processing} variant="secondary" type="submit">
                                {processing && <Spinner />}
                                Resend verification email
                            </Button>

                            <TextLink
                                href={logout().url} // .url প্রপার্টি ব্যবহার করা হয়েছে
                                className="mx-auto block text-sm"
                            >
                                Log out
                            </TextLink>
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}