<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Routines\Locacoes\Delete;
use App\Routines\Locacoes\FindAll;
use App\Routines\Locacoes\FindById;
use App\Routines\Locacoes\Restore;
use App\Routines\Locacoes\Save;
use App\Routines\Locacoes\Update;
use Illuminate\Http\Request;

class LocacaoController extends Controller
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
