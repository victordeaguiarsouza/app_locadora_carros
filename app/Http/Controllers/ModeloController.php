<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Routines\Modelos\Delete;
use App\Routines\Modelos\FindAll;
use App\Routines\Modelos\FindById;
use App\Routines\Modelos\Restore;
use App\Routines\Modelos\Save;
use App\Routines\Modelos\Update;
use Illuminate\Http\Request;

class ModeloController extends Controller
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
