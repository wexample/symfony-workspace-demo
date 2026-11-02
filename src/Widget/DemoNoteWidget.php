<?php

namespace Wexample\SymfonyWorkspaceDemo\Widget;

use Wexample\SymfonyWorkspace\Interface\WorkspaceWidgetInterface;

/**
 * A note kept with the zone: its text is the zone's config, saved with the arrangement.
 */
final class DemoNoteWidget implements WorkspaceWidgetInterface
{
    private const string DOMAIN = 'WexampleSymfonyWorkspaceDemoBundle.pages.workspace.composable::widget.note.';

    public function getName(): string
    {
        return 'demo-note';
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
        return 'ph:bold/note-pencil';
    }

    public function getView(): string
    {
        return '@WexampleSymfonyWorkspaceDemoBundle/components/demo-widget-note';
    }
}
