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

if (!function_exists('headerTablelize')) {
    /**
     * Generates the header html for the table
     *
     * @param  string  $id
     * @param  string  $field
     * @param  string  $sortField
     * @param  string  $sortOrder
     * @return string
     */
    function headerTablelize($id, $field, $sortField, $sortOrder)
    {
        if(is_array($field))
        {
            if(isset($field['sorting']) && $field['sorting'] === false)
            {
                // Do not sort field
                $sorting = '';
            }

            $name = $field['name'];
        }
        else
        {
            $name = $field;
        }

        // Get correct value for the label
        if(is_array($field) && isset($field['label'])) {
            $label = $field['label'];
        } else {
            $label_text = trans('validation.attributes.'.$name);
            if($label_text == 'validation.attributes.'.$name) {
                $label_text = $name;
            }
            $label = ucfirst($label_text);
        }

        // Sorting
        if($sortField == $name)
        {
            if($sortOrder == 'desc')
            {
                $sorting = 'sort-column sort-desc';
                $icon = 'glyphicon glyphicon-sort-by-alphabet-alt';
            }
            else
            {
                $sorting = 'sort-column sort-asc';
                $icon = 'glyphicon glyphicon-sort-by-alphabet';
            }
        }
        else
        {
            $sorting = 'sort-column';
            $icon = 'glyphicon glyphicon-sort';
        }

        // Javascript for sorting
        $js_event = "document.querySelector('#{$id} input[name=ss]').value='{$name}';document.getElementById('{$id}').submit();";

        return "<th class=\"tablelize-field {$sorting}\" onclick=\"{$js_event}\">{$label}<span class=\"{$icon} pull-right\"></span></th>";
    }
}

if (!function_exists('fieldTablelize')) {
    /**
     * Generates the header html for the field
     *
     * @param  mixed   $row
     * @param  string  $field
     * @return string
     */
    function fieldTablelize($row, $field)
    {
        if(is_array($field)) {
            if(isset($field['method']) && $field['method']) {
                if(isset($field['name']) && $field['name']) {
                    return $row->{$field['method']}($row->{$field['name']});
                } else {
                    return $row->{$field['method']}();
                }
            } else {
                return $row->{$field['name']};
            }
        } else {
            return $row->{$field};
        }
    }
}