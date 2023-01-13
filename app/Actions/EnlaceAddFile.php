<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

// Models
use App\Models\Enlace;

class EnlaceAddFile extends AbstractAction
{
    public function getTitle()
    {
        return 'Archivos';
    }

    public function getIcon()
    {
        return 'fa-solid fa-file';
    }

    public function getPolicy()
    {
        return 'add';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-dark pull-right',
            'style' => 'margin: 5px;'
        ];
    }

    public function getDefaultRoute()
    {
        return route('enlaces-file.index', ['enlace'=>$this->data->id]);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'enlaces';
    }
}