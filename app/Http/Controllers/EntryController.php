<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class EntryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $entries = Entry::all();

        return new JsonResponse($entries, Response::HTTP_OK);
    }

    /**
     * @param EntryRequest $request
     * @return JsonResponse
     */
    public function store(EntryRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
        } catch (ValidationException $e) {
            return new JsonResponse($e, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $entry = new Entry();
        $entry->label = $validated['label'];
        $entry->value = $validated['value'];
        if ($validated['date']) {
            $entry->date = $validated['date'];
        }
        $entry->save();

        return new JsonResponse($entry, Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @param EntryRequest $request
     * @return JsonResponse
     */
    public function update(int $id, EntryRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
        } catch (ValidationException $e) {
            return new JsonResponse($e, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            /** @var Entry $entry */
            $entry = Entry::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse($e, Response::HTTP_NOT_FOUND);
        }
        $entry->label = $validated['label'];
        $entry->value = $validated['value'];
        if ($validated['date']) {
            $entry->date = $validated['date'];
        }
        $entry->save();

        return new JsonResponse($entry, Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            /** @var Entry $entry */
            $entry = Entry::find($id);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse($e, Response::HTTP_NOT_FOUND);
        }
        try {
            $entry->delete();
        } catch (Exception $e) {
            // fixing a quirk in Laravel where wrong exception type gets thrown
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
