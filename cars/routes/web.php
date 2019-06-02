<?php


use App\User;
use App\Car;
use App\Color;

Route::get('/seed', function () {
    User::query()->delete();
    Car::query()->delete();
    Color::query()->delete();
    \DB::table('user_car')->delete();

    factory(User::class, 50)->create();
    factory(Car::class, 50)->create();
    factory(Color::class, 50)->create();

    foreach (User::get() as $user) {
        $user->cars()->sync(Car::pluck('id')->random(5)->map(function ($id) {
            return [
                'car_id' => $id,
                'color_id' => Color::pluck('id')->random()
            ];
        })->keyBy('color_id'));
    }
});

Route::get('/test', function () {
    return User::with(['cars.pivot.color'])->paginate();
});
