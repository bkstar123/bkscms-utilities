<?php
/**
 * CrudViewHelper Helper
 *
 * @author: tuanha
 * @last-mod: 28-Sept-2019
 */
namespace Bkstar123\BksCMS\Utilities\Helpers;

use Illuminate\Database\Eloquent\Model;

class CrudViewHelper
{
    /**
     * Create a check all button
     *
     * @param string  $color e.g: primary, danger, success, warning, info, secondary, dark, light
     *
     * @return html string
     */
    public function checkAllBox(string $color = '')
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
     * @param string  $color e.g: primary, danger, success, warning, info, secondary, dark, light
     *
     * @return html string
     */
    public function checkBox(Model $resource, string $color = '')
    {
        $color = !empty($color) ? $color : 'primary';

        $contents = '<div class="icheck-' . $color . '">';
        $contents .= '<input type="checkbox"';
        $contents .= 'class="item-check"';
        $contents .= 'value = "' . $resource->id .'"';
        $contents .= 'id="item-check-' . $resource->id . '">';
        $contents .= '<label for="item-check-' . $resource->id . '"></label>';
        $contents .= '</div>';
        echo $contents;
    }

    /**
     * Create an active status button
     *
     * @param Illuminate\Database\Eloquent\Model $resource
     * @param string $followRoute
     * @param string  $color e.g: primary, danger, success, warning, info, secondary, dark, light
     * @param string  $text
     * @return html string
     */
    public function activeStatus(Model $resource, string $followRoute, string $color = '', string $text = '')
    {
        $color = !empty($color) ? $color : 'success';
        $text = !empty($text) ? $text : 'Active';

        $contents = '<button class="btn btn-' . $color . '" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#disabling-form-' . $resource->id .'\').submit()">';
        $contents .= $text;
        $contents .= '</button>';
        $contents .= '<form id="disabling-form-' . $resource->id . '"';
        $contents .= 'action="' . $followRoute . '" ';
        $contents .= 'method="POST" ';
        $contents .= 'style="display: none;">';
        $contents .= csrf_field();
        $contents .= method_field('PATCH');
        $contents .= '</form> ';
        echo $contents;
    }

    /**
     * Create a disabled status button
     *
     * @param Illuminate\Database\Eloquent\Model $resource
     * @param string $followRoute
     * @param string  $color e.g: primary, danger, success, warning, info, secondary, dark, light
     * @param string  $text
     * @return html string
     */
    public function disabledStatus(Model $resource, string $followRoute, string $color = '', string $text = '')
    {
        $color = !empty($color) ? $color : 'secondary';
        $text = !empty($text) ? $text : 'Disabled';

        $contents = '<button class="btn btn-' . $color . '" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#activating-form-' . $resource->id .'\').submit()">';
        $contents .= $text;
        $contents .= '</button>';
        $contents .= '<form id="activating-form-' . $resource->id . '"';
        $contents .= 'action="' . $followRoute . '" ';
        $contents .= 'method="POST" ';
        $contents .= 'style="display: none;">';
        $contents .= csrf_field();
        $contents .= method_field('PATCH');
        $contents .= '</form> ';
        echo $contents;
    }

    /**
     * Create a remove all button
     *
     * @param string $followRoute
     * @return html strong
     */
    public function removeAllBtn(string $followRoute, string $color = '', string $text = '')
    {
        $color = !empty($color) ? $color : 'danger';
        $text = !empty($text) ? $text : 'Remove All';

        $contents = '<button class="btn btn-' . $color . '" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#massive-removing-modal\').modal(\'show\')">';
        $contents .= $text;
        $contents .= '</button>';
        $contents .= '<form id="massive-destroy-form" ';
        $contents .= 'method="POST" style="display: none;" action="' . $followRoute . '">';
        $contents .= '<input id="massive-destroy-list" type="hidden" name="Ids" value="">';
        $contents .= csrf_field();
        $contents .= method_field('DELETE');
        $contents .= '</form>';
        $contents .= $this->massiveDestroyModal();

        echo $contents;
    }

