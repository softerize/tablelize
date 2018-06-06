<?php

/*
 * This file is part of Softerize Tablelize
 *
 * (c) Softerize Sistemas <oscar.dias@softerize.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Softerize\Tablelize;

/**
 * Options class
 *
 * @author Oscar Dias <oscar.dias@softerize.com>
 */
class TablelizeOptions
{
    /**
     * Base URL
     *
     * @var string
     */
    public $url;

    /**
     * Table List identifier - to be used when there's more than one table on the same page
     *
     * @var string
     */
    public $id;

    /**
     * ID field name for the model
     *
     * @var string
     */
    public $idField;

    /**
     * Field names to display. You can pass a method from the model as a string. If empty, all fields from the query will be used.
     *
     * @var array
     */
    public $fields;

    /**
     * Additional paramenters for pagination links - like selected tab
     * array('tab' => 'my-tab')
     *
     * @var array
     */
    public $queryString;

    /**
     * Default field for sorting
     *
     * @var string
     */
    public $sort;

    /**
     * Default sort order
     *
     * @var string
     */
    public $sortOrder;

    /**
     * Buttons' definition array
     * array(
     *    array('url' => 'link/to/target', 'text' => 'New', 'css' => 'btn btn-primary', 'icon' => 'fa fa-plus', 'datas' => ['target' => 'example'])
     * )
     *
     * @var array
     */
    public $buttons;

    /**
     * Possible actions for each entry
     * array(
     *    array('url' => 'link/to/target/{id}', 'text' => 'Edit', 'css' => 'btn btn-info', 'icon' => 'fa fa-pencil', 'datas' => ['target' => 'example'])
     * )
     *
     * @var array
     */
    public $rowActions;

    /**
     * Message for empty result
     *
     * @var string
     */
    public $noEntriesMsg;

    /**
     * Create a new Options instance.
     *
     * @param  array    $options
     * @return void
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
