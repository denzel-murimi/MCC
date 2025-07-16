<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Mail\VerifySubscriptionEmail;
use App\Models\MailList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate input
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "message" => "required",
        ]);

        try {
            Mail::to(config("mail.from.support"))->queue(
                new ContactForm(
                    name: $request->name,
                    email: $request->email,
                    content: $request->message,
                ),
            );

            return back()->with("success", "Message sent successfully!");
        } catch (\Throwable $th) {
            return back()->with(
                "error",
                "Whoops!! Something happened!...Try again later",
            );
        }
    }

    public function subscribe(Request $request)
    {
        try {
            $validator = Validator::make($request->only("email"), [
                "email" => "required|email|unique:mail_lists,email",
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->with("error", $validator->errors()->first())
                    ->withInput($request->all());
            }

            $email = $validator->validated();

            $subscriber = MailList::create($email);

            Mail::to($request->email)->send(
                new VerifySubscriptionEmail($subscriber),
            );

            return redirect()
                ->back()
                ->with([
                    "success" => "You have subscribed to our newsletter!",
                    "info" => "Please check your email for a verification link",
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with(
                    "error",
                    "Whoops!! Something happened!...Try again later",
                );
        }
    }

    public function verify($token)
    {
        $subscriber = MailList::where("verification_token", $token)->first();

        if (!$subscriber) {
            return redirect("/")->with(
                "error",
                "Invalid or expired verification link.",
            );
        }

        $subscriber->update([
            "email_is_verified" => true,
            "verification_token" => null, // Remove token after verification
        ]);

        return redirect("/")->with(
            "success",
            "Newsletter Subscription confirmed!",
        );
    }
}
