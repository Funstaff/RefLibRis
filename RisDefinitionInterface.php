<?php

namespace Funstaff\RefLibRis;

/**
 * RisDefinitionInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
interface RisDefinitionInterface
{
    /**
     * @param string $tag
     * @return bool
     */
    public function hasField(string $tag): bool;

    /**
     * @param string $tag
     * @return bool
     */
    public function hasType(string $tag): bool;
}