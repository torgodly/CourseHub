<?php

namespace App\Filament\Trainer\Resources\WalletResource\Pages;

use App\Filament\Trainer\Resources\WalletResource;
use App\Models\Voucher;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ManageWallets extends ManageRecords
{
    protected static string $resource = WalletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //cache withdraw request
            Actions\Action::make('redeem')
                ->label(__('Redeem Voucher'))
                ->icon('tabler-cash-banknote')
                ->color('primary')
                ->form([
                    TextInput::make('code')
                        ->label(__('Voucher Code'))
                        ->required()
                        ->maxLength(255)
                        ->exists('vouchers', 'code')
                        ->rule(function () {
                            return function (string $attribute, $value, $fail) {
                                //check if the voucher is already redeemed
                                $voucher = Voucher::where('code', $value)->first();
                                if ($voucher && $voucher->isRedeemed()) {
                                    $fail(__('This voucher has already been redeemed.'));
                                }
                            };
                        })
                        ->placeholder(__('Enter your voucher code')),
                ])
                ->action(function ($data) {
                    $voucher = Voucher::where('code', $data['code'])->firstOrFail();
                    // Redeem the voucher
                    $voucher->redeem();
                    Notification::make()
                        ->title(__('Voucher Redeemed Successfully'))
                        ->body(__('Your voucher has been redeemed successfully.'))
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading(__('Redeem Voucher')),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            WalletResource\Widgets\WalletOverview::class
        ];
    }
}
