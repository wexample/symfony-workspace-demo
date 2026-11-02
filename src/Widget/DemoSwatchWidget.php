<?php

namespace Wexample\SymfonyWorkspaceDemo\Widget;

use Wexample\SymfonyWorkspace\Interface\WorkspaceWidgetInterface;

/**
 * The last colour told on the board, shown large: a widget hearing another.
 */
final class DemoSwatchWidget implements WorkspaceWidgetInterface
{
    private const string DOMAIN = 'WexampleSymfonyWorkspaceDemoBundle.pages.workspace.composable::widget.swatch.';

    public function getName(): string
    {
        return 'demo-swatch';
    }

    public function getLabel(): string
    {
        return self::DOMAIN.'label';
    }

    public function getDescription(): ?string
    {
        return self::DOMAIN.'description';
    }

    public function getIcon(): ?string
    {
        return 'ph:bold/square';
    }

    public function getView(): string
    {
        return '@WexampleSymfonyWorkspaceDemoBundle/components/demo-widget-swatch';
    }
}
