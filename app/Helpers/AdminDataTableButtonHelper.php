<?php

namespace App\Helpers;


class AdminDataTableButtonHelper
{
    public static function datatableButton($array): string
    {
        $action_button = '';
        foreach ($array['actions'] as $key => $value) {
            if ((string)$key === 'edit') {
                $action_button .= '<a href="' . $value . '"><i class="fa-solid fa-pen-to-square"></i></i></a>';
            } else if ((string)$key === 'view-page') {
                $action_button .= '<a href="' . $value . '"><i class="fa-solid fa-eye"></i></a>';
            } else if ((string)$key === 'delete') {
                $action_button .= '<a href="#" data-id="' . $array['id'] . '"  class="delete-single p-2"><i class="fa-solid fa-trash"></i></a>';
            }
        }
        return $action_button;
    }

}
