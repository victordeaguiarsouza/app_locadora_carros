<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Routines\Marcas\Delete;
use App\Routines\Marcas\FindAll;
use App\Routines\Marcas\FindById;
use App\Routines\Marcas\Restore;
use App\Routines\Marcas\Save;
use App\Routines\Marcas\Update;
use Illuminate\Http\Request;

class MarcaController extends Controller
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
