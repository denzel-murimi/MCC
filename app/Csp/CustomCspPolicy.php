<?php

namespace App\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Presets\Basic;

class CustomCspPolicy extends Basic
{
    public function configure(Policy $policy): void
    {
        parent::configure($policy);

        $policy
            ->add(Directive::SCRIPT, [
                'https://esm.sh',
                Keyword::UNSAFE_EVAL
            ])

            ->add(Directive::SCRIPT_ELEM, [
                Keyword::SELF,
                'https://fonts.bunny.net',
                'https://esm.sh',
            ])

            ->add(Directive::IMG, [
                'https://public-files-paystack-prod.s3.eu-west-1.amazonaws.com',
                'data:', // embedding base64 images
                'https://cdn.brandfetch.io',
            ])

            ->add(Directive::CONNECT, [
                'https://api.paystack.co',
            ])

            ->add(Directive::FRAME, [
                'https://sandbox.nowpayments.io',
            ])

            ->add(Directive::FONT, [
                'https://fonts.bunny.net',
                'data:',
            ])

            ->add(Directive::STYLE, [
                'https://fonts.bunny.net',
            ])
            ->add(Directive::SCRIPT_ATTR, [
                'https://fonts.bunny.net',
            ]);
    }
}
