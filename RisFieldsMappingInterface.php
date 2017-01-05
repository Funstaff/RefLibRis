<?php

namespace Funstaff\RefLibRis;

/**
 * RisFieldsMappingInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
interface RisFieldsMappingInterface
{
    /**
     * @param string $field
     * @return null|string
     */
    public function findRisFieldByFieldName(string $field);

    /**
     * @return array
     */
    public function getAllRisFields();
}