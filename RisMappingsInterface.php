<?php

namespace Funstaff\RefLibRis;

/**
 * RisMappingsInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
interface RisMappingsInterface
{
    /**
     * @param string $type
     * @return mixed
     */
    public function findRisFieldByType(string $type);
}
