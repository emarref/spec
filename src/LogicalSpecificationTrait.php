<?php declare(strict_types=1);

namespace Emarref\Spec;

trait LogicalSpecificationTrait
{
    public function and(SpecificationInterface $right): SpecificationInterface
    {
        return new AndSpecification($this, $right);
    }

    public function andNot(SpecificationInterface $right): SpecificationInterface
    {
        return new AndNotSpecification($this, $right);
    }

    public function or(SpecificationInterface $right): SpecificationInterface
    {
        return new OrSpecification($this, $right);
    }

    public function orNot(SpecificationInterface $right): SpecificationInterface
    {
        return new OrNotSpecification($this, $right);
    }

    public function not(): SpecificationInterface
    {
        return new NotSpecification($this);
    }
}
