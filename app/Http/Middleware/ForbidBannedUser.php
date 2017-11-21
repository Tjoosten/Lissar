<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * This file is part of Laravel Ban 
 * 
 * (c) Anton Komarev <a.komarev@cybercog.su>
 * 
 * For fukk copyright and license information, please view the LICENSE 
 * file that was distrivuted with this the package source code. 
 */

/**
 * Class ForbidBannedUser 
 * 
 * @package \App\Http\Middleware
 */
class ForbidBannedUser
{
    /**
     * The guard implementation. 
     * 
     *  @var \Illuminate\Contracts\Auth\Guard $auth
     */
    protected $auth; 

    /**
     * ForbidBannedUser Constructor 
     * 
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws \Exception
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user(); 

        if ($user && $user->isBanned()) {
            return redirect()->back()->withInput()->withErrors([
                'login' => 'Je account is geblokkeerd door een administrator.'
            ]);
        }

        return $next($request);
    }
}
