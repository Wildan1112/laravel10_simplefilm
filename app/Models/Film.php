<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Status;
use App\Models\Network;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'synopsis', 'poster', 'status_id', 'type_id', 'network_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function network()
    {
        return $this->belongsTo(Network::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
