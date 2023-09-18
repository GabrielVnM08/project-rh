<?php

namespace App\Orchid\Screens;

use App\Models\Phonebook;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class PhonebookEditScreen extends Screen
{
    /**
     * @var Phonebook
     */
    public $phonebook;

    /**
     * Query data.
     *
     * @param Phonebook $phonebook
     *
     * @return array
     */
    public function query(Phonebook $phonebook): array
    {
        return [
            'phonebook' => $phonebook
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->phonebook->exists ? 'Edit Phonebook Entry' : 'Creating a New Phonebook Entry';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Phonebook Entries";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create Entry')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->phonebook->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->phonebook->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->phonebook->exists),
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
            Layout::rows([
                Input::make('phonebook.name')
                    ->title('Name')
                    ->placeholder('Enter name')
                    ->help('Specify the name for this phonebook entry.'),

                Input::make('phonebook.email')
                    ->title('Email')
                    ->placeholder('Enter email')
                    ->help('Specify the email for this phonebook entry.'),

                Input::make('phonebook.phone')
                    ->title('Phone')
                    ->placeholder('Enter phone number')
                    ->help('Specify the phone number for this phonebook entry.'),

                Relation::make('phonebook.author')
                    ->title('Author')
                    ->fromModel(User::class, 'name'),

            ])
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        $this->phonebook->fill($request->get('phonebook'))->save();

        Alert::info('You have successfully created/update a phonebook entry.');

        return redirect()->route('platform.phonebook.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->phonebook->delete();

        Alert::info('You have successfully deleted the phonebook entry.');

        return redirect()->route('platform.phonebook.list');
    }
}
