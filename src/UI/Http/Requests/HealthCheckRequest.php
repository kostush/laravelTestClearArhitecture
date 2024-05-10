<?php
namespace Src\UI\Http\Requests;

use Illuminate\Http\Request;


class HealthCheckRequest extends AbstractRequest
{
    /**
     * @var string[]
     */
    protected $rules = [];

    /**
     * @var string[]
     */
    protected $messages = [
        'uuid' => 'The :attribute with value :input is not uuid.'
    ];

    /**
     * @return string
     */
    public function xOwner(): string
    {
        return (string) $this->header('X-Owner');
    }

    /**
     * @return string[]
     */
    protected function getRules(): array
    {
        return $this->rules;
    }

    /** alternative way to check header instead middleware
     * @return string[]
     */
    protected function getHeadersRules(): array
    {
        return []; //  'x-Owner' => 'required'
    }

    protected function getHeadersMessages(): array
    {
        return ['required' => 'The :attribute HEADER with is REQUIRED.'];
    }
}