<?php declare(strict_types=1);

namespace Emarref\Spec\Test;

use Emarref\Spec\NotSpecification;
use Emarref\Spec\SpecificationInterface;
use PHPUnit\Framework\TestCase;

class NotSpecificationTest extends TestCase
{
    /**
     * @dataProvider getData
     *
     * @param SpecificationInterface $wrapped
     * @param bool                   $expected
     * @param string                 $message
     */
    public function testNotSpecification(SpecificationInterface $wrapped, bool $expected, string $message): void
    {
        $spec = new NotSpecification($wrapped);
        $this->assertSame($expected, $spec->isSatisfiedBy('Anything'), $message);
    }

    public function getData(): array
    {
        return [
            [new FalseSpecification(), true, 'Negative spec incorrectly doesn\'t satisfy'],
            [new TrueSpecification(), false, 'Affirmative spec incorrectly satisfies'],
        ];
    }
}
