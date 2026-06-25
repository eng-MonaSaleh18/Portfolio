<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AboutMeResource\Pages;
use App\Models\AboutMe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutMeResource extends Resource
{

    protected static ?string $model = AboutMe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'About Me';

    // 2. تغيير عنوان الصفحة الرئيسي (Breadcrumbs & Titles)
    protected static ?string $pluralModelLabel = 'About Me';
    
    // 3. تغيير تسمية العنصر الواحد (مثلاً عند الحذف أو الإضافة)
    protected static ?string $modelLabel = 'About Me content';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Section::make('من أنا')
                    
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('الوصف الشخصي')
                            ->required()
                            ->columnSpanFull(), // ليعطيك مساحة واسعة للكتابة
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('النص الحالي')
                    ->limit(100) // يعرض أول 100 حرف فقط في الجدول
                    ->html(),
            ])
            
            ->filters([
                //
            ])
            ->actions([
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
            'index'  => Pages\ListAboutMes::route('/'),
            'create' => Pages\CreateAboutMe::route('/create'),
            'edit'   => Pages\EditAboutMe::route('/{record}/edit'),
        ];
    }
}
