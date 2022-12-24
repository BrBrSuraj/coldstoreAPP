<?php

namespace App\Http\Livewire;

use App\Models\Purchese;
use App\Traits\Currency;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PurcheseReportTable extends PowerGridComponent
{
    use ActionButton,Currency;
    public int $type;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showToggleColumns()->showSearchInput()->includeViewOnTop('components.header-top'),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Purchese>
    */
    public function datasource(): Builder
    {
        return Purchese::query()->where('supplier_id',$this->type)->with('payments');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            // ->addColumn('id')
            ->addColumn('weight', function (Purchese $model){
                return $this->currency($model->weight);
            })
            ->addColumn('rate', function (Purchese $model) {
            return $this->currency($model->rate);
        })
       
            ->addColumn('total', function (Purchese $model) {
            return $this->currency($model->total);
        })
            ->addColumn('status')

           /** Example of custom column using a closure **/
            ->addColumn('status_lower', function (Purchese $model) {
                return strtolower(e($model->status));
            })

            ->addColumn('fy')
            ->addColumn('paid',function(Purchese $model){
                return$this->currency($model->payments()->sum('amount'));
            })
            ->addColumn('created_at_formatted', fn (Purchese $model) => Carbon::parse($model->created_at)->format('Y-M-d'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        // $count=1;
        return [
            // Column::make('ID', 'id')
            //     ->makeInputRange(),

            Column::make('WEIGHT', 'weight')
                ->sortable()
                ->searchable(),

            Column::make('RATE', 'rate')
                ->sortable()
                ->searchable(),

            // Column::make('USER ID', 'user_id')
            //     ->makeInputRange(),

            Column::make('TOTAL', 'total')
                ->sortable()
                ->searchable(),

            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('FY', 'fy')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PAID', 'paid')
                ->sortable()
                ->searchable()
                ->makeInputText(),
            // Column::make('SUPPLIER ID', 'supplier_id')
            //     ->makeInputRange(),

            Column::make('CREATED AT', 'created_at_formatted','created_at')
                ->searchable()
                ->sortable()
            ->makeInputText(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Purchese Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('purchese.edit', ['purchese' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('purchese.destroy', ['purchese' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Purchese Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($purchese) => $purchese->id === 1)
                ->hide(),
        ];
    }
    */
}
