<?php

function getCategoriesCheckbox($categories, $old=[], $parentId=0, $char='')
{
    $id = request()->route()->category;
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parentId && $id!=$category->id) {
                
                $checked = !empty($old) && in_array($category->id,$old)? 'checked' : false;

                echo '<label class="d-block"><input type="checkbox" name="categories[]"'.$checked.' value="'.$category->id.'" />'.$char.$category->name.'</label>';
                unset($categories[$key]);
                getCategoriesCheckbox($categories, $old, $category->id, $char.' |- ');
            }
        }
    }
}