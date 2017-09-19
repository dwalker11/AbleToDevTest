<?php

namespace App\Http\Middleware;

use Closure;

class ForceSurveyForNewUsers
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
      // The authenticated user does not have a survey record
      $user_id = \Auth::id();
      $results = \DB::table('surveys')->where('user_id', '=', $user_id)->get();

      if ($results->isEmpty()) {
          return redirect('/surveys/create');
      }

      return $next($request);
    }
}
