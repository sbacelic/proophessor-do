<?php
/**
 * This file is part of prooph/proophessor-do.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ProophessorDo\Model\Todo;

use Prooph\ProophessorDo\Model\ValueObject;
use Rhumsaa\Uuid\Uuid;

final class TodoId implements ValueObject
{
    /**
     * @var Uuid
     */
    private $uuid;

    public static function generate(): TodoId
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $todoId): TodoId
    {
        return new self(Uuid::fromString($todoId));
    }

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function sameValueAs(ValueObject $other): bool
    {
        return get_class($this) === get_class($other) && $this->uuid->equals($other->uuid);
    }
}
