<?php

namespace Funstaff\RefLibRis;

/**
 * RecordProcessing
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
class RecordProcessing
{
    /**
     * @var RisMappingsInterface
     */
    private $mappings;

    /**
     * RecordProcessing constructor.
     * @param RisMappingsInterface $mappings
     */
    public function __construct(RisMappingsInterface $mappings)
    {
        $this->mappings = $mappings;
    }

    /**
     * @param array  $recordFields
     * @param string $columnTypeName
     * @return mixed
     * @throws \Exception
     */
    public function process(array $recordFields, string $columnTypeName = 'type')
    {
        if (!array_key_exists($columnTypeName, $recordFields)) {
            throw new \InvalidArgumentException(sprintf(
                'The name "%s" of Column Type does not exists on fields record',
                $columnTypeName
            ));
        }

        $type = $recordFields[$columnTypeName][0];

        $mapping = $this->mappings->findRisFieldByType($type);
        $risFields = $this->getRisFieldsArray($mapping);

        foreach ($recordFields as $field => $values) {
            if (is_string($values)) {
                $values = [$values];
            }
            $risFieldsName = $mapping->findRisFieldByFieldName($field);
            if (count($risFieldsName) > 0) {
                foreach ($risFieldsName as $risField) {
                    foreach ($values as $value) {
                        $risFields[$risField][] = $value;
                    }
                }
            }
        }

        return $risFields;
    }

    /**
     * @param RisFieldsMappingInterface $mapping
     * @return array|null
     */
    private function getRisFieldsArray(RisFieldsMappingInterface $mapping)
    {
        $risFields = array_flip($mapping->getAllRisFields());
        array_walk($risFields, function(&$line) {
            $line = [];
        });

        return $risFields;
    }
}
