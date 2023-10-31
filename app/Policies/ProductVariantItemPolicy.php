<?php

namespace App\Policies;

use App\Models\ProductVariantItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductVariantItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProductVariantItem $productVariantItem): Response
    {
        if(auth()->user()->role !== 'admin') {
            if($user->vendor->id !== $productVariantItem->product->vendor_id) {
                return Response::deny('You do not own this product.');
            }
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProductVariantItem $productVariantItem): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProductVariantItem $productVariantItem): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProductVariantItem $productVariantItem): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProductVariantItem $productVariantItem): bool
    {
        return true;
    }
}
