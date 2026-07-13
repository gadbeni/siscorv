<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class UserHistorialAction extends AbstractAction
{
    public function getTitle()
    {
        return 'Historial';
    }

    public function getIcon()
    {
        return 'voyager-book';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
            'style' => 'margin: 5px;',
        ];
    }

    public function getDefaultRoute()
    {
        return route('users.historial', $this->data->id);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'users';
    }
}
