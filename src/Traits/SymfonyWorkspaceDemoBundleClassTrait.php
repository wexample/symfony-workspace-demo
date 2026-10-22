<?php

namespace Wexample\SymfonyWorkspaceDemo\Traits;

use Wexample\SymfonyHelpers\Traits\BundleClassTrait;
use Wexample\SymfonyWorkspaceDemo\WexampleSymfonyWorkspaceDemoBundle;

trait SymfonyWorkspaceDemoBundleClassTrait
{
    use BundleClassTrait;

    public static function getBundleClassName(): string
    {
        return WexampleSymfonyWorkspaceDemoBundle::class;
    }
}
