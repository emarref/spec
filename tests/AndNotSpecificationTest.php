<?php declare(strict_types=1);

namespace Emarref\Spec\Test;

use Emarref\Spec\AndNotSpecification;
use Emarref\Spec\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class AndNotSpecificationTest extends TestCase
{
    /**
     * @dataProvider getData
     *
     * @param SpecificationInterface $left
     * @param SpecificationInterface $right
     * @param bool                   $expected
     * @param string                 $message
     */
    public function testAndNotSpecification(SpecificationInterface $left, SpecificationInterface $right, bool $expected, string $message): void
    {
        $spec = new AndNotSpecification($left, $right);
        $this->assertSame($expected, $spec->isSatisfiedBy('Anything'), $message);
    }

    public function getData(): array
    {
        return [
            [new TrueSpecification(), new TrueSpecification(), false, 'Two affirmative specs incorrectly satisfy'],
            [new TrueSpecification(), new FalseSpecification(), true, 'Left affirmative, right negative specs incorrectly don\'t satisfy'],
            [new FalseSpecification(), new TrueSpecification(), false, 'Left negative, right affirmative specs incorrectly satisfy'],
            [new FalseSpecification(), new FalseSpecification(), false, 'Two negative specs incorrectly satisfy'],
        ];
    }
}
