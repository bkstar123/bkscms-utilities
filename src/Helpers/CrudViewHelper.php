<?php
/**
 * CrudViewHelper Helper
 *
 * @author: tuanha
 * @last-mod: 28-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Helpers;

class CrudViewHelper
{
    /**
     * Create a check all button
     *
     * @param string  $color e.g: primary, danger, success, warning
     * @return html string
     */
    public function checkAllBtn($color = '')
    {
        $color = !empty($color) ? $color : 'primary';
        
        $contents = '<div class="icheck-' . $color . '">';
        $contents .= '<input type="checkbox" id="check-all">';
        $contents .= '<label for="check-all"></label>';
        $contents .= '</div>';
        $contents .= '<script>';
        $contents .= '$("#check-all").change(() => {';
        $contents .= '$("#check-all").prop("checked") ? ';
        $contents .= '$(".item-check").prop("checked", true) : ';
        $contents .= '$(".item-check").prop("checked", false);';
        $contents .= '});';
        $contents .= '</script>';
        echo $contents;
    }

    /**
     * Create a check button
     *
     * @param Illuminate\Database\Eloquent\Model $resource
     *
     * @return html string
     */
    public function checkBtn($resource, $color = '')
    {
        $color = !empty($color) ? $color : 'primary';

        $contents = '<div class="icheck-' . $color . '">';
        $contents .= '<input type="checkbox"';
        $contents .= 'class="item-check"';
        $contents .= 'value = "' . $resource->{$resource->getRouteKeyName()} .'"';
        $contents .= 'id="item-check-' . $resource->{$resource->getRouteKeyName()} . '">';
        $contents .= '<label for="item-check-' . $resource->{$resource->getRouteKeyName()} . '"></label>';
        $contents .= '</div>';
        echo $contents;
    }

    /**
     * Create an active status button
     */
    public function activeStatus($resource, $route, $bgColor = '', $text = '')
    {
        $bgColor = !empty($bgColor) ? $bgColor : 'bg-green';
        $text = !empty($text) ? $text : 'Active';

        $contents = '<span class="badge ' . $bgColor . '">';
        $contents .= '<a href="#" ';
        $contents .= 'class="btn btn-link" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#disabling-form-' . $resource->{$resource->getRouteKeyName()} .'\').submit()">';
        $contents .= $text;
        $contents .= '</a></span>';
        $contents .= '<form id="disabling-form-' . $resource->{$resource->getRouteKeyName()} . '"';
        $contents .= 'action="' . $route . '" ';
        $contents .= 'method="POST" ';
        $contents .= 'style="display: none;">';
        $contents .= csrf_field();
        $contents .= method_field('PATCH');
        $contents .= '</form> ';
        echo $contents;
    }

    /**
     * Create a disabled status button
     */
    public function disabledStatus($resource, $route, $bgColor = '', $text = '')
    {
        $bgColor = !empty($bgColor) ? $bgColor : 'bg-gray';
        $text = !empty($text) ? $text : 'Disabled';

        $contents = '<span class="badge ' . $bgColor . '">';
        $contents .= '<a href="#" ';
        $contents .= 'class="btn btn-link" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#activating-form-' . $resource->{$resource->getRouteKeyName()} .'\').submit()">';
        $contents .= $text;
        $contents .= '</a></span>';
        $contents .= '<form id="activating-form-' . $resource->{$resource->getRouteKeyName()} . '"';
        $contents .= 'action="' . $route . '" ';
        $contents .= 'method="POST" ';
        $contents .= 'style="display: none;">';
        $contents .= csrf_field();
        $contents .= method_field('PATCH');
        $contents .= '</form> ';
        echo $contents;
    }
}
