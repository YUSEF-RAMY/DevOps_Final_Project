<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        if ($perPage < 1) { $perPage = 20; }
        if ($perPage > 100) { $perPage = 100; }
        $addresses = $request->user()->addresses()->latest()->paginate($perPage);
        $data = $addresses->getCollection()->map(fn ($a) => $this->addressResource($a));
        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $addresses->currentPage(),
                'last_page' => $addresses->lastPage(),
                'per_page' => $addresses->perPage(),
                'total' => $addresses->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->rules($request);
        $data = $validated + ['user_id' => $request->user()->id];
        if (!empty($data['is_default'])) {
            $request->user()->addresses()->where('type', $data['type'])->update(['is_default' => false]);
        }
        $address = UserAddress::create($data);
        return response()->json($this->addressResource($address), 201);
    }

    public function update(Request $request, UserAddress $address)
    {
        $this->authorize('update', $address);
        $validated = $this->rules($request, $address->id);
        if (!empty($validated['is_default'])) {
            $request->user()->addresses()->where('type', $validated['type'])->where('id', '!=', $address->id)->update(['is_default' => false]);
        }
        $address->update($validated);
        return response()->json($this->addressResource($address));
    }

    public function destroy(Request $request, UserAddress $address)
    {
        $this->authorize('delete', $address);
        $address->delete();
        return response()->json(['success' => true]);
    }

    public function setDefault(Request $request, UserAddress $address)
    {
        $this->authorize('update', $address);
        $request->user()->addresses()->where('type', $address->type)->where('id', '!=', $address->id)->update(['is_default' => false]);
        $address->update(['is_default' => true]);
        return response()->json($this->addressResource($address));
    }

    private function rules(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'type' => 'required|in:billing,shipping',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'upazila' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'is_default' => 'boolean',
        ]);
    }

    private function addressResource(UserAddress $a): array
    {
        return [
            'id' => $a->id,
            'type' => $a->type,
            'first_name' => $a->first_name,
            'last_name' => $a->last_name,
            'company' => $a->company,
            'address_line_1' => $a->address_line_1,
            'address_line_2' => $a->address_line_2,
            'city' => $a->city,
            'state' => $a->state,
            'division' => $a->division,
            'district' => $a->district,
            'upazila' => $a->upazila,
            'postal_code' => $a->postal_code,
            'country' => $a->country,
            'phone' => $a->phone,
            'is_default' => (bool) $a->is_default,
            'created_at' => $a->created_at?->toIso8601String(),
        ];
    }
}
