<?php
namespace Src\UI\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Support\Facades\Validator;
use Src\Application\Exceptions\InvalidRequestException;

abstract class AbstractRequest extends BaseRequest
{

    private static $messages = [
        'uuid' => 'The :attribute with value :input is not uuid.'
    ];

    /**
     * @throws InvalidRequestException
     */
    public function __construct()
    {
        parent::__construct(
            app(BaseRequest::class)->query->all(),
            app(BaseRequest::class)->request->all(),
            app(BaseRequest::class)->attributes->all(),
            app(BaseRequest::class)->cookies->all(),
            app(BaseRequest::class)->files->all(),
            app(BaseRequest::class)->server->all(),
            app(BaseRequest::class)->content,
        );

        $this->json()->replace(app(BaseRequest::class)->json()->all());
        $this->validate();
        $this->validateHeaders();



    }

   abstract protected function getRules() :array;
   abstract protected function getHeadersRules() :array;

    abstract protected function getHeadersMessages() :array;

   protected function getMessages() :array
   {
       return self::$messages;
   }


    /**
     * @throws InvalidRequestException
     */
    public function  validate(): void
    {
        $validator = Validator::make($this->json()->all(), $this->getRules(), $this->getMessages());

        if ($validator->fails()) {
            throw new InvalidRequestException($validator);
        }
    }

    public function validateHeaders(): void
    {
        $validator = Validator::make($this->headers->all(), $this->getHeadersRules(), $this->getHeadersMessages());

        if ($validator->fails()) {
            throw new InvalidRequestException($validator);
        }
    }

}