<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ToggleStatusAction extends AbstractAction
{
    public function getTitle()
    {
        return $this->data->status ? 'Desactivar' : 'Activar';
    }

    public function getIcon()
    {
        return $this->data->status ? 'voyager-ban' : 'voyager-check';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => $this->data->status
                ? 'btn btn-sm btn-dark pull-right'
                : 'btn btn-sm btn-success pull-right',
            'style' => 'margin: 5px;',
        ];
    }

    public function getDefaultRoute()
    {
        return route('users.toggle-status', $this->data->id);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }
}
