<?php declare(strict_types=1);

namespace Emarref\Spec;

interface SpecificationInterface
{
    public function and(SpecificationInterface $right): SpecificationInterface;

    public function andNot(SpecificationInterface $right): SpecificationInterface;

    public function or(SpecificationInterface $right): SpecificationInterface;

    public function orNot(SpecificationInterface $right): SpecificationInterface;

    public function not(): SpecificationInterface;

    /**
     * @param mixed $subject
     *
     * @return bool
     */
    public function isSatisfiedBy($subject): bool;
}
