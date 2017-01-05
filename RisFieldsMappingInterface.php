<?php

namespace Funstaff\RefLibRis;

/**
 * RisFieldsMappingInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
interface RisFieldsMappingInterface
{
    /**
     * @param string $field
     * @return null|string
     */
    public function findTagByField(string $field);
}