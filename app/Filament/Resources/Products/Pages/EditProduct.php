<?php

namespace App\Filament\Resources\Products\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Products\ProductResource;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];

        
    }
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // notifikasi update
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Product Updated')
            ->body('Product has been updated successfully');
    }
    


}

