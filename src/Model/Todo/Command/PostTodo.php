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

namespace Prooph\ProophessorDo\Model\Todo\Command;

use Assert\Assertion;
use Prooph\ProophessorDo\Model\User\UserId;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;
use Prooph\ProophessorDo\Model\Todo\TodoId;

final class PostTodo extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public static function forUser(string $assigneeId, string $text, string $todoId): PostTodo
    {
        return new self([
            'assignee_id' => (string)$assigneeId,
            'todo_id' => (string)$todoId,
            'text' => (string)$text
        ]);
    }

    public function todoId(): TodoId
    {
        return TodoId::fromString($this->payload['todo_id']);
    }

    public function assigneeId(): UserId
    {
        return UserId::fromString($this->payload['assignee_id']);
    }

    public function text(): string
    {
        return $this->payload['text'];
    }

    protected function setPayload(array $payload): void
    {
        Assertion::keyExists($payload, 'assigne_id');
        Assertion::uuid($payload['assigne_id']);
        Assertion::keyExists($payload, 'todo_id');
        Assertion::uuid($payload['assigne_id']);
        Assertion::keyExists($payload, 'text');
        Assertion::uuid($payload['assigne_id']);

        $this->payload = $payload;
    }


}
