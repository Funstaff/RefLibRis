<?php

namespace Funstaff\RefLibRis;

/**
 * RisFieldsMapping
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RisFieldsMapping implements RisFieldsMappingInterface
{
    /**
     * @var array
     */
    private $mapping;

    /**
     * RisMapping constructor.
     * @param array $mapping
     */
    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @param string $field
     * @return int|null|string
     */
    public function findTagByField(string $field)
    {
        return $this->arrayFind($field);
    }

    /**
     * @param string $value
     * @return null|string
     */
    private function arrayFind(string $value)
    {
        $tag = null;
        foreach ($this->mapping as $key => $fields) {
            if (in_array($value, $fields)) {
                $tag = (string) $key;
                break;
            }
        }

        return $tag;
    }
}