<?php

namespace App\Validators;
use App\Exceptions\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CustomValidator
{
    protected array $attributes;
    protected \Illuminate\Contracts\Validation\Validator $validator;

    /**
     * @throws Exception
     */
    public function __construct(array $attributes, array $rules)
    {
        $this->validator = Validator::make($attributes, $rules);
        $this->showErrors()
            ->validateAttributes();
    }

    public function showErrors(): CustomValidator
    {
        if ($this->validator->fails()) {
            $validationException = new ValidationException();
            $validationException->setValidationError($this->validator->errors()->toArray());

            throw $validationException;
        }
        return $this;
    }

    public function validateAttributes(): CustomValidator
    {
        $this->attributes = $this->validator->validated();
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
