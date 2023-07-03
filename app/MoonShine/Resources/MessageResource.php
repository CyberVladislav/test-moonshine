<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\File;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class MessageResource extends Resource
{
	public static string $model = Message::class;

	public static string $title = 'Messages';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Textarea::make('Message'),
            Text::make('Message_id'),
            BelongsTo::make('User'),
            File::make('File')->dir('documents'),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
