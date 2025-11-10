<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Entity;

class EntityController extends Controller
{
    /**
     * Display a listing of entities.
     *
     * Return all entities.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $entities = Entity::all();

        return response()->json($entities);
    }

    /**
     * Store a newly created entity in storage.
     *
     * Create a new entity and return it.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'corporate_name'    => 'required|string|max:255',
            'trade_name'        => 'required|string|max:255',
            'cnpj'              => 'required|string|max:30',
            'inauguration_date' => 'required|date',
            'active'            => 'boolean',
            'region_id'         => 'required|integer|exists:regions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $entity = Entity::create($request->only([
            'corporate_name',
            'trade_name',
            'cnpj',
            'inauguration_date',
            'active',
            'region_id'
        ]));

        return response()->json($entity, 201);
    }

    /**
     * Display the specified entity.
     *
     * Return a single entity by ID.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $entity = Entity::find($request->id);

        return response()->json($entity);
    }

    /**
     * Update the specified entity in storage.
     *
     * Update an existing entity and return it.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $validator = Validator::make($request->all(), [
            'id'                => 'required|integer|exists:entities,id',
            'corporate_name'    => 'required|string|max:255',
            'trade_name'        => 'required|string|max:255',
            'cnpj'              => 'required|string|max:30',
            'inauguration_date' => 'required|date',
            'active'            => 'boolean',
            'region_id'         => 'required|integer|exists:regions,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $entity = Entity::findOrFail($request['id']); // 404 if don't exists

        $entity->update($request->only([
            'corporate_name',
            'trade_name',
            'cnpj',
            'inauguration_date',
            'active',
            'region_id',
        ]));

        return response()->json($entity, 200);
    }

    /**
     * Update the specified entity in storage.
     *
     * Update an existing entity and return it.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $entity = Entity::findOrFail($id); // 404 if don't exists

        $entity->delete();

        return response()->json(null, 204); // returns 204 no content
    }
}
