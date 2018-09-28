<?php

namespace Funstaff\RefLibRis;

/**
 * RisMappings
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
class RisMappings implements RisMappingsInterface
{
    /**
     * @var array
     */
    private $mappings;

    /**
     * @var string
     */
    private $fallback;

    /**
     * RisMappings constructor.
     * @param array  $mappings
     * @param string $fallback
     */
    public function __construct(array $mappings, string $fallback)
    {
        $this->mappings = $this->mappings($mappings);
        $this->fallback = $fallback;
    }

    /**
     * @param string $type
     * @return mixed
     * @throws \Exception
     */
    public function findRisFieldByType(string $type)
    {
        if (!array_key_exists($type, $this->mappings)) {
            $type = $this->fallback;
        }

        if (!array_key_exists($type, $this->mappings)) {
            throw new \InvalidArgumentException(sprintf(
                'Missing mapping for fallback: "%s"',
                $type
            ));
        }

        return $this->mappings[$type];
    }

    /**
     * @param $mappings
     * @return array
     */
    private function mappings(array $mappings)
    {
        $output = [];
        foreach ($mappings as $key => $mappingFields) {
            if (!array_key_exists($key, $output)) {
                $output[$key] = New RisFieldsMapping($mappingFields);
            }
        }

        return $output;
    }
}
