<?php
declare(strict_types=1);

function __(string $key): string
{
    return Lang::get($key);
}
