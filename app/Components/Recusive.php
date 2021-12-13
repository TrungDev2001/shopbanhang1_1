<?php

namespace App\Components;

class Recusive
{
    private $Categories;
    private $htmlSelect = '';
    public function __construct($Categories)
    {
        $this->Categories = $Categories;
    }

    public function categoryRecusive($parentId, $id = 0, $text = '')
    {

        foreach ($this->Categories as $category) {
            if ($category['parent_id'] == $id) {
                if (!empty($parentId) && $parentId == $category['id']) {
                    $this->htmlSelect .= "<option selected value = '" . $category['id'] . "'>" . $text . $category['name'] . "</option>";
                } else {
                    $this->htmlSelect .= "<option value = '" . $category['id'] . "'>" . $text . $category['name'] . "</option>";
                }
                $this->categoryRecusive($category['parent_id'], $category['id'], $text . '--');
            }
        }
        return $this->htmlSelect;
    }
}
