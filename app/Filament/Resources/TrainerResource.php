<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainerResource\Pages;
use App\Filament\Resources\TrainerResource\RelationManagers;
use App\Models\Trainer;
use App\Models\User;
use App\Traits\ResourceTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainerResource extends Resource
{
    use ResourceTranslatedLabels;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Trainer';
    protected static ?string $pluralModelLabel = 'مدربون';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->where('type', 'trainer'))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('active')
                    ->translateLabel()
                    ->sortable()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('courses_count')
                    ->label('Courses')
                    ->sortable()
                    ->counts('courses'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->requiresConfirmation()
                ->modalWidth('3xl'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTrainers::route('/'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('Profile'))
                    ->schema([
                        ImageEntry::make('avatar_url')
                            ->label('Avatar')
                            ->circular()
                            ->size(80)
                            ->placeholder('No avatar'),
                        TextEntry::make('name')->label('Name')->weight('bold'),
                        TextEntry::make('email')->label('Email')->copyable(),
                        TextEntry::make('phone')->label('Phone')->placeholder('—'),
                    ])
                    ->columns(2),

                Section::make(__("Details"))
                    ->schema([
                        TextEntry::make('qualification')->label('Qualification')->placeholder('—'),
                        TextEntry::make('profession')->label('Profession')->placeholder('—'),
                        TextEntry::make('type')->label('Role')->badge()
                            ->color(fn($state) => match ($state) {
                                'admin' => 'danger',
                                'trainer' => 'info',
                                default => 'gray',
                            }),
                        IconEntry::make('active')
                            ->boolean()
                            ->label('Active'),
                    ])
                    ->columns(2),

                Section::make(__("Wallet"))
                    ->schema([
//                        Grid::make([
                        TextEntry::make('wallet.balance')
                            ->label('Balance'),
                        TextEntry::make('wallet.updated_at')
                            ->label('Last Updated')
                            ->since(),
//                        ])
                    ])
            ])
            ->columns(2);
    }
}
