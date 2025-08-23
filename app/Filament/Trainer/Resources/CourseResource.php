<?php

namespace App\Filament\Trainer\Resources;

use App\Enum\CourseLevel;
use App\Enum\CourseStatus;
use App\Filament\Resources\CourseResource\RelationManagers\EnrollmentsRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\SectionsRelationManager;
use App\Filament\Trainer\Resources\CourseResource\Pages;
use App\Filament\Trainer\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use App\Traits\ResourceTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CourseResource extends Resource
{
    use ResourceTranslatedLabels;

    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'tabler-book';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Basic Info')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Hidden::make('trainer_id')
                                            ->default(auth()->user()->id)
                                            ->required(),

                                        Forms\Components\TextInput::make('trainer')
                                            ->default(fn() => auth()->user()?->name)
                                            ->readOnly(),

                                        Forms\Components\TextInput::make('title')
                                            ->live(true)
                                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                                                'slug',
                                                Str::slug($state)
                                            ))
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('slug')
                                            ->unique(ignoreRecord: true)
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\Select::make('level')
                                            ->translateLabel()
                                            ->options(CourseLevel::class)
                                            ->required(),

                                        Forms\Components\TagsInput::make('requirements')
                                            ->required()
                                            ->translateLabel(),

                                        Forms\Components\TagsInput::make('learn_goals')
                                            ->required()
                                            ->translateLabel(),
                                    ]),

                                Forms\Components\Textarea::make('description')
                                    ->translateLabel()
                                    ->columnSpanFull(),
                            ])
                    ])->columnSpan(2),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Section::make('Pricing & Settings')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->disabled(fn($get) => $get('is_free') === true)
                                            ->required()
                                            ->numeric()
                                            ->default(0.00)
                                            ->prefix('د.ل'),
                                        Forms\Components\Select::make('status')
                                            ->translateLabel()
                                            ->options(CourseStatus::class)
                                            ->default(CourseStatus::Draft->value)
                                            ->required()
                                        ,
                                        Forms\Components\Toggle::make('is_free')
                                            ->live()
                                            ->required(),
                                    ]),

                            ]),
                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\Select::make('tags')
                                    ->multiple()
                                    ->preload()
                                    ->relationship('tags', 'name'),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                                    ->collection('thumbnails')
                                    ->translateLabel()
                                    ->image()
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('video')
                                    ->collection('promotional_videos')
                                    ->translateLabel()
                                    ->acceptedFileTypes(['video/mp4'])
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(1),


                ]
            )->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('level')
                    ->badge(),
                Tables\Columns\TextColumn::make('price')
                    ->badge()
                    ->color('success')
                    ->suffix('د.ل')
                    ->sortable(),
                //الايرادات المتاحه
                Tables\Columns\TextColumn::make('wallet.balance')
                    ->label('Revenue')
                    ->badge()
                    ->suffix('د.ل')
                    ->color(fn($state) => $state <= 0 ? 'danger' : 'success')
                    ->description(__('Revenue Available for Withdraw'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_free')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
                Tables\Columns\TextColumn::make('enrollments_count')
                    ->label('Enrollments')
                    ->sortable()
                    ->counts('enrollments'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SectionsRelationManager::class,
            EnrollmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('trainer_id', auth()->user()->id);
    }
}
