<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Routines\Carros\Delete;
use App\Routines\Carros\FindAll;
use App\Routines\Carros\FindById;
use App\Routines\Carros\Restore;
use App\Routines\Carros\Save;
use App\Routines\Carros\Update;
use Illuminate\Http\Request;

class CarroController extends Controller
{
  
    public function index(Request $request)
    {
        return (new FindAll())->execute($request);
    }

    public function store(Request $request)
    {
        return (new Save())->execute($request);
    }

    public function show($id)
    {
        return (new FindById())->execute($id);
    }

    public function update(Request $request, $id)
    {
        return (new Update())->execute($request, $id);
    }

    public function destroy(int $id)
    {
        return (new Delete())->execute($id);
    }

    public function restore(int $id)
    {
        return (new Restore())->execute($id);
    }
}
