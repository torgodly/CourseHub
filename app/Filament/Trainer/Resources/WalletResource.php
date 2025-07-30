<?php

namespace App\Filament\Trainer\Resources;

use App\Filament\Trainer\Resources\WalletResource\Pages;
use App\Filament\Trainer\Resources\WalletResource\RelationManagers;
use App\Traits\ResourceTranslatedLabels;
use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Wallet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WalletResource extends Resource
{
    use ResourceTranslatedLabels;

    protected static ?string $model = Transaction::class;

    protected static ?string $modelLabel = 'Wallet Transactions';

    protected static ?string $pluralModelLabel = 'Wallet Transactions';
    protected static ?string $navigationIcon = 'tabler-wallet';

    protected static ?string $navigationGroup = 'Financial Management';

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
            ->modifyQueryUsing(fn($query) => $query->where('wallet_id', auth()->user()->wallet->id))
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label(__('uuid'))
                    ->badge()
                    ->copyable()
                    ->sortable()
                    ->searchable(),
                //type
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            Transaction::TYPE_DEPOSIT => 'success',
                            Transaction::TYPE_WITHDRAW => 'danger',
                            default => 'secondary',
                        };
                    })
                    ->icon(function ($state) {
                        return match ($state) {
                            Transaction::TYPE_DEPOSIT => 'heroicon-o-arrow-down',
                            Transaction::TYPE_WITHDRAW => 'heroicon-o-arrow-up',
                            default => 'heroicon-o-question-mark-circle',
                        };
                    })
                    ->sortable()
                    ->searchable(),
                //amount
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('Amount'))
                    ->badge()
                    ->color(function ($state) {
                        return $state < 0 ? 'danger' : 'success';
                    })
                    ->suffix(' د.ل')
                    ->sortable()
                    ->searchable(),


                //meta
                Tables\Columns\TextColumn::make('meta')
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWallets::route('/'),
        ];
    }

}
