<?php

namespace App\Enums;

enum UserEnum:int
{
    case Admin = 10;
    case Student = 20;
    case Instructor = 30;
}
