<?php

namespace Ully\Cloudstorages\View\Components;

use Illuminate\View\Component;

class Storage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public \Ully\Cloudstorages\Models\Storage $storage
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.storage', [
            'storage' => $this->storage
        ]);
    }
}
