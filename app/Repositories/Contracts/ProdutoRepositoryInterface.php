<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ProdutoRepositoryInterface
{
    public function search(Request $request);
}