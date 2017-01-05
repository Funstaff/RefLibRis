<?php

namespace Funstaff\RefLibRis;

/**
 * RisDefinition
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 * @see http://referencemanager.com/sites/rm/files/m/direct_export_ris.pdf
 */
class RisDefinition implements RisDefinitionInterface
{
    /**
     * @var array
     */
    protected static $fields = [
        'TY' => 'Type',
        'A2' => 'Secondary Author',
        'A3' => 'Tertiary Author',
        'A4' => 'Subsidiary Author',
        'AB' => 'Abstract',
        'AD' => 'Author Address',
        'AN' => 'Accession Number',
        'AU' => 'Author',
        'C1' => 'Custom 1',
        'C2' => 'Custom 2',
        'C3' => 'Custom 3',
        'C4' => 'Custom 4',
        'C5' => 'Custom 5',
        'C6' => 'Custom 6',
        'C7' => 'Custom 7',
        'C8' => 'Custom 8',
        'CA' => 'Caption',
        'CN' => 'Call Number',
        'CY' => 'Place Published',
        'DA' => 'Date',
        'DB' => 'Name of Database',
        'DO' => 'DOI',
        'DP' => 'Database Provider',
        'ET' => 'Edition',
        'J2' => 'Alternate Title',
        'KW' => 'Keywords',
        'L1' => 'File Attachments',
        'L4' => 'Figure',
        'LA' => 'Language',
        'LB' => 'Label',
        'IS' => 'Number',
        'M3' => 'Type of Work',
        'N1' => 'Notes',
        'NV' => 'Number of Volumes',
        'OP' => 'Original Publication',
        'PB' => 'Publisher',
        'PY' => 'Year',
    ];

    /**
     * @var array
     */
    protected static $types = [
        'GEN'       => 'Generic',
        'ABST'      => 'Abstract',
        'AGGR'      => 'Aggregated Database',
        'ANCIENT'   => 'Ancient Text',
        'ART'       => 'Artwork',
        'ADVS'      => 'Audiovisual Material',
        'BILL'      => 'Bill',
        'BLOG'      => 'Blog',
        'BOOK'      => 'Book',
        'CHAP'      => 'Book Section',
        'CASE'      => 'Case',
        'CTLG'      => 'Catalog',
        'CHART'     => 'Chart',
        'CLSWK'     => 'Classical Work',
        'COMP'      => 'Computer Program',
        'CPAPER'    => 'Conference Paper',
        'CONF'      => 'Conference Proceeding',
        'DATA'      => 'Dataset',
        'DICT'      => 'Dictionary',
        'EDBOOK'    => 'Edited Book',
        'EBOOK'     => 'Electronic Book',
        'ECHAP'     => 'Electronic Book Section',
        'EJOUR'     => 'Electronic Article',
        'ENCYC'     => 'Encyclopedia',
        'EQUA'      => 'Equation',
        'FIGURE'    => 'Figure',
        'MPCT'      => 'Film or Broadcast',
        'JFULL'     => 'Full Journal',
        'GOVDOC'    => 'Government Document',
        'GRNT'      => 'Grant',
        'HEAR'      => 'Hearing',
        'INPR'      => 'In Press Article',
        'ICOMM'     => 'Internet Communication',
        'JOUR'      => 'Journal Article',
        'LEGAL'     => 'Legal Rule',
        'MGZN'      => 'Magazine Article',
        'MANSCPT'   => 'Manuscript',
        'MAP'       => 'Map',
        'MUSIC'     => 'Music',
        'NEWS'      => 'Newspaper Article',
        'DBASE'     => 'Online Database',
        'MULTI'     => 'Online Multimedia',
        'PAMP'      => 'Pamphlet',
        'PAT'       => 'Patent',
        'PCOMM'     => 'Personal Communication',
        'RPRT'      => 'Report',
        'SER'       => 'Serial',
        'SLIDE'     => 'Slide',
        'SOUND'     => 'Sound Recording',
        'STAND'     => 'Standard',
        'STAT'      => 'Statute',
        'THES'      => 'Thesis',
        'UNBILL'    => 'Unenacted Bill',
        'UNPD'      => 'Unpublished Work',
        'VIDEO'     => 'Video Recording',
        'ELEC'      => 'Web Page',
    ];

    /**
     * @param string $tag
     * @return bool
     */
    public function hasField(string $tag): bool
    {
        return array_key_exists($tag, self::$fields);
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return array_keys(self::$fields);
    }

    /**
     * @param string $tag
     * @return mixed
     */
    public function getFieldDefinition(string $tag)
    {
        if (!array_key_exists($tag, self::$fields)) {
            throw new \InvalidArgumentException('Field Tag not found.');
        }

        return self::$fields[$tag];
    }

    /**
     * @param string $tag
     * @return bool
     */
    public function hasType(string $tag): bool
    {
        return array_key_exists($tag, self::$types);
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return array_keys(self::$types);
    }

    /**
     * @param string $tag
     * @return mixed
     */
    public function getTypeDefinition(string $tag)
    {
        if (!array_key_exists($tag, self::$types)) {
            throw new \InvalidArgumentException('Type Tag not found.');
        }

        return self::$types[$tag];
    }
}