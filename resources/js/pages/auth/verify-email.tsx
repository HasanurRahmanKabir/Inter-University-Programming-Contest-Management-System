import { Button } from '@/components/ui/button';
import AuthLayout from '@/layouts/auth-layout';
// এখানে নিশ্চিতভাবে '@/routes/index' ব্যবহার করা হয়েছে
import { logout, verificationSend } from '@/routes/index'; 
import { Head, useForm } from '@inertiajs/react';
import { FormEvent } from 'react';

export default function VerifyEmail({ status }: { status?: string }) {
    const { post, processing } = useForm({});

    const submit = (e: FormEvent) => {
        e.preventDefault();

        // verificationSend.form() ব্যবহার করা হয়েছে আপনার routes/index.ts অনুযায়ী
        post(verificationSend.form().action);
    };

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

            <form onSubmit={submit} className="space-y-6">
                <div className="flex items-center justify-between">
                    <Button disabled={processing}>Resend Verification Email</Button>

                    <button
                        type="button"
                        onClick={() => post(logout().url)}
                        className="text-sm text-muted-foreground underline hover:text-primary"
                    >
                        Log Out
                    </button>
                </div>
            </form>
        </AuthLayout>
    );
}