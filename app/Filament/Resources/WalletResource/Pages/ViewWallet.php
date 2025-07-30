<?php

namespace App\Filament\Resources\WalletResource\Pages;

use App\Filament\Resources\WalletResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewWallet extends ViewRecord
{
    protected static string $resource = WalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Wallet Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('holder.name')
                                    ->label(__('Holder Name'))
                                    ->copyable(),
                                TextEntry::make('holder.type')
                                    ->label(__('Holder Type'))
                                    ->copyable(),
                                TextEntry::make('balance')
                                    ->label(__('Balance'))
                                    ->suffix(' د.ل')
                                    ->badge()
                                    ->color('success')
                            ]),
                    ]),
            ]);
    }
}
