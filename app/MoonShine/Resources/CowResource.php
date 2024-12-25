<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cow;
use Illuminate\Support\Facades\Request;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Image;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

/**
 * @extends ModelResource<Cow>
 */
class CowResource extends ModelResource
{
    protected string $model = Cow::class;

    protected string $title = 'Lista de vacas';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = false;

    public function redirectAfterSave(): string
    {
        $referer = Request::header('referer');
        return $referer ?: '/';
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Nombre', 'name')
                ->required(),
            Image::make('Foto', 'photo')
                ->allowedExtensions(['png', 'jpg'])
                ->disk('public')
                ->dir('images/cows')
                ->nullable(),
            Select::make('Madre', 'mother_id')
                // ->relationship('mother', 'name')
                ->nullable(),
            Select::make('Padre', 'father_id')
                // ->relationship('father', 'name')
                ->nullable(),
            Date::make('Fecha de nacimiento', 'birth_date')
                ->format('Y-m-d')
                ->required(),
        ];
    }

    /**
     * @param Cow $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
