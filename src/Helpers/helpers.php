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
                $icon = config('tablelize.icons.sort_desc');
            }
            else
            {
                $sorting = 'sort-column sort-asc';
                $icon = config('tablelize.icons.sort_asc');
            }
        }
        else
        {
            $sorting = 'sort-column';
            $icon = config('tablelize.icons.sort');
        }

        // Define icon html
        $icon_html = ( $icon ? "<span class=\"{$icon} pull-right\"></span>" : '' );

        // Javascript for sorting
        $js_event = "document.querySelector('#{$id} input[name=ss]').value='{$name}';document.getElementById('{$id}').submit();";

        return "<th class=\"tablelize-field {$sorting}\" onclick=\"{$js_event}\">{$label}{$icon_html}</th>";
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

if (!function_exists('urlTablelize')) {
    /**
     * Generates the correct URL for table links
     *
     * @param  mixed   $row
     * @param  string  $url
     * @param  string  $idField
     * @return string
     */
    function urlTablelize($row, $url, $idField = false)
    {
        preg_match_all('/\{(.*?)\}/', $url, $matches);

        if(count($matches[1])) {
            foreach($matches[1] as $match) {
                $url = str_replace('{' . $match . '}', $row->{$match}, $url);
            }

            $url = url($url);
        } else {
            // Compatibility with old version
            $url = url($url, $row->{$idField});
        }

        return $url;
    }
}

if (!function_exists('datasTablelize')) {
    /**
     * Generates HTML for data properties
     *
     * @param  array  $datas
     * @return string
     */
    function datasTablelize($datas)
    {
        $html = [];

        foreach($datas as $data => $value) {
            $html[] = 'data-'.$data.'="'.$value.'"';
        }

        return implode(' ', $html);
    }
}