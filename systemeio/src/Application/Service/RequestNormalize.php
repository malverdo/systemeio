<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Component\HttpFoundation\Request;

final class RequestNormalize
{
    public function normalize(Request $request)
    {
        $content = [];

        if ($request->getMethod() === 'POST') {
            $content = $request->getContent();
        }

        return json_decode($content, true);
    }
}
