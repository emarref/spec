# Specification

This library implements the [Specification Pattern](https://en.wikipedia.org/wiki/Specification_pattern) for use in any project.

Create composable logic by encapsulating decisions in a class that adheres to the SpecificationInterface.

## Install

```shell
$ composer require emarref/spec
```

## Usage

Given the following specifications:

```php
<?php

use Emarref\Spec\SpecificationInterface;
use Emarref\Spec\LogicalSpecificationTrait;

class MorningSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    public function isSatisfiedBy($subject): bool
    {
        if (!$subject instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Subject must be a date time object.');
        }

        $hour = (int) $subject->format('G');

        return $hour < 12;
    }
}

class AfternoonSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    public function isSatisfiedBy($subject): bool
    {
        if (!$subject instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Subject must be a date time object.');
        }

        $hour = (int) $subject->format('G');

        return $hour > 12 && $hour < 18;
    }
}

class NightSpecification implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    public function isSatisfiedBy($subject): bool
    {
        if (!$subject instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Subject must be a date time object.');
        }

        $hour = (int) $subject->format('G');

        return $hour > 17;
    }
}
```

We can test if a date is in the morning:

```php
<?php

$morning = new \DateTime('8am');
$isMorning = new MorningSpecification();

$isMorning->isSatisfiedBy($morning); // true
```

or afternoon:

```php
<?php

$isAfternoon = new AfternoonSpecification();
$isAfternoon->isSatisfiedBy($morning); // false
```

We can chain specs together:

```php
<?php

$night = new \DateTime('11pm');

$isMorning->or($isAfternoon)->isSatisfiedBy($morning); // true
$isMorning->or($isAfternoon)->isSatisfiedBy($night); // false
```

Chaining can be deep:

```php
<?php

$isMorning->or($isAfternoon->andNot($isNight))->isSatisfiedBy($morning); // true
```
Business logic can be encapsulated by custom specs. Create a class that
implements the `Emarref\Spec\SpecificationInterface`. Use the `Emarref\Spec\LogicalSpecificationTrait`
to implement most of the boilerplate.

```php
<?php

class StoreIsOpen implements SpecificationInterface
{
    use LogicalSpecificationTrait;

    public function isSatisfiedBy($subject): bool
    {
        if (!$subject instanceof \DateTimeInterface) {
            throw new \InvalidArgumentException('Subject must be a date time object.');
        }

        $isMorning = new MorningSpec();
        $isAfternoon = new AfternoonSpec();

        return $isMorning->or($isAfternoon)->isSatisfiedBy($subject);
    }
}

$storeIsOpen = new StoreIsOpen();
$storeIsOpen->isSatisfiedBy(new DateTime('10am')); // true
$storeIsOpen->isSatisfiedBy(new DateTime('11pm')); // false
```
