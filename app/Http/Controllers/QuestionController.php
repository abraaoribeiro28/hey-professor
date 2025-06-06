<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],
        ]);

        Question::query()->create($attributes);

        return to_route('dashboard');
    }
}
