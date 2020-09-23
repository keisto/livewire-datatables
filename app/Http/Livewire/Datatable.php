<?php

namespace App\Http\Livewire;

use Schema;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    public $model;
    public $paginate;
    public $columns;
    public $checked = [];
    public $query;

    private $exclude;

    public function mount($model, $exclude = '', $paginate = 7)
    {
        $this->model = $model;
        $this->paginate = $paginate;
        $this->exclude = explode(',', $exclude);
        $this->columns = $this->columns();
    }

    public function columns()
    {
        return collect(Schema::getColumnListing($this->builder()->getQuery()->from))
            ->reject(function ($column) {
                return in_array($column, $this->exclude);
            })->toArray();
    }

    public function builder()
    {
        return new $this->model;
    }

    protected function checkedRecords()
    {
        return $this->builder()->whereIn('id', $this->checked);
    }

    public function isChecked($record)
    {
        return in_array($record->id, $this->checked);
    }

    public function deleteChecked()
    {
        $this->checkedRecords()->delete();

        $this->checked = [];
    }

    public function records()
    {
        $builder = $this->builder();

        if ($this->query) {
            $builder = $builder->search($this->query);
        }

        return $builder->paginate($this->paginate);
    }

    public function render()
    {
        return view('livewire.datatable');
    }
}
