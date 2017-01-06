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
        'A1' => 'Author Primary',
        'A2' => 'Secondary Author',
        'A3' => 'Tertiary Author',
        'A4' => 'Subsidiary Author',
        'AB' => 'Abstract',
        'AD' => 'Author Address',
        'AN' => 'Accession Number',
        'AU' => 'Author',
        'AV' => 'Availability',
        'BT' => 'field can contain alphanumeric characters',
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
        'CP' => 'length limit to this field',
        'CT' => 'Unpublished Work references',
        'CY' => 'Place Published',
        'DA' => 'Date',
        'DB' => 'Name of Database',
        'DO' => 'DOI',
        'DP' => 'Database Provider',
        'ED' => 'preceded by this tag',
        'EP' => 'Ending page number',
        'ET' => 'Edition',
        'ID' => 'Reference ID',
        'IS' => 'Issue',
        'J1' => 'Periodical name: user abbreviation 1',
        'J2' => 'Periodical name: user abbreviation 2',
        'JA' => 'periodical in which the article was published',
        'JF' => 'Periodical name: full format',
        'JO' => 'Periodical name: standard abbreviation',
        'KW' => 'Keywords',
        'L1' => 'Link to PDF',
        'L2' => 'Link to Full-text',
        'L3' => 'Related Records',
        'L4' => 'Images',
        'LA' => 'Language',
        'LB' => 'Label',
        'M1' => 'Miscellaneous 1',
        'M2' => 'Miscellaneous 2',
        'M3' => 'Miscellaneous 3',
        'N1' => 'Notes',
        'N2' => 'Abstract',
        'NV' => 'Number of Volumes',
        'OP' => 'Original Publication',
        'PB' => 'Publisher',
        'PY' => 'Year (Format: YYYY/MM/DD/other info)',
        'RP' => 'Reprint status',
        'SP' => 'Start page number',
        'SN' => 'ISSN/ISBN',
        'T1' => 'Title Primary',
        'T2' => 'Title Secondary',
        'T3' => 'Title Series',
        'TI' => 'This field only for Whole Book',
        'U1' => 'User definable 1',
        'U2' => 'User definable 2',
        'U3' => 'User definable 3',
        'U4' => 'User definable 4',
        'U5' => 'User definable 5',
        'UR' => 'Web/URL',
        'VL' => 'Volume number',
        'Y1' => 'Date Primary',
        'Y2' => 'Date Secondary',
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
