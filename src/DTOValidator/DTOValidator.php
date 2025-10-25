<?php

namespace App\DTOValidator;

use App\DTO\Input\Inteface\InputDTOInterface;
use App\DTO\Input\Post\StorePostInputDTO;
use App\Entity\Post;
use App\Exception\ValidateException;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DTOValidator
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
        
    }
    
    public function validate(InputDTOInterface $post): void
    {
        $errors = $this->validator->validate($post);

        if ($errors->count() > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            throw new ValidateException($messages);
        }
    }
}