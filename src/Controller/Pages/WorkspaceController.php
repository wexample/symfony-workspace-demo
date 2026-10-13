<?php

namespace Wexample\SymfonyWorkspaceDemo\Controller\Pages;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyHelpers\Controller\AbstractController;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyWorkspaceDemo\Traits\SymfonyWorkspaceDemoBundleClassTrait;

/**
 * The workspace of symfony-workspace: a slide editor reduced to what ties its
 * regions — a rail choosing a slide, the slide shown in the centre, an
 * inspector saying which one it is and moving to the next.
 */
#[Route(path: '/workspace/', name: 'workspace_demo_')]
final class WorkspaceController extends AbstractPagesController
{
    use SymfonyWorkspaceDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_SLIDE = 'slide';

    // The deck, in its order. A real editor reads its slides from a
    // repository; the demo only needs ids, its words being translations.
    private const array SLIDES = ['cover', 'agenda', 'figures', 'closing'];

    #[Route(path: '', name: self::ROUTE_INDEX)]
    public function index(): Response
    {
        return $this->renderPage(self::ROUTE_INDEX, [
            'slides' => self::SLIDES,
        ]);
    }

    /**
     * One slide, loaded into the centre of the editor when the rail chooses
     * it. Standalone it is an ordinary page.
     */
    #[Route(path: 'slide/{id}', name: self::ROUTE_SLIDE, options: AbstractController::ROUTE_OPTIONS_ONLY_EXPOSE)]
    public function slide(string $id): Response
    {
        $index = array_search($id, self::SLIDES, true);

        if (false === $index) {
            throw new NotFoundHttpException();
        }

        return $this->renderPage(self::ROUTE_SLIDE, [
            'slide' => $id,
            'position' => $index + 1,
            'count' => count(self::SLIDES),
        ]);
    }
}
