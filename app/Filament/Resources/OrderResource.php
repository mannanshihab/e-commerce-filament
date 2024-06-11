<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Number;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_method')
                            ->options([
                                'bkash' => 'bkash',
                                'COD' => 'Cash on Delivery'
                            ])
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_status')
                            ->options([
                                'Pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->default('Pending')
                            ->searchable()
                            ->preload()
                            ->required(),

                        ToggleButtons::make('status')
                                ->inline()
                                ->default('new')
                                ->required()
                                ->options([
                                    'new' => 'New',
                                    'processing' => 'Processing',
                                    'shipped'    => 'Shipped',
                                    'delivered'  => 'Delivered',
                                    'canceled'   => 'Canceled',
                                ])
                                ->colors([
                                    'new' => 'info',
                                    'processing' => 'warning',
                                    'shipped'    => 'success',
                                    'delivered'  => 'success',
                                    'canceled'   => 'danger',
                                ])
                                ->icons([
                                    'new' => 'heroicon-m-sparkles',
                                    'processing' => 'heroicon-m-arrow-path',
                                    'shipped'    => 'heroicon-m-truck',
                                    'delivered'  => 'heroicon-m-check-badge',
                                    'canceled'   => 'heroicon-m-x-circle',
                                ]),
                        
                        Select::make('currency')
                                ->options([
                                    'inr' => 'INR',
                                    'usd' => 'USD',
                                    'eur' => 'EUR',
                                    'tk' => 'BDT',
                                ])
                                ->default('BDT'),
                        Select::make('shiping_method')
                                ->options([
                                    'fedex' => 'Fedex',
                                    'ups' => 'UPS',
                                    'dhl' => 'DHL',
                                    'dhl' => 'DHL',
                                    'usps' => 'USPS',
                                ]),
                        Textarea::make('notes')
                        ->columnSpanFull()
                    ])->columns(2),
                    
                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->relationship('product', 'name')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->distinct()
                                ->columnSpan(4)
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)?->price??0))
                                ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)?->price??0)),
                                
                            TextInput::make('quantity')
                                ->required()
                                ->numeric()
                                ->default(1)
                                ->columnSpan(2)
                                ->minValue(1)
                                ->reactive()
                                ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),
                            
                            TextInput::make('unit_amount')
                                ->required()
                                ->numeric()
                                ->columnSpan(3)
                                ->disabled()
                                ->dehydrated(),

                            TextInput::make('total_amount')
                                ->numeric()
                                ->columnSpan(3)
                                ->required()
                        ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Grand Total')
                            ->content(function(Get $get, Set $set){
                                $total = 0;
                                if(!$repeaters = $get('items')){
                                    return $total;
                                }

                                foreach($repeaters as $key => $repeater){
                                    $total += $get("items.{$key}.total_amount");
                                }

                                $set('grand_total', $total);

                                //return $total;
                                return Number::currency($total, 'BDT');
                            }),

                            Hidden::make('grand_total')
                            ->default(0)
                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('grand_total')
                    ->label('Grand Total')
                    ->numeric()
                    ->money('BDT')
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->searchable()
                    ->sortable(),

                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped'    => 'Shipped',
                        'delivered'  => 'Delivered',
                        'canceled'   => 'Canceled',
                    ])
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('shiping_method')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-adjustments-horizontal')
                ->size(ActionSize::Small)
                ->color('primary')
                ->button()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count(); 
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
