<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Routines\Clientes\Delete;
use App\Routines\Clientes\FindAll;
use App\Routines\Clientes\FindById;
use App\Routines\Clientes\Restore;
use App\Routines\Clientes\Save;
use App\Routines\Clientes\Update;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
