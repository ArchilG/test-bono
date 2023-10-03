<?php

namespace App\Exports;

use App\Models\Message;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class MessagesExport implements FromCollection
{
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return Message::whereHas('user')->get()->sortBy('user.created_at');
    }
}
