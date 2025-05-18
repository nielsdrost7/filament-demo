<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use App\Filament\Resources\Blog\PostResource;
use Filament\Forms;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Comments";
    }

    public function getBreadcrumb(): string
    {
        return 'Comments';
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Comments';
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('title')
                    ->required(),

                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Toggle::make('is_visible')
                    ->label('Approved for public')
                    ->default(true),

                Forms\Components\MarkdownEditor::make('content')
                    ->required()
                    ->label('Content'),
            ])
            ->columns(1);
    }

    public function infolist(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('title'),
                TextEntry::make('customer.name'),
                IconEntry::make('is_visible')
                    ->label('Visibility'),
                TextEntry::make('content')
                    ->markdown(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }
}
