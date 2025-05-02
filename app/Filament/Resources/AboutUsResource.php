<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsResource\Pages;
use App\Filament\Resources\AboutUsResource\RelationManagers;
use App\Models\AboutUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Konten')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->placeholder('Masukkan judul konten')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('text')
                            ->label('Deskripsi')
                            ->placeholder('Tulis deskripsi lengkap di sini...')
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('number')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->minValue(1)
                                    ->placeholder('Misal: 1'),

                                Forms\Components\Select::make('type')
                                    ->label('Tipe Konten')
                                    ->required()
                                    ->options([
                                        'Text' => 'Text',
                                        'Number' => 'Number',
                                        'Image' => 'Image',
                                    ])
                                    ->placeholder('Pilih tipe konten'),
                            ]),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Tampilan di Website')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->panelAspectRatio('4:1')
                            ->panelLayout('compact')
                            ->placeholder('Unggah gambar konten...')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website?')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->height(40),

                Tables\Columns\TextColumn::make('number')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filter Tipe')
                    ->options([
                        'visi' => 'Visi',
                        'misi' => 'Misi',
                        'nilai' => 'Nilai',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAboutUs::route('/'),
            'create' => Pages\CreateAboutUs::route('/create'),
            'view' => Pages\ViewAboutUs::route('/{record}'),
            'edit' => Pages\EditAboutUs::route('/{record}/edit'),
        ];
    }
}
