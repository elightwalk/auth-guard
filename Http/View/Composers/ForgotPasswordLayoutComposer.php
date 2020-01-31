<?php

namespace Elightwalk\AuthGuard\Http\View\Composers;

use Illuminate\View\View;

class ForgotPasswordLayoutComposer
{
    /**
     * The reset url implementation.
     *
     */
    protected $resetUrl;

    /**
     * Create a new master layout composer.
     *
     */
    public function __construct()
    {
        $this->resetUrl = 'reset/password/';
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('reset_url', $this->resetUrl);
    }
}
