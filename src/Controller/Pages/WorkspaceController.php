<?php

namespace Wexample\SymfonyWorkspaceDemo\Controller\Pages;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Wexample\SymfonyHelpers\Controller\AbstractController;
use Wexample\SymfonyHelpers\Helper\VariableHelper;
use Wexample\SymfonyLoader\Controller\AbstractPagesController;
use Wexample\SymfonyWorkspaceDemo\Traits\SymfonyWorkspaceDemoBundleClassTrait;

/**
 * Screens made of regions, each page one arrangement beside the tree moving
 * between them: three regions, a sized one, a row of columns wider than the
 * screen, a wall of tiles, and a slide editor whose regions share what is
 * chosen in one of them.
 */
#[Route(path: '/workspace/', name: 'workspace_demo_')]
final class WorkspaceController extends AbstractPagesController
{
    use SymfonyWorkspaceDemoBundleClassTrait;

    final public const string ROUTE_INDEX = VariableHelper::INDEX;

    final public const string ROUTE_FIXED = 'fixed';

    final public const string ROUTE_COLUMNS = 'columns';

    final public const string ROUTE_DASHBOARD = 'dashboard';

    final public const string ROUTE_DASHBOARD_PANEL = 'dashboard_panel';

    final public const string ROUTE_SLIDES = 'slides';

    final public const string ROUTE_SLIDE = 'slide';

    // The longest a panel may be asked to keep the visitor waiting.
    private const int DASHBOARD_PANEL_DELAY_MAX = 5;

    // The deck, in its order. A real editor reads its slides from a
    // repository; the demo only needs ids, its words being translations.
    private const array SLIDES = ['cover', 'agenda', 'figures', 'closing'];

    #[Route(path: '', name: self::ROUTE_INDEX)]
    public function index(): Response
    {
        return $this->renderPage(self::ROUTE_INDEX);
    }

    #[Route(path: self::ROUTE_FIXED, name: self::ROUTE_FIXED)]
    public function fixed(): Response
    {
        return $this->renderPage(self::ROUTE_FIXED);
    }

    #[Route(path: self::ROUTE_COLUMNS, name: self::ROUTE_COLUMNS)]
    public function columns(): Response
    {
        return $this->renderPage(self::ROUTE_COLUMNS);
    }

    #[Route(path: self::ROUTE_DASHBOARD, name: self::ROUTE_DASHBOARD)]
    public function dashboard(): Response
    {
        return $this->renderPage(self::ROUTE_DASHBOARD);
    }

    /**
     * A panel of the dashboard, loaded into one of its embeds. Asked with
     * `delay`, it answers that many seconds late on purpose: the spinner an
     * embed shows while a slow page is on its way is what the demo is for.
     */
    #[Route(path: 'dashboard-panel', name: self::ROUTE_DASHBOARD_PANEL, options: AbstractController::ROUTE_OPTIONS_ONLY_EXPOSE)]
    public function dashboardPanel(Request $request): Response
    {
        $delay = min(self::DASHBOARD_PANEL_DELAY_MAX, max(0, (float) $request->query->get('delay', 0)));

        if ($delay > 0) {
            usleep((int) ($delay * 1_000_000));
        }

        return $this->renderPage(self::ROUTE_DASHBOARD_PANEL, [
            'service' => (string) $request->query->get('service', 'api'),
            'delay' => $delay,
        ]);
    }

    #[Route(path: self::ROUTE_SLIDES, name: self::ROUTE_SLIDES)]
    public function slides(): Response
    {
        return $this->renderPage(self::ROUTE_SLIDES, [
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
