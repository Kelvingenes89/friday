<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
     
    protected static ?string $navigationGroup = 'Academics';

    public static function getEloquentQuery(): Builder
    {
     // Filter courses based on the logged-in user's enrollments
     return parent::getEloquentQuery()
            ->whereHas('modules.enrollments', function ($query) {
                $query->whereHas('rfid', function ($rfidQuery) {
                    $rfidQuery->where('user_id', Auth::id());
                });
            });

    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                
                Tables\Columns\TextColumn::make('name')->label('Course Name'),
                Tables\Columns\TextColumn::make('department.dname')->label('Department'),
            
            ])
            ->filters([
                //
            ])->defaultSort('id')
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }


    public static function query(): Builder
    {
        // Filter the query to only include posts for the authenticated user
        return parent::query()->where('user_id', auth()->id());
    }
}
