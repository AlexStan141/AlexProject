<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $status,
        public string $fullName,
        public string $phone,
        public string $email,
        public string $address,
        public string $companyName,
        public string $notes,
        public string $userId,
        public string $role,
        public ?string $type = "client",
        public string $userIdWithinRole
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-item');
    }
}
