<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    public const ADMIN_ROLE = 'admin';

    public const EMPLOYEE_ROLE = 'employee';

    public const CUSTOMER_ROLE = 'customer';
}
