<?php declare(strict_types=1);

namespace Emarref\Spec;

class OrNotSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    private SpecificationInterface $left;

    private SpecificationInterface $right;

    public function __construct(SpecificationInterface $left, SpecificationInterface $right)
    {
        $this->left  = $left;
        $this->right = $right;
    }

    /**
     * @param mixed $subject
     *
     * @return bool
     */
    public function isSatisfiedBy($subject): bool
    {
        return $this->left->isSatisfiedBy($subject) || !$this->right->isSatisfiedBy($subject);
    }
}
