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
     * @return null|string
     */
    public function findRisFieldByFieldName(string $field)
    {
        return $this->arrayFind($field);
    }

    /**
     * @return array
     */
    public function getAllRisFields()
    {
        return array_keys($this->mapping);
    }

    /**
     * @param string $value
     * @return null|string
     */
    private function arrayFind(string $value)
    {
        $tag = [];
        foreach ($this->mapping as $key => $fields) {
            if (in_array($value, $fields)) {
                $tag[] = (string) $key;
            }
        }

        return $tag;
    }
}
