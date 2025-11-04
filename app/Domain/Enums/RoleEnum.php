<?php

namespace App\Domain\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Instructor = 'instructor';
    case Participant = 'participant';
    case Corporate = 'corporate';
    case Student = 'student';
    case User = 'user';

    /**
     * Return all role values.
     *
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(static fn (self $case) => $case->value, self::cases());
    }
}
