<?php

namespace Milestone\SDDS\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class SDDS
{
    private static $domains;
    public function __construct()
    {
        self::$domains = Cache::rememberForever(config('sdds.cache'),function(){ return \Milestone\SDDS\Model\SDDS::where('active','Y')->get()->keyBy->domain->toArray(); });
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hosts = explode('.',$request->getHost()); array_pop($hosts); $domain = implode('.',$hosts); $domains = self::$domains;
        if(array_key_exists($domain,$domains)){
            $details = Arr::only($domains[$domain],['database','username','password']);
            $settings = []; foreach($details as $key => $value) $settings['database.connections.' . config('database.default') . '.' . $key] = $value;
            config()->set($settings);
        }
        return $next($request);
    }
}
