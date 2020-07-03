<?php declare(strict_types=1);

namespace Emarref\Spec;

class NotSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    private SpecificationInterface $wrapped;

    public function __construct(SpecificationInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * @param mixed $subject
     *
     * @return bool
     */
    public function isSatisfiedBy($subject): bool
    {
        return !$this->wrapped->isSatisfiedBy($subject);
    }
}
