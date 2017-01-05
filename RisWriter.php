<?php

namespace Funstaff\RefLibRis;

/**
 * RisWriter
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@rero.ch>
 */
class RisWriter
{
    const RIS_EOL = "\r\n";

    /**
     * @var RisDefinitionInterface
     */
    private $definition;

    /**
     * @var array
     */
    private $records = [];

    /**
     * RisWriter constructor.
     * @param RisDefinitionInterface $definition
     */
    public function __construct(RisDefinitionInterface $definition)
    {
        $this->definition = $definition;
    }

    /**
     * @param array $record
     * @return $this
     */
    public function addRecord(array $record)
    {
        array_push($this->records, $record);

        return $this;
    }

    /**
     * @param array $records
     * @return $this
     */
    public function setRecords(array $records)
    {
        $this->records = $records;

        return $this;
    }

    /**
     * @param bool $validation
     * @return string
     */
    public function process($validation = false): string
    {
        if (count($this->records) == 0) {
            throw new \LengthException('Add Record before call process function.');
        }

        $buffer = [];
        foreach ($this->records as $record) {
            $buffer[] = $this->processRecord($record, $validation);
        }

        return implode(self::RIS_EOL, $buffer);
    }

    /**
     * @param array $record
     * @param $validation
     * @return string
     */
    private function processRecord(array $record, $validation): string
    {
        $buffer = [];

        if (!array_key_exists('TY', $record)) {
            throw new \InvalidArgumentException('TY Tag field not found.');
        }

        if (is_string($record['TY'])) {
            $record['TY'] = [$record['TY']];
        }

        /* First position for TY (Type) */
        array_push($buffer, sprintf('TY  - %s', $record['TY'][0]));
        unset($record['TY']);

        /* Order the array */
        ksort($record);
        foreach ($record as $tag => $values) {
            if ($validation && !$this->definition->hasField($tag)) {
                throw new \InvalidArgumentException('Field Tag not found.');
            }

            if (is_string($values)) {
                $values = [$values];
            }

            foreach ($values as $value) {
                array_push($buffer, sprintf('%s  - %s', $tag, $value));
            }
        }
        /* End record */
        array_push($buffer, 'ER  - '.self::RIS_EOL);

        return implode(self::RIS_EOL, $buffer);
    }
}