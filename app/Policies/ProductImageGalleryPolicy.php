<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductImageGalleryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Product $product): Response
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProductImageGallery $productImageGallery): Response
    {
        if(auth()->user()->role !== 'admin') {
            if($user->vendor->id !== $productImageGallery->vendor_id) {
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
    public function update(User $user, ProductImageGallery $productImageGallery): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProductImageGallery $productImageGallery): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProductImageGallery $productImageGallery): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProductImageGallery $productImageGallery): bool
    {
        return true;
    }
}
