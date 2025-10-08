<?php

namespace App\Validator;

use App\Entity\Post;
use InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostValidator
{
    public function __construct(
        private ValidatorInterface $validator,
    )
    {
        
    }
    
    public function validate(Post $post): void
    {
        $errors = $this->validator->validate($post);

        if ($errors->count() > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }
        
            throw new InvalidArgumentException(json_encode($errors));
        }
    }
}