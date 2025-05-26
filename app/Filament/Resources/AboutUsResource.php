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
use Illuminate\Support\Str;

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
                            ->maxLength(255)
                            ->live(onBlur: true) // hanya update saat input kehilangan fokus
                            ->afterStateUpdated(function (string $operation, $state, callable $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->required(),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->disabled()
                            ->dehydrated() // tetap dikirim saat submit
                            ->unique(ignoreRecord: true),

                        Forms\Components\Select::make('type')
                            ->label('Tipe Konten')
                            ->required()
                            ->options([
                                'text' => 'Text',
                                'number' => 'Number',
                                'image' => 'Image',
                            ])
                            ->placeholder('Pilih tipe konten')
                            ->afterStateHydrated(function (Forms\Components\Select $component, $state) {
                                $component->state($state); // Paksa reaktivasi nilai saat load edit/view
                            })
                            ->reactive(), // penting agar perubahan langsung dipantau
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Konten')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->imagePreviewHeight('150')
                            ->required(fn(callable $get) => $get('type') === 'image')
                            ->columnSpanFull()
                            ->visible(fn(callable $get) => $get('type') === 'image')
                            ->reactive(),

                        Forms\Components\RichEditor::make('text')
                            ->label('Isi Konten')
                            ->placeholder('Tulis deskripsi lengkap di sini...')
                            ->columnSpanFull()
                            ->required(fn(callable $get) => $get('type') === 'text')
                            ->visible(fn(callable $get) => $get('type') === 'text')
                            ->reactive(),


                        Forms\Components\TextInput::make('number')
                            ->label('Isi Konten')
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('Misal: 1')
                            ->required(fn(callable $get) => $get('type') === 'number')
                            ->visible(fn(callable $get) => $get('type') === 'number')
                            ->reactive(),
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

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

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
