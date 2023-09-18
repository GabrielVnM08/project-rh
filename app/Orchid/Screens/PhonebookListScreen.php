<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\PhonebookListLayout;
use App\Models\Phonebook;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PhonebookListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'phonebooks' => Phonebook::paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Phonebook Entries';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All phonebook entries";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create New Entry')
                ->icon('pencil')
                ->route('platform.phonebook.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            PhonebookListLayout::class
        ];
    }
}
