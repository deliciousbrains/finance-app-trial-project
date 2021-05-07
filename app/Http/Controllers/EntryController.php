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
        $entry->user_id = $user->id;
        $entry->label = $validated['label'];
        $entry->value = $validated['value'];
        $entry->is_debit = $validated['is_debit'];
        if (array_key_exists('date', $validated)) {
            $entry->date = $validated['date'];
        }
        $entry->save();
        $entry->refresh();

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
        if ($user->id != $entry->user_id) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
        $entry->label = $validated['label'];
        $entry->value = $validated['value'];
        $entry->is_debit = $validated['is_debit'];
        if (array_key_exists('date', $validated)) {
            $entry->date = $validated['date'];
        }
        $entry->save();
        $entry->refresh();

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
            $entry = Entry::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse($e, Response::HTTP_NOT_FOUND);
        }
        /** @var User $user */
        $user = $request->user();
        if ($user->id != $entry->user_id) {
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getTotal(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Entry[] $entries */
        $entries = Entry::where('user_id', $user->id)->get();
        $total = 0;
        foreach ($entries as $entry) {
            // avoid floating point arithmetic
            $value = (int)($entry->value * 100);
            if (!$entry->is_debit) {
                $value *= -1;
            }
            $total += $value;
        }
        $total = $total / 100;

        return new JsonResponse(['total' => $total], Response::HTTP_OK);
    }
}
