<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            $messages = array();
            foreach ($errors as $element) {
                foreach ($element as $element_error) {
                    $messages[] = ["message" => $element_error];
                }
            }
            $response['messages'] = $messages;
            $response['status'] = 'error';
            return new JsonResponse($response, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
