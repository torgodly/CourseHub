<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Traits\ResourceTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Sections');
    }

    public function isReadOnly(): bool
    {
        return $this->ownerRecord->trainer_id !== auth()->user()->id;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Section Info'))
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(true)->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                                        'slug',
                                        Str::slug($state)
                                    )),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->readOnly()
                                    ->unique(ignoreRecord: true),
                            ]),

                        Forms\Components\Textarea::make('description')
                            ->translateLabel()
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                      Forms\Components\Grid::make()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('thumb')
                                ->collection('resources_thumb')
                                ->label(__('Thumbnail'))
                                ->image()
                                ->required(),
                            Forms\Components\SpatieMediaLibraryFileUpload::make('resources')
                                ->collection('resources')
                                ->label(__('Resources'))
                        ])
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable()
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('resources_thumb')
                    ->collection('resources_thumb')
                    ->translateLabel()
                    ->label('Resources')
                    ->conversion('thumb')
                    ->size(50)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
