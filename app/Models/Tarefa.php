<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarefa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nome', 'descricao', 'markdown', 'user_id', 'data_prazo'];


    public function scopeSearch(Builder $query, $request)
    {
        return $query->when($request->nome, function (Builder $query, string $nome) {
            return $query->where('nome', 'like', '%' . $nome . '%');
        })->when($request->markdown, function (Builder $query, string $markdown) {
            return $query->where('markdown', 'like', $markdown);
        })->when($request->deleted_at, function (Builder $query, string $deleted_at) {
            switch ($deleted_at) {
                case 'null':
                    return $query;
                    break;
                case 'notnull':
                    return $query->onlyTrashed();
                    break;
                case 'every':
                    return $query->withTrashed();
                    break;
                default:
                    break;
            }
        });
    }


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
