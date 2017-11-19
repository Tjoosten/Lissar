<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon; 
use Illuminate\Http\Response;
use Chrisbjr\Apiguard\{Models\Device, Events\ApiKeyAuthenticated};

/**
 * TODO: Register docblock
 */
class AuthenticateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request   The request data variable. 
     * @param  \Closure                  $next      Variable for entering the ctual request.
     * @param  string|null               $guard     The authencation guard for the request 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Example curl request: curl -X GET \http://domain.dev/api/test \-H 'x-authorization: api-key-here' 

        $apiKeyValue = $request->header(config('apiquard.header_key', 'X-Authorization'));

        $apiKey = app(config('apiguard.models.api_key', 'Chrisbjr\ApiGuard\Models\ApiKey'))
            ->where('key', $apiKeyValue)->first();

        if (empty($apiKey)) {                                 // Check if the correct key is used by the user. 
            return $this->unAuthorizedResponse($apiKeyValue); // Invalid key given. Redirect to Unauthorized view. 
        }

        // Update this api key's last_used_at and last_ip_address
        $apiKey->update(['last_used_at' => Carbon::now(), 'last_ip_address' => $request->ip()]);

        // Bind the user or object to the request
        // By doing this, we can now get the specified user through the request object in the controller using: 
        // $request->user(); 
        $request->setUserResolver(function () use ($apikeyable) {
            return $apikeyable;
        });

        // Attacj the apikey object to the request. 
        $request->apiKey = $apiKey;

        event(new ApiKeyAuthenticated($request, $apiKey));
        return $next($request);
    }

    /**
     * Class for displaying unauthorized requests.
     *
     * @param  string $apiKeyValue  The user given api key.
     * @return Response|Array
     */
    protected function unAuthorizedResponse($apiKeyValue) 
    {
        return response([
            'error' => [
                'code'      => Response::HTTP_UNAUTHORIZED,
                'http_code' => 'GEN-UNAUTHORIZED',
                'message'   => "UNAUTHORIZED",
            ],
        ], Response::HTTP_UNAUTHORIZED);
    }
}
