<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class EntryController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $entries = Entry::where('user_id', $user->id)->get();

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
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (ValidationException $e) {
            return new JsonResponse($e, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        /** @var User $user */
        $user = $request->user();
        $entry = new Entry();
        $entry->userId = $user->id;
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
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (ValidationException $e) {
            return new JsonResponse($e, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            /** @var Entry $entry */
            $entry = Entry::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse($e, Response::HTTP_NOT_FOUND);
        }
        /** @var User $user */
        $user = $request->user();
        if ($user->id != $entry->userId) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
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
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(int $id, Request $request): JsonResponse
    {
        try {
            /** @var Entry $entry */
            $entry = Entry::find($id);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse($e, Response::HTTP_NOT_FOUND);
        }
        /** @var User $user */
        $user = $request->user();
        if ($user->id != $entry->userId) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
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
