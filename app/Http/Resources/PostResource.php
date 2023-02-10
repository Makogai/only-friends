<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => $this->getTypeAttribute(),
            'text' => $this->text,
            'image' => $this->image,
            'video' => $this->video,
            'likes' => $this->likesCount,
            'is_liked' => $this->isLiked,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    // getType if text is not null return text else if image is not null return image else if video is not null return video
    public function getTypeAttribute()
    {
        if ($this->text) {
            return 'text';
        } else if ($this->image) {
            return 'image';
        } else if ($this->video) {
            return 'video';
        }
    }
}
