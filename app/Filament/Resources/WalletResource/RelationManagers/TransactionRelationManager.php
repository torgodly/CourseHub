<?php

namespace App\Filament\Resources\WalletResource\RelationManagers;

use Bavix\Wallet\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionRelationManager extends RelationManager
{
    protected static string $relationship = 'walletTransactions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
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
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }
}
