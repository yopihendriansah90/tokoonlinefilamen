<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->reactive()
                    ])
                    ->required()
                    ->searchable()
                    ->preload()
                    ->placeholder('Select a category'),
                TextInput::make('name')
                    ->required(),
                RichEditor::make('description')
                    ->default(null)
                    ->columnSpanFull()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'], // The `customBlocks` and `mergeTags` tools are also added here if those features are used.
                        ['undo', 'redo'],
                    ]),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('IDR'),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required()
                    ->label('Is Active')
                    ->default(true),

                // upload gambar dengan spatie media library
                SpatieMediaLibraryFileUpload::make('images')
                    ->collection('product_images')
                    ->multiple()
                    // ->enableReordering()
                    ->imageEditor()
                    ->columnSpanFull(),


            ]);
    }
}
