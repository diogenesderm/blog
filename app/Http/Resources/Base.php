<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;

class Base
{
    /**
     * @param \Illuminate\Support\Collection
     * @return \Illuminate\Support\Collection
     */
    public static function laratablesModifyCollection($collection)
    {
        $can = (object) [
            'update' => auth()->user()->can('update'),
            'delete' => auth()->user()->can('delete'),
        ];

        return $collection->map(function ($item) use ($can) {
            $item->setAttribute('can', $can);
           // $item->setAttribute('routes', self::getRoutes($item));
           // $item->setAttribute('ref', auth()->user()->currentModule->slug);

            return $item;
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return array
     */
    public static function laratablesRowData($model)
    {
        return [
            'id' => $model->id,
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesId($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->id}</a>";
        }

        return $model->id;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesTitle($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->title}</a>";
        }

        return $model->title;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesName($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->name}</a>";
        }

        return $model->name;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesEmail($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->email}</a>";
        }

        return $model->email;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesPhone($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->phone}</a>";
        }

        return $model->phone;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesCode($model)
    {
        $code = strtoupper($model->code);

        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\"><span style=\"padding:0px 10px;margin-right:5px;background-color:{$model->code};border:1px solid black;\"></span>{$code}</a>";
        }

        return $code;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesActive($model)
    {
        return view('layouts.app.components.table.toggle-active', [
            'data' => $model,
        ])->render();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesDate($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->date}</a>";
        }

        return $model->date;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesCreatedAt($model)
    {
        if ($model->can->update) {
            return "<a href=\"{$model->routes->edit}\">{$model->created_at->format('d/m/Y H:i')}</a>";
        }

        return $model->created_at->format('d/m/Y H:i');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesJorlanStatus($model)
    {
        if (is_null($model->jorlan_status)) {
            return;
        }

        if ($model->jorlan_status) {
            return "<i class=\"fas fa-check-circle text-success jorlan-details\" style=\"cursor:pointer;\"></i>";
        }

        return "<i class=\"fas fa-exclamation-circle text-danger jorlan-details\" style=\"cursor:pointer;\"></i>";
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database
     */
    public static function laratablesFollowizeStatus($model)
    {
        if (is_null($model->followize_status)) {
            return;
        }

        if ($model->followize_status) {
            return "<i class=\"fas fa-check-circle text-success followize-details\" style=\"cursor:pointer;\"></i>";
        }

        return "<i class=\"fas fa-exclamation-circle text-danger followize-details\" style=\"cursor:pointer;\"></i>";
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model
     * @return String
     */
    public static function laratablesCustomActions($model)
    {
      
        return self::getEditAction($model) . self::getDeleteAction($model);
    }

    public static function getEditAction($model)
    {
       

        return "<a href=\"{$model->routes->edit}\" class=\"btn btn-sm btn-info mx-1\"><i class=\"fas fa-fw fa-edit\"></i></a>";
    }

    public static function getDeleteAction($model)
    {
        if ($model->can->delete === false) {
            return null;
        }

        return "<button class=\"btn btn-sm btn-danger delete-registry mx-1\" data-ref=\"{$model->ref}-delete\" data-id=\"{$model->id}\"><i class=\"fas fa-trash-alt\"></i></button>";
    }

    public static function getRoutes($model)
    {
        $currentEnvironment = auth()->user()->currentEnvironment;
        $currentModule = auth()->user()->currentModule;

        $param = Str::singular(auth()->user()->currentModule->slug);

        $routes = new \stdClass();

        if ($model->can->update) {
            if ($currentModule->parent) {
                $routes->edit = route("panel.{$currentEnvironment->slug}.{$currentModule->parent->slug}.{$currentModule->slug}.edit", [$param => $model->id]);
            } else {
                $routes->edit = route("panel.{$currentEnvironment->slug}.{$currentModule->slug}.edit", [$param => $model->id]);
            }
        }

        if ($model->can->delete) {
            if ($currentModule->parent) {
                $routes->delete = route("panel.{$currentEnvironment->slug}.{$currentModule->parent->slug}.{$currentModule->slug}.destroy", [$param => $model->id]);
            } else {
                $routes->delete = route("panel.{$currentEnvironment->slug}.{$currentModule->slug}.destroy", [$param => $model->id]);
            }
        }

        return $routes;
    }
}
