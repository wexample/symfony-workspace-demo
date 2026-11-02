<?php

namespace Wexample\SymfonyWorkspaceDemo\Widget;

use Wexample\SymfonyWorkspace\Interface\WorkspaceWidgetInterface;

/**
 * A row of colours: the one pressed is told to the board, as `color`.
 */
final class DemoColorWidget implements WorkspaceWidgetInterface
{
    private const string DOMAIN = 'WexampleSymfonyWorkspaceDemoBundle.pages.workspace.composable::widget.color.';

    public function getName(): string
    {
        return 'demo-color';
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
        return 'ph:bold/palette';
    }

    public function getView(): string
    {
        return '@WexampleSymfonyWorkspaceDemoBundle/components/demo-widget-color';
    }
}
