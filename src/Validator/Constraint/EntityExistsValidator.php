<?php 

namespace App\Validator\Constraint;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EntityExistsValidator extends ConstraintValidator
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
        
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        $category = $this->em
            ->getRepository(Category::class)
            ->find($value);
        
        if (!$category) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ entity }}', $constraint->entity)
                ->setParameter('{{ id }}', $value)
                ->addViolation();
        }
    }
}