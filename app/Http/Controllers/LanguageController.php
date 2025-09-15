<?php

namespace App\Http\Controllers;

use App\Services\Contracts\LanguageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LanguageController extends Controller
{
    protected $languageService;

    public function __construct(LanguageServiceInterface $languageService)
    {
        $this->languageService = $languageService;
    }

    public function index()
    {
        $result = $this->languageService->getAll();

        if (!$result['status'])
            return Response::api($result['message'], 400, false, 400);

        return Response::api($result['data'], 200, true, null, $result['data']);
    }
}
