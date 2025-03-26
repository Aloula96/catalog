<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class DemoRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
   
    }

    public function cash(string $value):string
    {
        return $value . "€";
    }
}
