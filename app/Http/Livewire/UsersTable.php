<?php

namespace App\Http\Livewire;

use App\Models\ContactForm as Client;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\DateColumn;



class UsersTable extends LivewireDatatable
{
    public $model = Client::class;

    public function columns()
    {
        //
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('desc')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name'),
            
                Column::name('type')
                ->label('Type'),

                Column::name('location')
                ->label('Location'),

                Column::name('whatsapp')
                ->label('No Hp'),


            Column::name('email')
                ->label('Email'),

                Column::name('status')
                ->label('Status'),

            DateColumn::name('date')
                ->label('Tanggal')
        ];
    }
    public function query(): Builder
    {
        return Client::query();
    }
}