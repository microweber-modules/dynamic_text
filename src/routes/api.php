<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use MicroweberPackages\DynamicText\Models\DynamicTextVariable;

\Route::name('api.')

    ->prefix('api')
    ->middleware(['api', 'admin', 'xss'])
    ->group(function () {

        Route::post('save_dynamic_text', function () {

            $data = request()->all();

            $rules = [];
            $rules['name'] = 'required|max:500';

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                $errors = $validator->messages()->toArray();
                return ['errors'=>$errors];
            }

            return save_dynamic_text($data);
        })->name('save_dynamic_text');

        Route::post('delete_dynamic_text', function () {

            $params = request()->all();

            if (!is_admin()) {
                return;
            }

            if (isset($params['id'])) {
                $model = DynamicTextVariable::whereId($params['id'])->first();
                if ($model != null) {
                    return $model->delete();
                }
            }

        })->name('delete_dynamic_text');
    });
