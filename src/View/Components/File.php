<?php

namespace Ully\Cloudstorages\View\Components;

use Illuminate\View\Component;
use Ully\Cloudstorages\Services\DTO\ExternalFile;

class File extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ExternalFile $file
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('cloudstorages::components.file', [
            'file' => $this->file
        ]);
    }
}
