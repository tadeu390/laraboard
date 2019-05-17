<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ModuleRepositoryInterface
{
    public function search(Request $request);
}
