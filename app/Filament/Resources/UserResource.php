<?php
namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static bool $shouldRegisterNavigation = true;
    
    public static function canCreate(): bool { return false; }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),

                // حقل كلمة المرور
                Forms\Components\TextInput::make('password')
                    ->password()                                                    // يجعل الكتابة مخفية (نقاط)
                    ->dehydrated(fn($state) => filled($state))                      // لا يحفظه في قاعدة البيانات إذا كان فارغاً (عند التعديل)
                    ->required(fn(string $context): bool => $context === 'create'), // إلزامي فقط عند إنشاء مستخدم جديد

                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('profile'),

                Forms\Components\TextInput::make('phone')
                    ->tel(),

                Forms\Components\TextInput::make('location'),

                Forms\Components\TextInput::make('github_link')
                    ->url(),

                Forms\Components\TextInput::make('linkedin_link')
                    ->url(),

                Forms\Components\TextInput::make('telegram_link')
                    ->url(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // عرض الصورة الشخصية بشكل دائري مصغر
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة')
                    ->circular(),

                // عرض الاسم مع خاصية البحث عنه
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(),

                // عرض الإيميل
                Tables\Columns\TextColumn::make('email')
                    ->label('البريد الإلكتروني'),

                // عرض رقم الهاتف
                Tables\Columns\TextColumn::make('phone')
                    ->label('الهاتف'),
                // عرض الموقع
                Tables\Columns\TextColumn::make('location')
                    ->label('Location'),
                

                
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
