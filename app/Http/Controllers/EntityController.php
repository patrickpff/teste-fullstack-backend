<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $validated = $request->validate([
            'corporate_name'    => 'required|string|max:255',
            'trade_name'        => 'required|string|max:255',
            'cnpj'              => 'required|string|max:30',
            'inauguration_date' => 'required|date',
            'active'            => 'boolean',
            'region_id'         => 'required|integer|exists:regions,id',
        ]);

        $entity = Entity::create($validated);

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
    public function update(Request $request)
    {
        //
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
    public function destroy(Request $request)
    {
        //
    }
}
