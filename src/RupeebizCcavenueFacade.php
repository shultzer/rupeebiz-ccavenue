<?php

namespace Shultzer\RupeebizCcavenue;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Shultzer\RupeebizCcavenue\Skeleton\SkeletonClass
 */
class RupeebizCcavenueFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rupeebiz-ccavenue';
    }
}
