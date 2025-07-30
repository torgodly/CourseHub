<?php

namespace App\Filament\Trainer\Resources\WalletResource\Pages;

use App\Filament\Trainer\Resources\WalletResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWallets extends ManageRecords
{
    protected static string $resource = WalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //cache withdraw request
//            Actions\Action::make
        ];
    }
}