    /**
     * Create a remove button
     *
     * @param string $followRoute
     * @return html strong
     */
    public function removeBtn(Model $resource, string $followRoute, string $color = '', string $text = '')
    {
        $color = !empty($color) ? $color : 'danger';
        $text = !empty($text) ? $text : 'Remove';

        $contents = '<button class="btn btn-' . $color . '" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#removing-modal-' . $resource->id . '\').modal(\'show\')">' . $text .'</button>';
        $contents .= '<form id="deleting-form-' . $resource->id . '"';
        $contents .= 'action="' . $followRoute . '"';
        $contents .= 'method="POST" style="display: none;">';
        $contents .= csrf_field();
        $contents .= method_field('DELETE');
        $contents .= '</form>';
        $contents .= $this->destroyModal($resource);

        echo $contents;
    }

    /**
     * Create a search input
     *
     * @param string  $searchRoute
     * @param string  $inputName
     */
    public function searchInput(string $searchRoute, string $inputName = 'search')
    {
        $contents = '<form role="form" method="GET" accept-charset="utf-8" action="' . $searchRoute . '">';
        $contents .= '<div class="input-group input-group-sm" style="width: 250px;">';
        $contents .= '<input type="text" name="' . $inputName . '"';
        $contents .= 'value="' . request()->input($inputName) . '"';
        $contents .= 'class="form-control float-right" placeholder="Search">';
        $contents .= '<div class="input-group-append">';
        $contents .= '<button type="submit" class="btn btn-default">';
        $contents .= '<i class="fas fa-search"></i>';
        $contents .= '</button>';
        $contents .= '</div>';
        $contents .= '</div></form>';

        echo $contents;
    }

    /**
     * Create a massive destroy modal
     *
     * @return html string
     */
    protected function massiveDestroyModal()
    {
        $contents = '<div class="modal fade" id="massive-removing-modal">';
        $contents .= '<div class="modal-dialog">';
        $contents .= '<div class="modal-content">';
        $contents .= '<div class="modal-header bg-danger">';
        $contents .= '<h4 class="modal-title">Confirmation - multiple destroy</h4>';
        $contents .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $contents .= '<span aria-hidden="true">&times;</span></button></div>';
        $contents .= '<div class="modal-body">';
        $contents .= '<p>Are you sure to perform this action?</p>';
        $contents .= '<i>All related data will irreversibly be removed</i>';
        $contents .= '</div>';
        $contents .= '<div class="modal-footer justify-content-between">';
        $contents .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
        $contents .= '<button type="button" class="btn btn-outline-light btn-danger" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= 'let checkedItems = $(\'.item-check:checked\');';
        $contents .= 'let Ids = [];';
        $contents .= '$.each(checkedItems, function () {';
        $contents .= 'Ids.push($(this).val());';
        $contents .= '});';
        $contents .= 'if (Ids.length === 0) {';
        $contents .= 'alert(\'No data was selected\');';
        $contents .= '$(\'#massive-removing-modal\').modal(\'hide\');';
        $contents .= 'return;';
        $contents .= '} else {';
        $contents .= '$(\'#massive-destroy-list\').val(Ids);';
        $contents .= '$(\'#massive-removing-modal\').modal(\'hide\');';
        $contents .= '$(\'#massive-destroy-form\').submit();';
        $contents .= '}">Okay</button></div></div></div></div>';

        return $contents;
    }

    /**
     * Create a destroy modal
     *
     * @return html string
     */
    protected function destroyModal(Model $resource)
    {
        $contents = '<div class="modal fade" id="removing-modal-' . $resource->id . '">';
        $contents .= '<div class="modal-dialog">';
        $contents .= '<div class="modal-content">';
        $contents .= '<div class="modal-header bg-danger">';
        $contents .= '<h4 class="modal-title">Confirmation - destroy</h4>';
        $contents .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        $contents .= '<span aria-hidden="true">&times;</span></button></div>';
        $contents .= '<div class="modal-body">';
        $contents .= '<p>Are you sure to perform this action?</p>';
        $contents .= '<i>All related data will irreversibly be removed</i></div>';
        $contents .= '<div class="modal-footer justify-content-between">';
        $contents .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
        $contents .= '<button type="button" class="btn btn-outline-light btn-danger" ';
        $contents .= 'onclick="event.preventDefault();';
        $contents .= '$(\'#deleting-form-' . $resource->id . '\').submit()">';
        $contents .= 'Okay</button></div></div></div></div>';

        return $contents;
    }
}
