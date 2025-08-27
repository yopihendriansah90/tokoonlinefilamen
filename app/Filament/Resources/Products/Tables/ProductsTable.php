<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // show image
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('product_images')
                    ->label('Image')
                    ->limit(1)
                    // ->circular()
                    ->defaultImageUrl(url('/images/default-product.png')),
                    
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn(string $state): string => Str::title($state)),
                TextColumn::make('price')
                    ->money('IDR', true)
                    ->sortable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->tooltip('Edit Product'),

                DeleteAction::make()
                    ->tooltip('Delete Product'),

                RestoreAction::make()
                    ->tooltip('Restore Product'),

                ForceDeleteAction::make()
                    ->tooltip('Force Delete Product'),
            ])
            // bulck action table
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
                
            ]);
    }
}
