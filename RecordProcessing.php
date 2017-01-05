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
     * @var RisFieldsMappingInterface
     */
    private $fieldsMapping;

    /**
     * RecordProcessing constructor.
     * @param RisFieldsMappingInterface $fieldsMapping
     */
    public function __construct(RisFieldsMappingInterface $fieldsMapping)
    {
        $this->fieldsMapping = $fieldsMapping;
    }

    /**
     * @param array $recordFields
     * @return array
     */
    public function process(array $recordFields)
    {
        $risFields = $this->getRisFieldsArray();

        foreach ($recordFields as $field => $values) {
            if (is_string($values)) {
                $values = [$values];
            }
            $risField = $this->fieldsMapping->findRisFieldByFieldName($field);
            if (null !== $risField) {
                foreach ($values as $value) {
                    array_push($risFields[$risField], $value);
                }
            }
        }

        return $risFields;
    }

    private function getRisFieldsArray()
    {
        $risFields = array_flip($this->fieldsMapping->getAllRisFields());
        array_walk($risFields, function (&$line) {
            $line = [];
        });

        return $risFields;
    }
}