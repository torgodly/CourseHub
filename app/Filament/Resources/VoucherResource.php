<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use App\Traits\ResourceTranslatedLabels;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class VoucherResource extends Resource
{
    use resourceTranslatedLabels;

    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'tabler-ticket';

    protected static ?string $navigationGroup = 'Financial Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('generate')
                            ->icon('tabler-refresh')
                            ->action(function (Forms\Get $get, Forms\Set $set) {
                                $set('code', Str::random(8));
                            })
                    )
                    ->label(__('code')),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->columnSpanFull()
                    ->suffix('د.ل')
                    ->required()
                    ->label(__('amount')),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->maxLength(500)
                    ->label(__('description')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->badge()
                    ->copyable()
                    ->sortable()
                    ->searchable()
                    ->label(__('code')),
                Tables\Columns\TextColumn::make('amount')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->suffix('د.ل')
                    ->label(__('amount')),

                Tables\Columns\TextColumn::make('expires_at')
                    ->date()
                    ->sortable()
                    ->placeholder(__('has not been used yet'))
                    ->label(__('expires at')),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->placeholder(__('N\A'))
                    ->label(__('description')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('created at')),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVouchers::route('/'),
//            'create' => Pages\CreateVoucher::route('/create'),
//            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
