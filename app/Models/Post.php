<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title', 'slug', 'description', 'content', 'publish_date', 'status', 'user_id'
    ];
    
    protected $casts = [
        'publish_date' => 'datetime',
    ];

    // ✅ Tự động tạo slug từ title nếu chưa có và đảm bảo không trùng lặp
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = static::generateUniqueSlug($post->title);
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }
    protected $attributes = [
        'status' => 0, // Mặc định là "Bản nháp"
        'description' => 'Chưa có mô tả',
    ];

    /**
     * Tạo slug duy nhất từ title
     */
    private static function generateUniqueSlug($title, $postId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 2;

        // Kiểm tra xem slug đã tồn tại chưa
        while (static::where('slug', $slug)->when($postId, fn($q) => $q->where('id', '!=', $postId))->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // ✅ Accessor lấy ảnh đại diện (thumbnail)
    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('thumbnails') ?: asset('images/default-thumbnail.jpg');
    }

    // ✅ Thêm ảnh vào bài viết
    public function addThumbnail($file)
    {
        $this->clearMediaCollection('thumbnails'); // Xóa ảnh cũ trước khi thêm mới
        return $this->addMedia($file)->toMediaCollection('thumbnails');
    }

    // ✅ Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relationship với Category (Nếu có)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ✅ Scope lọc bài viết theo trạng thái
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 0);
    }
}
