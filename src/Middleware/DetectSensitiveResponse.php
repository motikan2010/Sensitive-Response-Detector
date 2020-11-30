<?php

namespace Motikan2010\SensitiveResponseDetector\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class DetectSensitiveResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ( !config('detector.enabled') ) {
            return $response;
        }

        // Check response
        if ( count($this->check($response->getContent())) > 0 ) {
            return $this->respond(config('detector.block'));
        }

        return $response;
    }

    private function check($responseContent)
    {
        $result = [];

        $patterns = config('detector.patterns');
        foreach ( $patterns as $pattern ) {
            if ( preg_match_all($pattern, $responseContent, $match) ) {
                $result[] = $match;
            }
        }

        return $result;
    }

    public function respond($response)
    {
        if ( $response['code'] == 200 ) {
            return '';
        }

        if ( $view = $response['view'] ) {
            return Response::view($view);
        }

        if ( $redirect = $response['redirect'] ) {
            return Redirect::to($redirect);
        }

        if ( $response['abort'] ) {
            abort($response['code'], trans('detector::responses.block.message'));
        }

        return Response::make(trans('detector::responses.block.message'), $response['code']);
    }

}
