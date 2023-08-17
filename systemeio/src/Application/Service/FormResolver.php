<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FormResolver
{
    public function resolver(FormInterface $form): void
    {
        $message = '';

        $formErrors = $form->getErrors(true, false);
        foreach ($formErrors as $formError) {
            if ($formError instanceof FormErrorIterator) {
                $subForm = $formError->getForm();
                $key = $subForm->getName();
                $subErrors = (string)$subForm->getErrors(true, false);
                $message .= sprintf('| %s:%s', $key, $subErrors);
            } else {
                $key = $formError->getOrigin()->getName();
                $message .= sprintf('| %s:%s', $key, $formError->getMessage());
            }
        }
        if (!empty($message)) {
            throw new BadRequestHttpException($message);
        }
    }
}