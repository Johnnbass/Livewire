<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseList extends Component
{
    public function render()
    {
        $expenses = auth()->user()->expenses()->count()
            ? auth()->user()->expenses()->orderBy('created_at', 'DESC')->paginate(3)
            : [];

        return view('livewire.expense.expense-list', compact('expenses'));
    }

    public function remove($expense)
    {
        auth()->user()->expenses()->find($expense)->delete();

        session()->flash('message', 'Registro removido com sucesso!');
    }
}
