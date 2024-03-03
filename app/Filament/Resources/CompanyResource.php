<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\State;
use App\Models\Company;
use App\Models\Country;
use App\Models\Industry;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CompanyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CompanyResource\RelationManagers;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationLabel = 'Company';

    protected static ?string $navigationGroup = 'Business';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\Select::make('industry_id')
                    ->relationship('industry', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\RichEditor::make('description')->columnSpan(2),
                Forms\Components\Textarea::make('location'),
                Forms\Components\TextInput::make('no_of_offices')->integer(),
                Forms\Components\TextInput::make('website'),
                Forms\Components\TextInput::make('phone')->integer(),
                Forms\Components\TextInput::make('logo'),
                Forms\Components\Toggle::make('is_featured')->inline(false)->onColor('success')->offColor('danger')->default(false),
                Forms\Components\Toggle::make('is_active')->inline(false)->onColor('success')->offColor('danger')->default(true),
                // Section::make('Publishing')
                //     ->description('Settings for publishing this post.')
                //     ->schema([
                //         Select::make('is_active')
                //             ->options([
                //                 'true' => 'Publish',
                //                 'false' => 'UnPublish',
                //             ])->required(),
                //     ]),
                Forms\Components\TextInput::make('map'),
                Forms\Components\TextInput::make('facebook_link'),
                Forms\Components\TextInput::make('twitter_link'),
                Forms\Components\TextInput::make('linkedin_link'),
                Forms\Components\TextInput::make('instagram_link'),
                Forms\Components\TextInput::make('youtube_link'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('name')->label('Company Name')->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('industry.name')->label('Industry'),
                Tables\Columns\TextColumn::make('country.name')->label('Country'),
                Tables\Columns\TextColumn::make('state.name')->label('State'),
                Tables\Columns\TextColumn::make('city.name')->label('City'),
                Tables\Columns\TextColumn::make('description')->label('Description'),
                Tables\Columns\TextColumn::make('location')->label('Location'),
                Tables\Columns\TextColumn::make('no_of_offices')->label('No of Offices'),
                Tables\Columns\TextColumn::make('website')->label('Website'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('logo')->label('Logo'),
                Tables\Columns\BooleanColumn::make('is_active')->label('Is Active')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make('is_featured')->label('Is Featured')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('map')->label('Map'),
                Tables\Columns\TextColumn::make('facebook_link')->label('Facebook Link')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('twitter_link')->label('Twitter Link')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('linkedin_link')->label('LinkedIn Link')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('instagram_link')->label('Instagram Link')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('youtube_link')->label('YouTube Link')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('industry_id')
                    ->label('Filter By Industry')
                    ->options(Industry::all()->pluck('name', 'id'))
                    ->multiple(),
                SelectFilter::make('country_id')
                    ->label('Filter By Country')
                    ->options(Country::all()->pluck('name', 'id'))
                    ->multiple(),
                SelectFilter::make('state_id')
                    ->label('Filter By State')
                    ->options(State::all()->pluck('name', 'id'))
                    ->searchable()
                    ->multiple(),
                SelectFilter::make('city_id')
                    ->label('Filter By City')
                    ->options(City::all()->pluck('name', 'id'))
                    ->searchable()
                    ->multiple(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
