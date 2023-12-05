<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case User = 1;
    case Instructor = 2;
    case Admin = 3;
}
