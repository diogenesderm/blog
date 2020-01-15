<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Base;

class PostsDatatableResources extends Base
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static function laratablesQueryConditions($query)
    {
        return $query->join('categories', 'categories.id', 'posts.categories_id')
                    ->select('posts.title', 'posts.id', 'posts.description', 'posts.image', 'categories.title as categoria')
                    ->orderBy('posts.title', 'desc');
    }

     /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return String
     */
    public static function laratablesCustomActions($model)
    {
        
        $buttons ='<a href="'.route('posts.edit', $model->id).'" type="button" class="btn btn-warning btn-sm"> Edit </a>

        <button type="button" class="btn btn-sm btn-danger delete-registry mx-1" data-ref="new-delete" data-id="'.$model->id.'"> Delete </button>';

        return $buttons;
    }

    public static function getEditAction($model)
    {
        if ($model->can->update === false) {
            return null;
        }

        $previewRoute = route('panel.cms.products.new.preview', ['product' => $model->id]);

        $buttons = "<a href=\"{$previewRoute}\" target=\"_blank\" class=\"btn btn-sm btn-secondary mx-1\"><i class=\"fas fa-fw fa-eye\"></i></a>";
        $buttons .= "<a href=\"{$model->routes->edit}\" class=\"btn btn-sm btn-info mx-1\"><i class=\"fas fa-fw fa-edit\"></i></a>";

        return $buttons;
    }
}
