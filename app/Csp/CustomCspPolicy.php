<?php

namespace App\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

class CustomCspPolicy implements Preset
{
    public function configure(Policy $policy): void
    {
        $policy
            ->add(Directive::DEFAULT, [
                Keyword::SELF,
            ])

            ->add(Directive::SCRIPT, [
                Keyword::SELF,
                'https://cdnjs.cloudflare.com',
            ])

            ->add(Directive::IMG, [
                Keyword::SELF,
                'https://public-files-paystack-prod.s3.eu-west-1.amazonaws.com',
                'https://cdnjs.cloudflare.com',
                'data:', // embedding base64 images
            ])

            ->add(Directive::CONNECT, [
                Keyword::SELF,
                'https://api.paystack.co',
                'https://sandbox.nowpayments.io'
            ])

            ->add(Directive::FONT, [
                Keyword::SELF,
                'https://cdnjs.cloudflare.com',
            ])

            ->add(Directive::STYLE, [
                Keyword::SELF,
                'https://cdnjs.cloudflare.com',
                Keyword::UNSAFE_INLINE,
            ]);
    }
}
