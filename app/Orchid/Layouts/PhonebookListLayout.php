<?php

namespace App\Orchid\Layouts;

use App\Models\Phonebook;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class PhonebookListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'phonebooks';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Phonebook $entry) {
                    return Link::make($entry->name)
                        ->route('platform.phonebook.edit', $entry);
                }),

            TD::make('email', 'Email'),
            TD::make('phone', 'Phone'),
        ];
    }
}
