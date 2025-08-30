<?php

namespace App\Http\Middleware;

use Closure;
use TrueFrame\Http\Request;
use TrueFrame\Http\Response;
use TrueFrame\Http\Middleware\MiddlewareInterface;
use TrueFrame\Session\SessionManager;

class StartSession implements MiddlewareInterface
{
    /**
     * The session manager instance.
     *
     * @var SessionManager
     */
    protected SessionManager $session;

    /**
     * Create a new session middleware.
     *
     * @param SessionManager $session
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->session->start();

        // Regenerate CSRF token if it doesn't exist (e.g., new session)
        if (!$this->session->has('_token')) {
            csrf_token(); // Calls the helper, which generates and puts if not exists
        }

        // Handle flash data from previous request
        $this->loadFlashData();

        $response = $next($request);

        // Store old input and flash data for the next request
        $this->storeFlashData($request);

        return $response;
    }

    /**
     * Load the flash data from the session.
     *
     * @return void
     */
    protected function loadFlashData(): void
    {
        // Move current flash data to be 'old' data for the current request
        // and clear it for the next request.
        $oldFlash = $this->session->get('_flash', []);
        $this->session->put('_old_flash', $oldFlash);
        $this->session->forget('_flash');

        $oldInput = $this->session->get('_old_input', []);
        $this->session->put('_old_input_current', $oldInput); // Make it available for current request
        $this->session->forget('_old_input');
    }

    /**
     * Store the flash data and old input for the next request.
     *
     * @param Request $request
     * @return void
     */
    protected function storeFlashData(Request $request): void
    {
        // Flash new data
        // Any data set via session()->flash() during this request is already in $_SESSION['_flash']

        // Re-flash old input if redirected back
        // This check is simplified, a real response object would have this method
        $response = session()->get('last_response');
        if ($response && in_array($response->getStatusCode(), [301, 302, 303, 307, 308])) {
            $this->session->flashInput($request->all());
        }

        // Clean up old_input from current request
        $this->session->forget('_old_input_current');
    }
}