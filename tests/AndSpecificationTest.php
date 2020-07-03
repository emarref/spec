<?php declare(strict_types=1);

namespace Emarref\Spec\Test;

use Emarref\Spec\AndSpecification;
use Emarref\Spec\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class AndSpecificationTest extends TestCase
{
    /**
     * @dataProvider getData
     *
     * @param SpecificationInterface $left
     * @param SpecificationInterface $right
     * @param bool                   $expected
     * @param string                 $message
     */
    public function testAndSpecification(SpecificationInterface $left, SpecificationInterface $right, bool $expected, string $message): void
    {
        $spec = new AndSpecification($left, $right);
        $this->assertSame($expected, $spec->isSatisfiedBy('Anything'), $message);
    }

    public function getData(): array
    {
        return [
            [new TrueSpecification(), new TrueSpecification(), true, 'Two affirmative specs incorrectly don\'t satisfy'],
            [new TrueSpecification(), new FalseSpecification(), false, 'Left affirmative, right negative specs incorrectly satisfy'],
            [new FalseSpecification(), new TrueSpecification(), false, 'Left negative, right affirmative specs incorrectly satisfy'],
            [new FalseSpecification(), new FalseSpecification(), false, 'Two negative specs incorrectly satisfy'],
        ];
    }
}
