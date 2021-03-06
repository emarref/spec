<?php declare(strict_types=1);

namespace Emarref\Spec\Test;

use Emarref\Spec\LogicalSpecificationTrait;
use Emarref\Spec\SpecificationInterface;

class FalseSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    public function isSatisfiedBy($subject): bool
    {
        return false;
    }
}
