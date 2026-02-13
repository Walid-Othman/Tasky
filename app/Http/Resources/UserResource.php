<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'google_id'=>$this->google_id ?? null,
            'name'=>$this->name,
            'email'=>$this->email,
            'token' => $this->when($this->token, $this->token),
            'is_verified' => $this->email_verified_at !== null,
            'created_at'=>$this->created_at?->format("Y-m-d")
        ];
    }
}
